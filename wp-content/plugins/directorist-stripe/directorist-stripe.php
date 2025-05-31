<?php

/**
 * Plugin Name: Directorist - Stripe Payment Gateway
 * Plugin URI: https://directorist.com/product/directorist-stripe/
 * Description: You can accept payment via Stripe using this extension on any website powered by the Directorist WordPress Plugin.
 * Version: 2.7
 * Author: wpWax
 * Author URI: https://wpwax.com
 * License: GPLv2 or later
 * Text Domain: directorist-stripe
 * Domain Path: /languages
 */
// prevent direct access to the file
defined('ABSPATH') || die('No direct script access allowed!');

if (!class_exists('Directorist_Stripe_Gateway')) {
    final class Directorist_Stripe_Gateway
    {
        /**
         * @var Directorist_Stripe_Gateway The one true Directorist_Stripe_Gateway
         * @since 1.0.0
         */
        private static $instance;

        /**
         * If true, the stripe test keys are used. and otherwise stripe live keys are used. Default false.
         *
         * @since    1.0.0
         * @access   private
         * @var      bool
         */
        private $use_sandbox = false;

        private $tax_rate = '';
        /**
         * Main Directorist_Stripe_Gateway Instance.
         *
         * Insures that only one instance of Directorist_Stripe_Gateway exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         * @return Directorist_Stripe_Gateway
         * @since 1.0.0
         */
        public static function instance()
        {
            // if no object is created, then create it and return it. Else return the old object of our class
            if (!isset(self::$instance) && !(self::$instance instanceof self)) {
                self::$instance = new self; // create an instance of Directorist_Stripe_Gateway
                self::$instance->setup_constants();
                self::$instance->includes();
                self::$instance->tax_rate = get_directorist_option('tex_rate');
                self::$instance->use_sandbox = get_directorist_option('stripe_gateway_test_mode', true);
				
				add_action( 'admin_init', [ self::$instance, 'update_controller' ] );

                add_action('wp_enqueue_scripts', array(self::$instance, 'register_styles_scripts'));
                // enable translation
                add_action('plugins_loaded', array(self::$instance, 'load_textdomain'));
                add_action('admin_enqueue_scripts', array(self::$instance, 'load_needed_scripts_admin'));
                // push license settings
                add_filter('atbdp_license_settings_controls', array(self::$instance, 'license_settings_controls'));
                // settings 
                add_filter('atbdp_listing_type_settings_field_list', array(self::$instance, 'atbdp_listing_type_settings_field_list'));
                add_filter('atbdp_monetization_settings_submenu', array(self::$instance, 'atbdp_monetization_settings_submenu'));
                // Add stripe gateway to the active gateway & default gateways selections
                add_filter('directorist_active_gateways', array(self::$instance, 'default_active_gateways'));
                add_filter('atbdp_default_gateways', array(self::$instance, 'default_active_gateways'));

                $gateways = get_directorist_option('active_gateways');
                if (is_array($gateways) && !in_array('stripe_gateway', $gateways)) {
                    return;
                }
                // Process payment
                add_action('atbdp_process_stripe_gateway_payment', array(self::$instance, 'process_payment'), 20, 1);
                // register our scripts and styles
                // enqueue scripts only on our checkout form
                add_action('atbdp_before_checkout_form_start', array(self::$instance, 'enqueue_styles_scripts'));
                // out put the cc form
                add_action('wp_ajax_atbdp_stripe_payment_success', array(self::$instance, 'atbdp_stripe_payment_success'));
                add_action('wp_ajax_nopriv_atbdp_stripe_payment_success', array(self::$instance, 'atbdp_stripe_payment_success'));

                // add_action('wp_ajax_atbdp_stripe_payment_process', array(self::$instance, 'atbdp_stripe_payment_process'));
                // add_action('wp_ajax_nopriv_atbdp_stripe_payment_process', array(self::$instance, 'atbdp_stripe_payment_process'));

                // license and auto update handler
                add_action('wp_ajax_atbdp_stripe_license_activation', array(self::$instance, 'atbdp_stripe_license_activation'));
                // license deactivation
                add_action('wp_ajax_atbdp_stripe_license_deactivation', array(self::$instance, 'atbdp_stripe_license_deactivation'));

                add_action('template_redirect', [self::$instance, 'stripe_checkout_session_response']);

                //vat controller
                add_filter('directorist_plan_tax', array(self::$instance, 'directorist_plan_tax'), 10, 2);
                if (!class_exists('ATBDP_Pricing_Plans')) {
                    add_filter('atbdp_checkout_form_final_data', array(self::$instance, 'atpp_checkout_form_data'), 12, 2);
                    add_filter('directorist_payment_receipt_data', array(self::$instance, 'directorist_payment_receipt_data'), 11, 4);
                    if (!class_exists('SWBDPCoupon')) {
                        add_filter('atbdp_order_amount', array(self::$instance, 'atbdp_order_amount'), 11, 2);
                        add_filter('directorist_stripe_gateway_total', array(self::$instance, 'directorist_stripe_gateway_total'), 10, 2);
                    }
                }

                add_action('init', [self::$instance, 'directorist_stripe_webhooks']);
				
            }

            return self::$instance;
        }
		
		public function update_controller() {
            $data = get_user_meta( get_current_user_id(), '_plugins_available_in_subscriptions', true );
            $license_key = ! empty( $data['directorist-stripe'] ) ? $data['directorist-stripe']['license'] : '';
            // setup the updater
            new EDD_SL_Plugin_Updater(ATBDP_AUTHOR_URL, __FILE__, array(
                'version' => DT_STRIPE_VERSION,        // current version number
                'license' => $license_key,    // license key (used get_option above to retrieve from DB)
                'item_id' => ATBDP_STRIPE_POST_ID,    // id of this plugin
                'author' => 'AazzTech',    // author of this plugin
                'url' => home_url(),
                'beta' => false // set to true if you wish customers to receive update notifications of beta releases
            ));
        }

        public function directorist_stripe_webhooks()
        {

            if ($this->use_sandbox) {

                $apiKey = get_directorist_option('stripe_test_sk');

                // update_option('directorist_stripe_webhooks', '');

                if (!get_option('directorist_stripe_webhooks') && !empty($apiKey)) {

                    $this->create_webhook($apiKey);

                    update_option('directorist_stripe_webhooks', true);
                }
            } else {

                $apiKey = get_directorist_option('stripe_live_sk');

                if (!get_option('directorist_stripe_live_webhooks') && !empty($apiKey)) {

                    $this->create_webhook($apiKey);

                    update_option('directorist_stripe_live_webhooks', true);
                }
            }
        }

        public function create_webhook($apiKey)
        {

            $stripe_repeated_lib = get_directorist_option('stripe_repeated_lib', 0);
           
            if (!class_exists('WPJobster_Stripe_Loader') && empty($stripe_repeated_lib) && !class_exists('Stripe\Stripe')) {
                require_once DT_STRIPE_LIB_DIR . 'init.php';
            }

            if (!class_exists('\Stripe\Stripe')) {
                echo "<div class='directorist-alert directorist-alert-danger'>" . __('Error: Stripe class dosen\'t exists', 'directorist-stripe') . "</div>";
                return;
            }

            // create weebhook listner to manage recurring payments
            try {
                $stripe = new \Stripe\StripeClient($apiKey);
                $stripe->webhookEndpoints->create([
                    'url' => site_url() . '/wp-json/directorist/subscription/updated',
                    'enabled_events' => [
                        'customer.subscription.updated',
                    ],
                ]);
            
            } catch (Exception $e) {
                echo "<div class='directorist-alert directorist-alert-danger'>{$e->getMessage()}</div>";
                return;
            }
        }

        public function directorist_stripe_gateway_total($total, $order_id)
        {

            if (!empty($this->tax_rate($total))) {
                $amount =  (float)$total - (float)$this->tax_rate();
                $total  = $amount;
            }
            return $total;
        }

        public function directorist_stripe_total_tax($price = null)
        {
            $price = !empty($price) ? (int) $price : get_directorist_option('featured_listing_price');
            $tax_rate = get_directorist_option('tex_rate');
            $tax = '';
            //return $price;
            if (!empty($price)) {
                $tax = ($tax_rate * $price) / 100;
            } else {
                $tax = $price;
            }
            return apply_filters('directorist_stripe_total_tax', $tax);
        }

        public function tax_rate($price = null)
        {
            return $this->directorist_stripe_total_tax($price);
        }

        public function atbdp_order_amount($total, $order_id)
        {

            if (!empty($this->tax_rate($total))) {
                $amount = (float)$total + (float)$this->tax_rate();
                $total  = $amount;
            }
            return $total;
        }

        public function directorist_payment_receipt_data($data, $order_id)
        {
            if (!empty($this->tax_rate)) {
                $order_items = array(
                    'title' => __('Tax', 'directorist-stripe'),
                    'desc' => '',
                    'price' => $this->tax_rate(),
                );
                $data['order_items']['tax'] = $order_items;
            }
            return $data;
        }

        public function atpp_checkout_form_data($data, $listing_id)
        {
            if (!empty($this->tax_rate)) {
                $data['tax'] = array(
                    'type' => 'checkbox',
                    'name' => '',
                    'value' => 1,
                    'selected' => 1,
                    'title' => __('Tax', 'directorist-stripe'),
                    'desc' => '',
                    'price' => $this->tax_rate(),
                );
            }

            return $data;
        }
        public function directorist_plan_tax($tax, $plan_id)
        {
            $fm_tax = (float) get_post_meta($plan_id, 'fm_tax', true);
            $plan_price = (float) get_post_meta($plan_id, 'fm_price', true);
            if (empty($fm_tax) || ('0' == $fm_tax)) {
                return (float) $this->tax_rate * $plan_price / 100;
            }
            return $tax;
        }

        /**
         * It adds our gateways to the active and default gateways list
         * @param array $gateways Arrays of all old gateways
         * @return array It returns the new gateways list after adding stripe gateways
         * @since 1.0.0
         */
        public function default_active_gateways($gateways)
        {
            $gateways[] = array(
                'value' => 'stripe_gateway',
                'label' => __('Stripe', 'directorist-stripe'),
            );
            return $gateways;
        }

        public function atbdp_listing_type_settings_field_list($stripe_fields)
        {
            $gsp = sprintf("<a target='_blank' href='%s'>%s</a>", esc_url(admin_url('edit.php?post_type=at_biz_dir&page=aazztech_settings#_gateway_general')), __('Gateway Settings Page', 'directorist-stripe'));
            $stripe_url = sprintf("<a target='_blank' href='%s'>%s</a>", esc_url("https://dashboard.stripe.com/account/apikeys"), __('Get your Stripe API keys', 'directorist-stripe'));

            $stripe_fields['stripe_gateway_test_mode'] = [
                'type'          => 'toggle',
                'label'         => __('Enable Test Mode', 'directorist'),
                'value'         => 1,
            ];
            $stripe_fields['stripe_gateway_title'] = [
                'type'              => 'text',
                'label'             => __('Gateway Title', 'directorist-stripe'),
                'description'       => __('Enter the title of this gateway that should be displayed to the user on the front end.', 'directorist-stripe'),
                'value'             => esc_html__('Stripe', 'directorist-stripe'),
            ];
            $stripe_fields['stripe_gateway_description'] = [
                'type'              => 'text',
                'label'             => __('Gateway Description', 'directorist-stripe'),
                'description'       => __('Enter some description for your user to make payment using stripe.', 'directorist-stripe'),
                'value'             => __('You can make payment using your credit card using stripe if you choose this payment gateway.', 'directorist-stripe')
            ];
            $stripe_fields['stripe_live_pk'] = [
                'type'              => 'text',
                'label'             => __('Live Publishable Key', 'directorist-stripe'),
                'description'       => sprintf(__('Enter your Stripe Live Publishable Key Here. You can find your API key on your Stripe Dashboard Under Developers > API section. %s', 'directorist-stripe'), $stripe_url),
                'value'             => ''
            ];
            $stripe_fields['stripe_live_sk'] = [
                'type'              => 'text',
                'label'             => __('Live Secret Key', 'directorist-stripe'),
                'description'       => sprintf(__('Enter your Stripe Live Secret Key Here. You can find your API key on your Stripe Dashboard Under Developers > API section. %s', 'directorist-stripe'), $stripe_url),
                'value'             => ''
            ];
            $stripe_fields['stripe_test_pk'] = [
                'type'              => 'text',
                'label'             => __('Test Publishable Key', 'directorist-stripe'),
                'description'       => sprintf(__('Enter your Stripe Test Publishable Key Here. You can find your API key on your Stripe Dashboard Under Developers > API section. %s', 'directorist-stripe'), $stripe_url),
                'value'             => ''
            ];
            $stripe_fields['stripe_test_sk'] = [
                'type'              => 'text',
                'label'             => __('Test Secret Key', 'directorist-stripe'),
                'description'       => sprintf(__('Enter your Stripe Test Secret Key Here. You can find your API key on your Stripe Dashboard Under Developers > API section. %s', 'directorist-stripe'), $stripe_url),
                'value'             => ''
            ];
            $stripe_fields['tex_rate'] = [
                'label'       => __('Default Percentage Vat Rate', 'directorist-stripe'),
                'type'        => 'number',
                'value'       => 0,
                'placeholder' => '0',
                'rules' => [
                    'required'  => false,
                    'min'       => '0',
                    'max'       => '100',
                ],
            ];
            $stripe_fields['stripe_repeated_lib'] = [
                'label'             => __('Solve Repeated Library Conflict', 'directorist-live-chat'),
                'type'              => 'toggle',
                'value'             => false,
            ];

            return $stripe_fields;
        }

        public function atbdp_monetization_settings_submenu($submenu)
        {
            $submenu['stripe'] = [
                'label'      => __('Stripe Gateway', 'directorist-stripe'),
                'icon'       => '<i class="fa fa-cc-stripe"></i>',
                'sections'   => apply_filters('atbdp_stripe_settings_controls', [
                    'gateways' => [
                        'title'         => __('Stripe Gateway Settings', 'directorist-stripe'),
                        'description'   => __('You can customize all the settings related to your stripe gateway. After switching any option, Do not forget to save the changes.', 'directorist-stripe'),
                        'fields'        =>  ['stripe_gateway_test_mode', 'stripe_gateway_title', 'stripe_gateway_description', 'stripe_live_pk', 'stripe_live_sk', 'stripe_test_pk', 'stripe_test_sk', 'tex_rate', 'stripe_repeated_lib'],
                    ],
                ]),
            ];

            return $submenu;
        }

        public function atbdp_stripe_license_deactivation()
        {
            $license = !empty($_POST['stripe_license']) ? trim($_POST['stripe_license']) : '';
            $options = get_option('atbdp_option');
            $options['stripe_license'] = $license;
            update_option('atbdp_option', $options);
            update_option('directorist_stripe_license', $license);
            $data = array();
            if (!empty($license)) {
                // data to send in our API request
                $api_params = array(
                    'edd_action' => 'deactivate_license',
                    'license' => $license,
                    'item_id' => ATBDP_STRIPE_POST_ID, // The ID of the item in EDD
                    'url' => home_url()
                );
                // Call the custom API.
                $response = wp_remote_post(ATBDP_AUTHOR_URL, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
                // make sure the response came back okay
                if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

                    $data['msg'] = (is_wp_error($response) && !empty($response->get_error_message())) ? $response->get_error_message() : __('An error occurred, please try again.', 'directorist-stripe');
                    $data['status'] = false;
                } else {
                    $license_data = json_decode(wp_remote_retrieve_body($response));

                    if (!$license_data) {
                        $data['status'] = false;
                        $data['msg'] = __('Response not found!', 'directorist-stripe');
                        wp_send_json($data);
                        die();
                    }

                    update_option('directorist_stripe_license_status', $license_data->license);

                    if (false === $license_data->success) {
                        switch ($license_data->error) {
                            case 'expired':
                                $data['msg'] = sprintf(
                                    __('Your license key expired on %s.', 'directorist-stripe'),
                                    date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                                );
                                $data['status'] = false;
                                break;

                            case 'revoked':
                                $data['status'] = false;
                                $data['msg'] = __('Your license key has been disabled.', 'directorist-stripe');
                                break;

                            case 'missing':

                                $data['msg'] = __('Invalid license.', 'directorist-stripe');
                                $data['status'] = false;
                                break;

                            case 'invalid':
                            case 'site_inactive':

                                $data['msg'] = __('Your license is not active for this URL.', 'directorist-stripe');
                                $data['status'] = false;
                                break;

                            case 'item_name_mismatch':

                                $data['msg'] = sprintf(__('This appears to be an invalid license key for %s.', 'directorist-stripe'), 'Directorist - Stripe');
                                $data['status'] = false;
                                break;

                            case 'no_activations_left':

                                $data['msg'] = __('Your license key has reached its activation limit.', 'directorist-stripe');
                                $data['status'] = false;
                                break;

                            default:
                                $data['msg'] = __('An error occurred, please try again.', 'directorist-stripe');
                                $data['status'] = false;
                                break;
                        }
                    } else {
                        $data['status'] = true;
                        $data['msg'] = __('License deactivated successfully!', 'directorist-stripe');
                    }
                }
            } else {
                $data['status'] = false;
                $data['msg'] = __('License not found!', 'directorist-stripe');
            }
            wp_send_json($data);
            die();
        }

        public function atbdp_stripe_license_activation()
        {
            $license = !empty($_POST['stripe_license']) ? trim($_POST['stripe_license']) : '';
            $options = get_option('atbdp_option');
            $options['stripe_license'] = $license;
            update_option('atbdp_option', $options);
            update_option('directorist_stripe_license', $license);
            $data = array();
            if (!empty($license)) {
                // data to send in our API request
                $api_params = array(
                    'edd_action' => 'activate_license',
                    'license' => $license,
                    'item_id' => ATBDP_STRIPE_POST_ID, // The ID of the item in EDD
                    'url' => home_url()
                );
                // Call the custom API.
                $response = wp_remote_post(ATBDP_AUTHOR_URL, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
                // make sure the response came back okay
                if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

                    $data['msg'] = (is_wp_error($response) && !empty($response->get_error_message())) ? $response->get_error_message() : __('An error occurred, please try again.', 'directorist-stripe');
                    $data['status'] = false;
                } else {

                    $license_data = json_decode(wp_remote_retrieve_body($response));
                    if (!$license_data) {
                        $data['status'] = false;
                        $data['msg'] = __('Response not found!', 'directorist-stripe');
                        wp_send_json($data);
                        die();
                    }
                    update_option('directorist_stripe_license_status', $license_data->license);
                    if (false === $license_data->success) {
                        switch ($license_data->error) {
                            case 'expired':
                                $data['msg'] = sprintf(
                                    __('Your license key expired on %s.', 'directorist-stripe'),
                                    date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                                );
                                $data['status'] = false;
                                break;

                            case 'revoked':
                                $data['status'] = false;
                                $data['msg'] = __('Your license key has been disabled.', 'directorist-stripe');
                                break;

                            case 'missing':

                                $data['msg'] = __('Invalid license.', 'directorist-stripe');
                                $data['status'] = false;
                                break;

                            case 'invalid':
                            case 'site_inactive':

                                $data['msg'] = __('Your license is not active for this URL.', 'directorist-stripe');
                                $data['status'] = false;
                                break;

                            case 'item_name_mismatch':

                                $data['msg'] = sprintf(__('This appears to be an invalid license key for %s.', 'directorist-stripe'), 'Directorist - Stripe');
                                $data['status'] = false;
                                break;

                            case 'no_activations_left':

                                $data['msg'] = __('Your license key has reached its activation limit.', 'directorist-stripe');
                                $data['status'] = false;
                                break;

                            default:
                                $data['msg'] = __('An error occurred, please try again.', 'directorist-stripe');
                                $data['status'] = false;
                                break;
                        }
                    } else {
                        $data['status'] = true;
                        $data['msg'] = __('License activated successfully!', 'directorist-stripe');
                    }
                }
            } else {
                $data['status'] = false;
                $data['msg'] = __('License not found!', 'directorist-stripe');
            }
            wp_send_json($data);
            die();
        }

        /**
         * It process the payment of the given order
         * @param int $order_id
         * @since 1.0.0
         */
        public function process_payment($order_id)
        {
            $active_gateways        = get_directorist_option('active_gateways');
            $currency               = get_directorist_option('payment_currency', get_directorist_option('g_currency', 'usd'));
            $tex_rate               = apply_filters('directorist_stripe_gateway_tax_rate', get_directorist_option('tex_rate'), $order_id);
            $stripe_repeated_lib    = get_directorist_option('stripe_repeated_lib', 0);

            $listing_id             = get_post_meta($order_id, '_listing_id', true);
            $plan_form_order        = get_post_meta($order_id, '_fm_plan_ordered', true);
            $plan_form_listing      = get_post_meta($listing_id, '_fm_plans', true);
            $plan                   = $plan_form_listing ? $plan_form_listing : $plan_form_order;
            $plan                   = ! empty( $_POST['confirmed'] ) ? $plan_form_order : $plan;
            $has_recurrence         = get_post_meta($plan, '_atpp_recurring', true);
            $plan_name              = get_the_title($plan);
            $amount                 = apply_filters('directorist_stripe_gateway_total', get_post_meta($order_id, '_amount', true), $order_id);

            if (in_array('stripe_gateway', $active_gateways)) {
                wp_enqueue_script('directorist-stripe-js');
                wp_enqueue_script('stripe-js-v3');
                wp_enqueue_style('dt-stripe-style');
            }

            $currency = get_directorist_option('payment_currency', get_directorist_option('g_currency', 'usd'));

            // get proper secret & publishable key based on the environment
            $recurring              = get_post_meta($order_id, '_recurring', true);
            $old_customer_id        = get_user_meta( get_current_user_id(), '_stripe_customer_key', true );
            $recurrence_period_term = get_post_meta($plan, '_recurrence_period_term', true);
            $recurrence_time        = get_post_meta($plan, 'fm_length', true);
            $recurring              = !empty($recurring) ? $recurring : $has_recurrence;

            if ($this->use_sandbox) {
                $pk     = get_directorist_option('stripe_test_pk');
                $apiKey = get_directorist_option('stripe_test_sk');
            } else {
                $pk     = get_directorist_option('stripe_live_pk');
                $apiKey = get_directorist_option('stripe_live_sk');
            }

            $stripe_repeated_lib = get_directorist_option('stripe_repeated_lib', 0);
            if (!class_exists('WPJobster_Stripe_Loader') && empty($stripe_repeated_lib) && !class_exists('Stripe\Stripe')) {
                require_once DT_STRIPE_LIB_DIR . 'init.php';
            }


            if (!class_exists('\Stripe\Stripe')) {
                echo "<div class='directorist-alert directorist-alert-danger'>" . __('Error: Stripe class dosen\'t exists', 'directorist-stripe') . "</div>";
                return;
            }

            \Stripe\Stripe::setApiKey($apiKey);

            $amount = $amount * 100;


            // Search Product

            try {
                
                $query = [
                    'query' => 'active:\'true\' AND name~"'. $plan_name .'"',
                ];
                $product = \Stripe\Product::retrieve($query);

            }catch( Exception $e) {

            }

            try {
                // Create Product
                $args = [
                    'name' => $plan_name,
                    'metadata' => [
                        'order_id' => $order_id,
                    ]
                ];
                $product = \Stripe\Product::create($args);

                // Create Price
                $price_args = [
                    'product'     => $product->id,
                    'unit_amount' => (int) $amount,
                    'currency'    => $currency,
                    "metadata" => ["order_id" => $order_id]

                ];
                // If has recurring
                if ($recurring) {
                    $price_args['recurring'] = [
                        'interval'       => $recurrence_period_term,
                        'interval_count' => $recurrence_time,
                    ];
                }
            } catch (Exception $e) {
                echo "<div class='directorist-alert directorist-alert-danger'>{$e->getMessage()}</div>";
                return;
            }


            try {
                // Create price
                $price = \Stripe\Price::create(apply_filters('directorist_stripe_price_args', $price_args, $order_id));
            } catch (Exception $e) {
                echo "<div class='directorist-alert directorist-alert-danger'>{$e->getMessage()}</div>";
                return;
            }

            if ( ! $old_customer_id ) {
                try {
                    // Create customer
                    $current_user = get_user_by('ID', get_current_user_id());
    
                    $customer_profile = [];
    
                    if ($current_user) {
                        $customer_profile['name'] = $current_user->user_login;
                        $customer_profile['email'] = $current_user->user_email;
                    }
    
                    $phone = get_user_meta(get_current_user_id(), 'atbdp_phone', true);
                    if (!empty($phone)) {
                        $customer_profile['phone'] = $phone;
                    }
    
                    $customer_profile['metadata'] = ["order_id" => $order_id];
    
    
                    $customer = \Stripe\Customer::create($customer_profile);

                    update_user_meta( get_current_user_id(), '_stripe_customer_key', $customer->id );

                } catch (Exception $e) {
                    echo "<div class='directorist-alert directorist-alert-danger'>{$e->getMessage()}</div>";
                    return;
                }
            }

            

            // Prepare session args
            $session_args = [
                'customer'             => $old_customer_id ? $old_customer_id : $customer->id,
                'currency'             => $currency,
                'payment_method_types' => ['card'],
                'mode'                 => ($recurring) ? 'subscription' : 'payment',
                'line_items'           => [
                    ['price' => $price->id, 'quantity' => 1]
                ],
                'client_reference_id'  => $order_id,
                'success_url'          => home_url('checkout-session/?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url'           => ATBDP_Permalink::get_transaction_failure_page_link(),

            ];
            if( 'eur' === $currency ) {
                $session_args['payment_method_types'] = ['card', 'sepa_debit'];
            }
            if( ! $recurring ) {
                $session_args['invoice_creation'] = [ 'enabled' => true ];
            }

            //If has tax tax_placeholder
            if (!empty($tex_rate)) {
                try {
                    $tax_rate = \Stripe\TaxRate::create(apply_filters('directorist_stripe_tax_rate_arguments', array(
                        'display_name' => 'VAT',
                        'percentage'   => round($tex_rate, 2),
                        'inclusive'    => false,
                    )));

                    if ($recurring) {
                        $session_args['subscription_data'] = [
                            'default_tax_rates' => [$tax_rate->id],
                            "metadata"          => ["order_id" => $order_id, 'listing_id' => $listing_id],
                        ];
                    } else {
                        $session_args['line_items'][0]['tax_rates'] = [$tax_rate->id];
                    }
                } catch (Exception $e) {
                    echo "<div class='directorist-alert directorist-alert-danger'>{$e->getMessage()}</div>";
                    return;
                }
            }


            try {
                // Create Checkout Session
                $session = \Stripe\Checkout\Session::create(apply_filters('directorist_stripe_checkout_session_args', $session_args, $order_id, $apiKey));
                $data = ['session_id' => $session->id, 'publish_key' => $pk];
                $alert_msg = __('Please wait...', 'directorist-stripe');
                echo "<div class='directorist-alert directorist-alert-info directorist-stripe-info-alert'>{$alert_msg}</div>";

                $this->register_styles_scripts();
                wp_localize_script('directorist-stripe-js', 'atbdp_paMentObj', $data);
            } catch (Exception $e) {
                echo "<div class='directorist-alert directorist-alert-danger'>{$e->getMessage()}</div>";
                return;
            }
        }

        // stripe_checkout_session_response
        public function stripe_checkout_session_response()
        {
            global $wp;
            $current_page_slug = $wp->request;
            if ('checkout-session' !== $current_page_slug) {
                return;
            }

            // Load the Stripe
            $stripe_repeated_lib = get_directorist_option('stripe_repeated_lib', 0);
            if (!class_exists('WPJobster_Stripe_Loader') && empty($stripe_repeated_lib) && !class_exists('Stripe\Stripe')) {
                require_once DT_STRIPE_LIB_DIR . 'init.php';
            }

            if (!class_exists('\Stripe\Stripe')) {
                echo "<div class='directorist-alert directorist-alert-danger'>" . __('Error: Stripe class dosen\'t exists', 'directorist-stripe') . "</div>";
                return;
            }

            if ($this->use_sandbox) {
                $apiKey = get_directorist_option('stripe_test_sk');
            } else {
                $apiKey = get_directorist_option('stripe_live_sk');
            }

            // Set the API
            \Stripe\Stripe::setApiKey($apiKey);

            $sassion_id = ($_REQUEST['session_id']) ? $_REQUEST['session_id'] : '';
            $checkout_session = \Stripe\Checkout\Session::retrieve($sassion_id);

            if (!$checkout_session) {
                return;
            }

            $payment_status = $checkout_session->payment_status;

            // Redirect to transaction failure page if payment is not paid
            if ('paid' !== $payment_status) {
                wp_redirect(ATBDP_Permalink::get_transaction_failure_page_link());
                exit;
            }

            $order_id       = $checkout_session->client_reference_id;
            $mode           = $checkout_session->mode;
            $transaction_id = ('subscription' === $mode) ? $checkout_session->subscription : $checkout_session->payment_intent;

            $this->complete_order(
                ['ID' => $order_id, 'transaction_id' => $transaction_id]
            );

            wp_redirect(ATBDP_Permalink::get_payment_receipt_page_link($order_id));
            exit;
        }

        public function atbdp_stripe_payment_success()
        {
            // payment succeeded, redirect to success page and create order
            $order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : '';
            $transaction_id = isset($_POST['tns_id']) ? $_POST['tns_id'] : '';
            $this->complete_order(
                array(
                    'ID' => $order_id,
                    'transaction_id' => $transaction_id,
                )
            );
            $result = array('result' => true);
            //                return json_encode($result);
            wp_send_json_success($result);
        }

        /**
         * Setup Directorist Stripe's plugin constants.
         *
         * @access private
         * @return void
         * @since 1.0.0
         */
        private function setup_constants()
        {
            if (!defined('DT_STRIPE_FILE')) {
                define('DT_STRIPE_FILE', __FILE__);
            }

            require_once plugin_dir_path(__FILE__) . 'const-helper.php'; // loads constant from a file so that it can be available on all files.
            require_once plugin_dir_path(__FILE__) . 'constants.php'; // loads constant from a file so that it can be available on all files.
        }

        /**
         *It includes required files and library needed by our class
         * @since 1.0.0
         */
        private function includes()
        {
            require_once plugin_dir_path(__FILE__) . 'helper.php';
            // setup the updater
            if (!class_exists('EDD_SL_Plugin_Updater')) {
                // load our custom updater if it doesn't already exist
                include(dirname(__FILE__) . '/inc/EDD_SL_Plugin_Updater.php');
            }
            
        }

        public function load_needed_scripts_admin()
        {
            if (isset($_GET['page']) && ('aazztech_settings' === $_GET['page'])) {
                wp_enqueue_style('stripe_main_css', plugin_dir_url(__FILE__) . 'assets/admin/main.css');
                wp_enqueue_script('stripe_main_js', plugin_dir_url(__FILE__) . 'assets/admin/main.js', array('jquery'));
                wp_localize_script('stripe_main_js', 'stripe_js_obj', array('ajaxurl' => admin_url('admin-ajax.php')));
            }
        }

        /**
         * It loads plugin text domain
         * @since 1.0.0
         */
        public function load_textdomain()
        {
            load_plugin_textdomain('directorist-stripe', false, DT_STRIPE_LANG_DIR);
        }

        public function license_settings_controls($default)
        {
            $status = get_option('directorist_stripe_license_status');
            if (!empty($status) && ($status !== false && $status == 'valid')) {
                $action = array(
                    'type' => 'toggle',
                    'name' => 'stripe_deactivated',
                    'label' => __('Action', 'directorist-stripe'),
                    'validation' => 'numeric',
                );
            } else {
                $action = array(
                    'type' => 'toggle',
                    'name' => 'stripe_activated',
                    'label' => __('Action', 'directorist-stripe'),
                    'validation' => 'numeric',
                );
            }
            $new = apply_filters('atbdp_stripe_license_controls', array(
                'type' => 'section',
                'title' => __('Stripe', 'directorist-stripe'),
                'description' => __('You can active your Stripe extension here.', 'directorist-stripe'),
                'fields' => apply_filters('atbdp_stripe_license_settings_field', array(
                    array(
                        'type' => 'textbox',
                        'name' => 'stripe_license',
                        'label' => __('License', 'directorist-stripe'),
                        'description' => __('Enter your Stripe extension license', 'directorist-stripe'),
                        'default' => '',
                    ),
                    $action,
                )),
            ));
            $settings = apply_filters('atbdp_licence_menu_for_stripe', true);
            if ($settings) {
                array_push($default, $new);
            }
            return $default;
        }

        /**
         * It register the settings fields of stripe gateway
         * @return array It returns an array of stripe settings fields array
         * @since 1.0.0
         */
        public function get_stripe_gateway_settings_fields()
        {
            $gsp = sprintf("<a target='_blank' href='%s'>%s</a>", esc_url(admin_url('edit.php?post_type=at_biz_dir&page=aazztech_settings#_gateway_general')), __('Gateway Settings Page', 'directorist-stripe'));
            $stripe_url = sprintf("<a target='_blank' href='%s'>%s</a>", esc_url("https://dashboard.stripe.com/account/apikeys"), __('Get your Stripe API keys', 'directorist-stripe'));

            return apply_filters(
                'atbdp_stripe_gateway_settings_fields',
                array(
                    array(
                        'type' => 'notebox',
                        'name' => 'stripe_gateway_note',
                        'label' => __('Note About Stripe Gateway:', 'directorist-stripe'),
                        'description' => sprintf(__('If you want to use Stripe for a testing purpose, you should set Test MODE to Yes on The %s.', 'directorist-stripe'), $gsp),
                        'status' => 'info',
                    ),
                    array(
                        'type' => 'textbox',
                        'name' => 'stripe_gateway_title',
                        'label' => __('Gateway Title', 'directorist-stripe'),
                        'description' => __('Enter the title of this gateway that should be displayed to the user on the front end.', 'directorist-stripe'),
                        'default' => esc_html__('Stripe', 'directorist-stripe'),
                    ),
                    array(
                        'type' => 'textarea',
                        'name' => 'stripe_gateway_description',
                        'label' => __('Gateway Description', 'directorist-stripe'),
                        'description' => __('Enter some description for your user to make payment using stripe.', 'directorist-stripe'),
                        'default' => __('You can make payment using your credit card using stripe if you choose this payment gateway.', 'directorist-stripe')
                    ),
                    array(
                        'type' => 'textbox',
                        'name' => 'stripe_live_pk',
                        'label' => __('Live Publishable Key', 'directorist-stripe'),
                        'description' => sprintf(__('Enter your Stripe Live Publishable Key Here. You can find your API key on your Stripe Dashboard Under Developers > API section. %s', 'directorist-stripe'), $stripe_url),
                        'default' => '',
                    ),
                    array(
                        'type' => 'textbox',
                        'name' => 'stripe_live_sk',
                        'label' => __('Live Secret Key', 'directorist-stripe'),
                        'description' => sprintf(__('Enter your Stripe Live Secret Key Here. You can find your API key on your Stripe Dashboard Under Developers > API section. %s', 'directorist-stripe'), $stripe_url),
                        'default' => '',
                    ),
                    array(
                        'type' => 'textbox',
                        'name' => 'stripe_test_pk',
                        'label' => __('Test Publishable Key', 'directorist-stripe'),
                        'description' => sprintf(__('Enter your Stripe Test Publishable Key Here. You can find your API key on your Stripe Dashboard Under Developers > API section. %s', 'directorist-stripe'), $stripe_url),
                        'default' => '',
                    ),
                    array(
                        'type' => 'textbox',
                        'name' => 'stripe_test_sk',
                        'label' => __('Test Secret Key', 'directorist-stripe'),
                        'description' => sprintf(__('Enter your Stripe Test Secret Key Here. You can find your API key on your Stripe Dashboard Under Developers > API section. %s', 'directorist-stripe'), $stripe_url),
                        'default' => '',
                    ),
                    array(
                        'type' => 'slider',
                        'name' => 'tex_rate',
                        'label' => __('Default Vat Rate', 'directorist-stripe'),
                        'description' => __('It only works with Subscription/Recurring pricing plan', 'directorist-stripe'),
                        'min' => '0',
                        'max' => '100',
                        'step' => '.5',
                        'default' => '0',
                    ),
                    array(
                        'type' => 'toggle',
                        'name' => 'stripe_repeated_lib',
                        'label' => __('Solve Repeated Library Conflict', 'directorist-stripe'),
                        'default' => 0,
                    ),
                )
            );
        }

        /**
         * It completes order
         * @param $order_data
         * @since 1.0.0
         * @todo; think if it is better to move this to Order Class later
         */
        private function complete_order($order_data)
        {
            // add payment status, tnx_id etc.
            update_post_meta($order_data['ID'], '_payment_status', 'completed');
            update_post_meta($order_data['ID'], '_transaction_id', $order_data['transaction_id']);
            // If the order has featured, make the related listing featured.
            $featured = get_post_meta($order_data['ID'], '_featured', true);
            // use given listing id or fetch the ID
            $listing_id = !empty($order_data['listing_id']) ? $order_data['listing_id'] : get_post_meta($order_data['ID'], '_listing_id', true);
            $directory_type = get_post_meta($listing_id, '_directory_type', true);
            $new_l_status = get_directorist_type_option($directory_type, 'new_listing_status', 'pending');
            if (!empty($featured)) {
                update_post_meta($listing_id, '_featured', 1);
            }
            if (get_post_status($listing_id) != 'publish') {
                $plan_id = get_post_meta($listing_id, '_fm_plans', true);
                $package_length = get_post_meta($plan_id, 'fm_length', true);
                $fm_length_unl = get_post_meta($plan_id, 'fm_length_unl', true);
                $package_length = $package_length ? $package_length : '1';
                // Current time
                $current_d = current_time('mysql');
                // Calculate new date
                $date = new DateTime($current_d);
                $date->add(new DateInterval("P{$package_length}D")); // set the interval in days
                $expired_date = $date->format('Y-m-d H:i:s');
                // is it renewal order? yes, lets update the listing according to plan
                $is_renewal = get_post_meta($listing_id, '_renew_with_plan', true);
                if (!empty($is_renewal)) {
                    $time = current_time('mysql');
                    $post_array = array(
                        'ID' => $listing_id,
                        'post_status' => 'publish',
                        'post_date' => $time,
                        'post_date_gmt' => get_gmt_from_date($time)
                    );
                    //Updating listing
                    wp_update_post($post_array);

                    // Update the post_meta into the database && update related post metas
                    if (!empty($fm_length_unl)) {
                        update_post_meta($listing_id, '_never_expire', 1);
                    } else {

                        update_post_meta($listing_id, '_expiry_date', $expired_date);
                    }
                    update_post_meta($listing_id, '_listing_status', 'post_status');
                } else {
                    $my_post = array();
                    $my_post['ID'] = $listing_id;
                    $my_post['post_status'] = $new_l_status;
                    wp_update_post($my_post);
                }
            }
            // Order has been completed. Let's fire a hook for a developer to extend if they wish
            do_action('atbdp_order_completed', $order_data['ID'], $listing_id);
        }


        /**
         * It registers scripts and styles needed for directorist stripe extension
         */
        public function register_styles_scripts()
        {
            wp_register_script('stripe-js-v3', esc_url('https://js.stripe.com/v3/'), null, DT_STRIPE_VERSION, true);
            wp_register_script('directorist-stripe-js', DT_STRIPE_URL . 'assets/js/directorist-stripe.js', array('jquery', 'stripe-js-v3'), DT_STRIPE_VERSION, true);
            wp_register_script('directorist-stripe-common-js', DT_STRIPE_URL . 'assets/js/common.js', array('jquery', 'stripe-js-v3'), DT_STRIPE_VERSION, true);

            wp_register_style('dt-stripe-style', DT_STRIPE_URL . 'assets/css/directorist-stripe.css', null, DT_STRIPE_VERSION);
        }

        /**
         * It enqueues our scripts and styles
         */
        public function enqueue_styles_scripts()
        {
            $active_gateways = get_directorist_option('active_gateways');

            if (!in_array('stripe_gateway', $active_gateways)) {
                return;
            }

            if ($this->use_sandbox) {
                $pk = get_directorist_option('stripe_test_pk');
            } else {
                $pk = get_directorist_option('stripe_live_pk');
            }

            $this->register_styles_scripts();

            wp_localize_script('directorist-stripe-common-js', 'atbdp_commonObj', array('publish_key' => $pk, 'payNow' => __('Pay Now', 'directorist-stripe'), 'processNow' => __('Process Now', 'directorist-stripe'), 'complete' => __('Complete Submission', 'directorist-stripe')));

            wp_enqueue_style('dt-stripe-style');
            wp_enqueue_script('directorist-stripe-common-js');
        }
    }

    if (!function_exists('directorist_is_plugin_active')) {
        function directorist_is_plugin_active($plugin)
        {
            return in_array($plugin, (array) get_option('active_plugins', array()), true) || directorist_is_plugin_active_for_network($plugin);
        }
    }

    if (!function_exists('directorist_is_plugin_active_for_network')) {
        function directorist_is_plugin_active_for_network($plugin)
        {
            if (!is_multisite()) {
                return false;
            }

            $plugins = get_site_option('active_sitewide_plugins');
            if (isset($plugins[$plugin])) {
                return true;
            }

            return false;
        }
    }

    /**
     * The main function for that returns Directorist_Stripe_Gateway
     * @return Directorist_Stripe_Gateway
     */
    function Directorist_Stripe()
    {
        return Directorist_Stripe_Gateway::instance();
    }

    // Instantiate Directorist Stripe gateway only if our directorist plugin is active
    if (directorist_is_plugin_active('directorist/directorist-base.php')) {
        Directorist_Stripe();
    }
}
