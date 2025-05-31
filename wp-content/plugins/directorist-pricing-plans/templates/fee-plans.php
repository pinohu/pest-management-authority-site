<?php
use Directoirst\Helper;
// Exit if accessed directly
if (!defined('ABSPATH')) exit;
/**
 * Fire before pricing plan loaded
 */
do_action('atbdp_before_plan_page_loaded');

$atts = !empty($args['atts']) ? $args['atts'] : '';
$atts = shortcode_atts(
    array(
        'id' => '',
        'columns' => 3
    ),
    $atts
);

$plans_id = !empty($atts['id']) ? explode(',', $atts['id']) : '';

$shortcode_id = ( !empty($atts['id']) && 1 == count( $plans_id ) )  ? $atts['id'] : '';
$columns = !empty($atts['columns']) ? $atts['columns'] : 3;
$columns = 12 / $columns;
$private_plan = !empty($shortcode_id) ? 'EXISTS' : 'NOT EXISTS';
$price_column_width = 100 / $columns . '%';
$listing_type = isset($_GET['directory_type']) ? sanitize_text_field($_GET['directory_type']) : '';
$submission_form_fields = [];
$listing_type = !empty( $listing_type ) ? $listing_type : default_directory_type();
$term = get_term_by( is_numeric( $listing_type ) ? 'id' : 'slug', $listing_type, 'atbdp_listing_types');
if ( $listing_type && $term ) {
    $submission_form        = get_term_meta($term->term_id, 'submission_form_fields', true);
    $submission_form_fields = $submission_form['fields'];
    $submission_form_fields = swbd_pricing_plan__include_additional_submission_fields( [ 'submission_form_fields' => $submission_form_fields ] );
}


?>
<div id="directorist-pricing-plan-container" <?php do_action('atbdp_plans_container_div_attribute'); ?>>
    <div class="directorist-container-fluid">

        <?php
        if( ! $plans_id ) {
            $types = directory_types();
            if( directorist_multi_directory() && count( $types ) > 1 ){
                ATBDP_Pricing_Plans()->load_template('directory_types', [ 'directory_types' => $types ] );
            }
        }
        
        ?>

        <div class="directorist-row directorist-justify-content-center">
            <?php
            
            $meta_queries = array();
            $args = array(
                'post_type' => 'atbdp_pricing_plans',
                'posts_per_page' => -1,
                'status' => 'publish',
            );

            $meta_queries[] = array(
                'relation' => 'OR',
                array(
                    'key' => '_hide_from_plans',
                    'compare' => $private_plan,
                ),
                array(
                    'key' => '_hide_from_plans',
                    'value' => 'yes',
                    'compare' => '!=',
                ),
            );

            if (!empty($listing_type) && empty( $plans_id ) ) {
                $meta_queries['directory_type'] = [
                    'key' => '_assign_to_directory',
                    'value' => $term->term_id,
                    'compare' => '=',
                ];
            }

            $meta_queries = apply_filters('atbdp_plan_meta_query', $meta_queries);
            $count_meta_queries = count($meta_queries);
            if ($count_meta_queries) {
                $args['meta_query'] = ($count_meta_queries > 1) ? array_merge(array('relation' => 'AND'), $meta_queries) : $meta_queries;
            }

            /**
             * Filters the order of pricing plans.
             *
             * This filter allows customization of the order in which pricing plans are displayed.
             *
             * @since 3.2.5
             *
             * @param array $plans_id An array of pricing plan IDs, ordered as needed.
             * @param array $atts     Additional attributes or parameters that may influence the order.
             *
             * @return array Filtered array of pricing plan IDs.
             */
            $plans_id = apply_filters( 'directorist_pricing_plans_plan_order', $plans_id, $atts );

            if (!empty($plans_id)) {
                $args['post__in'] = $plans_id;
                $args['orderby']    = 'post__in';
            }

            /**
             * Filters the query arguments used for retrieving pricing plans.
             *
             * This filter allows customization of the query arguments for retrieving
             * pricing plans, providing developers the ability to modify or extend
             * the behavior based on their specific needs.
             *
             * @since 3.2.5
             *
             * @param array $args The query arguments used for fetching pricing plans.
             * @param array $atts Additional attributes or parameters that may influence the order.
             * 
             * @return array Modified query arguments.
             */
            $args = apply_filters('directorist_pricing_plans_query_args', $args);

            $atbdp_query = new WP_Query($args);
            $has_plan = $atbdp_query->have_posts();

        $plans = $atbdp_query->posts;

        if ($has_plan && $plans) {
            global $post;
            foreach ($plans as $key => $value) {
                $plan_id           = $value->ID;
                $plan_id           = !empty($shortcode_id) ? $shortcode_id : $plan_id;
                $plan_metas        = get_post_meta($plan_id);
                $unl               = __('Unlimited', 'directorist-pricing-plans');
                $fm_price          = atpp_total_price($plan_id);
                $fm_price          = atbdp_format_payment_amount($fm_price);
                $fm_tax            = atpp_total_tax($plan_id);
                $fm_tax            = atbdp_format_payment_amount($fm_tax);
                $tax_placeholder   = get_directorist_option('tax_placeholder', 'tax');
                $fm_length         = isset($plan_metas['fm_length'][0]) ? esc_attr($plan_metas['fm_length'][0]) : '';
                $recurring         = isset($plan_metas['_atpp_recurring'][0]) ? esc_attr($plan_metas['_atpp_recurring'][0]) : '';
                $hide_recurring    = isset($plan_metas['hide_recurring'][0]) ? esc_attr($plan_metas['hide_recurring'][0]) : '';
                $recurrence_period = isset($plan_metas['_recurrence_period_term'][0]) ? esc_attr($plan_metas['_recurrence_period_term'][0]) : '';
                $recurrence_time   = isset($plan_metas['_recurrence_time'][0]) ? esc_attr($plan_metas['_recurrence_time'][0]) : '';
                $fm_length_unl     = isset($plan_metas['fm_length_unl'][0]) ? esc_attr($plan_metas['fm_length_unl'][0]) : '';
                $num_regular       = isset($plan_metas['num_regular'][0]) ? esc_attr($plan_metas['num_regular'][0]) : '';
                $num_regular_unl   = isset($plan_metas['num_regular_unl'][0]) ? esc_attr($plan_metas['num_regular_unl'][0]) : '';
                $num_featured      = isset($plan_metas['num_featured'][0]) ? esc_attr($plan_metas['num_featured'][0]) : '';
                $num_featured_unl  = isset($plan_metas['num_featured_unl'][0]) ? esc_attr($plan_metas['num_featured_unl'][0]) : '';
                $cf_owner          = isset($plan_metas['cf_owner'][0]) ? esc_attr($plan_metas['cf_owner'][0]) : '';
                $fm_cs_review      = isset($plan_metas['fm_cs_review'][0]) ? esc_attr($plan_metas['fm_cs_review'][0]) : '';
                $default_pln       = isset($plan_metas['default_pln'][0]) ? esc_attr($plan_metas['default_pln'][0]) : '';
                $fm_claim          = isset($plan_metas['_fm_claim'][0]) ? esc_attr($plan_metas['_fm_claim'][0]) : '';
                $hide_claim        = isset($plan_metas['_hide_claim'][0]) ? esc_attr($plan_metas['_hide_claim'][0]) : '';
                $plan_type        = isset($plan_metas['plan_type'][0]) ? esc_attr($plan_metas['plan_type'][0]) : '';
                $hide_featured     = isset($plan_metas['hide_listing_featured'][0]) ? esc_attr($plan_metas['hide_listing_featured'][0]) : '';

                    // Booking
                    $fm_booking   = isset($plan_metas['_fm_booking'][0]) ? esc_attr($plan_metas['_fm_booking'][0]) : '';
                    $hide_booking = isset($plan_metas['_hide_booking'][0]) ? esc_attr($plan_metas['_hide_booking'][0]) : '';

                    // Live Chat
                    $fm_live_chat   = isset($plan_metas['_fm_live_chat'][0]) ? esc_attr($plan_metas['_fm_live_chat'][0]) : '';
                    $hide_live_chat = isset($plan_metas['_hide_live_chat'][0]) ? esc_attr($plan_metas['_hide_live_chat'][0]) : '';

                    // Mark as Sold
                    $fm_mark_as_sold   = isset($plan_metas['_fm_mark_as_sold'][0]) ? esc_attr($plan_metas['_fm_mark_as_sold'][0]) : '';
                    $hide_mark_as_sold = isset($plan_metas['_hide_mark_as_sold'][0]) ? esc_attr($plan_metas['_hide_mark_as_sold'][0]) : '';

                    if (is_user_logged_in()) {
                        $active_plan = subscribed_package_or_PPL_plans(get_current_user_id(), 'completed', $plan_id);
                    } else {
                        $active_plan = false;
                    }

                    $fresh_active_order = directorist_active_orders_without_listing( $plan_id );
                    $is_active         = false;

                    if( 'package' === package_or_PPL( $plan_id ) && $active_plan ){
                        $is_active = true;
                    }

                    if( 'package' !== package_or_PPL( $plan_id ) && $fresh_active_order ){
                        $is_active = true;
                    }

                    $currency = atbdp_get_payment_currency();
                    $symbol = atbdp_currency_symbol($currency);
                    $c_position = get_directorist_option('payment_currency_position');
                    $before = '';
                    $after = '';
                    ('after' == $c_position) ? $after = $symbol : $before = $symbol;
                    $columns_class = 'directorist-col-md-' . $columns . ' atpp_' . strtolower($value->post_title);

                    switch( $recurrence_period ) {
                        case 'day';
                        $recurrence_period = ($fm_length > 1) ? $fm_length . ' ' . __( 'days', 'directorist-pricing-plans' ) : __( 'day', 'directorist-pricing-plans' );
                        break;

                        case 'week';
                        $recurrence_period = ($fm_length > 1) ? $fm_length . ' ' . __( 'weeks', 'directorist-pricing-plans' ) : __( 'week', 'directorist-pricing-plans' );
                        break;

                        case 'month';
                        $recurrence_period = ($fm_length > 1) ? $fm_length . ' ' . __( 'months', 'directorist-pricing-plans' ) : __( 'month', 'directorist-pricing-plans' );
                        break;

                        case 'year';
                        $recurrence_period = ($fm_length > 1) ? $fm_length . ' ' . __( 'years', 'directorist-pricing-plans' ) : __( 'year', 'directorist-pricing-plans' );
                        break;

                    }

                    $price_text = $recurrence_period;
                    if ($fm_length_unl) {
                        $price_text = __('Lifetime', 'directorist-pricing-plans');
                    }

                    do_action('atbdp_after_start_plans_loop', $plan_id);
            ?>
                    <div class="<?php echo $columns_class; ?>">
                        <div class="directorist-pricing directorist-pricing--1 <?php echo !empty($plan_metas['default_pln'][0]) ? 'directorist-pricing-special' : ''; ?>">
                            <?php echo !empty($plan_metas['default_pln'][0]) ? __(' <span class="atbd_popular_badge">Recommended</span>', 'directorist-pricing-plans') : ''; ?>
                            <div class="directorist-pricing__title">
                                <h4><?php echo $value->post_title; ?>
                                    <?php echo $is_active ? __(' <span class="atbd_plan-active">Active</span>', 'directorist-pricing-plans') : ''; ?>
                                </h4>
                            </div>

                            <div class="directorist-pricing__price">
                                <p class="directorist-pricing__value">
                                    <?php
                                    if (!empty($fm_price)) { ?>
                                        <?php
                                        if ($fm_tax && !empty($after)) { ?>
                                            <span class="directorist-pricing-info">
                                                <?php directorist_icon( 'fas fa-question-circle' ); ?>    
                                                <span class="directorist-tooltip-pricing directorist-tooltip-top-pricing"><?php $fm_tax ? printf(__('Plus %s %s', 'directorist-pricing-plans'), $before. $fm_tax . $after, $tax_placeholder) : ''; ?></span>
                                            </span>
                                        <?php } ?>
                                        <sup><?php echo  $before ?></sup>
                                        <?php echo  $fm_price; ?>
                                        <sup><?php echo $after ?></sup>
                                        <?php
                                        if ($fm_tax && !empty($before)) { ?>
                                            <span class="directorist-pricing-info">
                                                <?php directorist_icon( 'fas fa-question-circle' ); ?>    
                                                <span class="directorist-tooltip-pricing directorist-tooltip-top-pricing"><?php $fm_tax ? printf(__('Plus %s %s', 'directorist-pricing-plans'), $before. $fm_tax . $after, $tax_placeholder) : ''; ?></span>
                                            </span>
                                        <?php }
                                    } else { ?>
                                        <?php echo __('Free', 'directorist-pricing-plans'); ?>
                                    <?php } ?>
                                    <small>/ <?php echo $price_text; ?></small>
                                    <small class="directorist-pricing_subtitle"><?php echo ($plan_type == 'pay_per_listng') ? __('Per Listing', 'directorist-pricing-plans') : __('Per Package', 'directorist-pricing-plans') ?>
                                    </small>

                                </p>

                                <?php
                                if (empty($plan_metas['hide_description'][0])) {
                                ?>
                                    <p class="directorist-pricing__description"><?php echo !empty($plan_metas['fm_description'][0]) ? $plan_metas['fm_description'][0] : ''; ?></p>
                                <?php } ?>
                            </div>
                            <div class="directorist-pricing__features">
                                <ul>
                                    <?php
                                    if (!$hide_recurring) { ?>
                                        <li>
                                            <?php directorist_plan_features( $recurring ); ?><?php _e('Auto renewing', 'directorist-pricing-plans') ?>
                                        </li>
                                    <?php }
                                    if ( ( $plan_type == 'pay_per_listng' ) && empty(apply_filters('atbdp_plan_featured_compare', $hide_featured))) { ?>
                                        <li>
                                            <?php directorist_plan_features( !empty($plan_metas['is_featured_listing'][0]) ?? '' ); ?><?php _e('Listing as featured', 'directorist-pricing-plans') ?>
                                        </li>
                                    <?php }
                                    if  ( $plan_type != 'pay_per_listng' ) { ?>
                                        <?php if (empty($plan_metas['hide_listings'][0])) { ?>
                                            <li>
                                                <?php directorist_plan_features( (($num_regular > 0) || $num_regular_unl) ); ?><?php echo $num_regular_unl ? '<span class="atbd_color-success">' . $unl . '</span> ' . __('Regular Listings', 'directorist-pricing-plans') . '' : $num_regular . ' ' . __('Regular Listings', 'directorist-pricing-plans'); ?>
                                            </li>
                                        <?php }
                                        if (empty(apply_filters('atbdp_plan_featured_compare', $plan_metas['hide_featured'][0]))) { ?>
                                            <li>
                                               <?php directorist_plan_features( (($num_featured > 0) || $num_featured_unl) ); ?><?php echo $num_featured_unl ? '<span class="atbd_color-success">' . $unl . '</span> ' . __('Featured Listings', 'directorist-pricing-plans') . '' : $num_featured . ' ' . __('Featured Listings', 'directorist-pricing-plans'); ?>
                                            </li>
                                        <?php }
                                    }

                                    if (empty(apply_filters('atbdp_plan_contact_owner_compare', $plan_metas['hide_Cowner'][0]))) {
                                        ?>
                                        <li>
                                        <?php directorist_plan_features( $cf_owner ); ?><?php _e('Contact Owner', 'directorist-pricing-plans') ?>
                                        </li>
                                        <?php }


                                    if ($submission_form_fields) {
                                        foreach ($submission_form_fields as $field) {
                                            $field_label = ! empty($field['label']) ? $field['label'] : '';
                                            $label       = ! empty($field['select_files_label']) ? $field['select_files_label'] : $field_label;
                                            $field_key   = isset($field['field_key']) && ! empty($field['field_key']) ? $field['field_key'] : '';

                                            if( 'privacy_policy' == $field_key ) {
                                                $label       = __('Privacy Policy', 'directorist-pricing-plans');
                                            }

                                            if( ! $label ) {
                                                continue;
                                            }

                                            $widget_name = ! empty($field['widget_name']) ? $field['widget_name'] : '';

                                            if ('tax_input[at_biz_dir-location][]'  == $field_key) {
                                                $field_key = 'location';
                                            }
                                            if ('admin_category_select[]'           == $field_key) {
                                                $field_key = 'category';
                                            }
                                            if ('tax_input[at_biz_dir-tags][]'      == $field_key) {
                                                $field_key = 'tag';
                                            }
                                            if ('pricing' == $widget_name ) {
                                                $field_key  = 'pricing';
                                            }

                                        //if( 'faqs' == $widget_name ) continue;
                                        if( 'booking' == $widget_name ) continue;
                                        if( 'listing_type' == $widget_name ) continue;

                                        $field_allow    = get_post_meta($plan_id, '_' . $field_key, true);
                                        $hide           = get_post_meta($plan_id, '_hide_' . $field_key, true);
                                        $max            = get_post_meta($plan_id, '_max_' . $field_key, true);
                                        $unlimited      = get_post_meta($plan_id, '_unlimited_' . $field_key, true);

                                        if (!$hide) { ?>
                                            <li>
                                                <?php directorist_plan_features( $field_allow ); ?>
                                                    <?php
                                                    echo esc_attr($label);
                                                    if (!empty($max) || !empty($unlimited)) {  ?>
                                                        <small><?php
                                                                if (!empty($unlimited)) {
                                                                    echo __('(Unlimited ', 'directorist-pricing-plans') . $label . ')';
                                                                } else {
                                                                    echo __('(Maximum of ', 'directorist-pricing-plans') . $max . ')';
                                                                } ?>
                                                        </small>
                                                    <?php } ?>

                                                </li>
                                        <?php
                                            }
                                        }
                                    }

                                    if (empty(apply_filters('atbdp_plan_review_compare', $plan_metas['hide_review'][0]))) {
                                        ?>
                                        <li>
                                            <?php directorist_plan_features( $fm_cs_review ); ?><?php _e('Allow Customer Review', 'directorist-pricing-plans') ?>
                                        </li>
                                    <?php }
                                    if (empty($plan_metas['hide_categories'][0])) {
                                        $is_cat = selected_plan_meta($plan_id, 'exclude_cat');
                                    ?>
                                        <li>
                                            <?php directorist_plan_features( $is_cat ); ?><?php _e('All Categories', 'directorist-pricing-plans') ?></li>
                                    <?php }

                                    if (empty(apply_filters('atbdp_plan_claim_compare', $hide_claim))) {
                                    ?>
                                        <li>
                                            <?php directorist_plan_features( $fm_claim ); ?><?php _e('Claim Badge Included', 'directorist-pricing-plans') ?>
                                        </li>
                                    <?php }

                                    // Booking
                                    if ( empty( apply_filters('atbdp_plan_booking_compare', $hide_booking) ) ) { ?>
                                        <li>
                                            <?php directorist_plan_features( $fm_booking ); ?><?php _e('Booking Included', 'directorist-pricing-plans') ?>
                                        </li>
                                    <?php }

                                    // Live Chat
                                    if ( empty( apply_filters('atbdp_plan_live_chat_compare', $hide_live_chat) ) ) { ?>
                                        <li>
                                            <?php directorist_plan_features( $fm_live_chat ); ?><?php _e('Live Chat Included', 'directorist-pricing-plans') ?>
                                        </li>
                                    <?php }

                                    // Mark as Sold
                                    if ( empty( apply_filters('atbdp_plan_mark_as_sold_compare', $hide_mark_as_sold) ) ) { ?>
                                        <li>
                                            <?php directorist_plan_features( $fm_mark_as_sold ); ?><?php _e('Mark as Sold Included', 'directorist-pricing-plans') ?>
                                        </li>
                                    <?php }

                                    // print dynamic form field

                                    /*
                                    * @since 1.0.0
                                    * Fires in plan compare page
                                    * hook for future dev
                                    */
                                    do_action('atpp_after_pricing_plans_compare_fields', $value->ID);
                                    ?>

                                </ul>

                                <div class="directorist-pricing__action">
                                    <?php

                                    $used_free_plan = true;
                                    if (package_or_PPL($value->ID) === 'pay_per_listng') {
                                        $used_free_plan = apply_filters( 'directorist_free_plan_use', atpp_get_used_free_plan($value->ID, get_current_user_id()) );
                                    }
                                    $url = apply_filters('atbdp_pricing_plan_to_checkout_url', atpp_add_listing_page_link_with_plan($value->ID, $is_active), $value->ID);
                                    $btn_class = '';

                                    if( directorist_direct_purchase() && ! get_directorist_option( 'guest_listings' ) && ! is_user_logged_in() ) {
                                        $btn_class = 'directorist_required_login';
                                    }elseif( directorist_direct_purchase() && get_directorist_option( 'guest_listings' ) && ! is_user_logged_in() ) {
                                        $btn_class = 'directorist_required_email';
                                    }

                                    ?>
                                    <input id="fee_plans[<?php echo $value->ID; ?>]" value="<?php echo $value->ID; ?>" name="fm_plans" type="hidden">
                                    <label for="fee_plans[<?php echo $value->ID; ?>]">
                                        <a class="directorist-btn directorist-btn-lighter directorist-btn-block directorist-pricing__action--btn <?php echo esc_attr( $btn_class ); ?>" href="<?php echo esc_url($url); ?>" onclick="return <?php echo !$used_free_plan ? 'false' : 'true' ?>;">
                                            <?php !$used_free_plan ? _e('Already Used!', 'directorist-pricing-plans') : _e('Continue', 'directorist-pricing-plans') ?>
                                        </a>
                                    </label>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-md-12">
                    <div class="atbd_pricing_status">
                        <?php printf('<p>%s</p>', __('There is no Plan available right now. Please contact with administrator.', 'directorist-pricing-plans')); ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <!--ends. row-->
    </div>
</div>
<!--ends. directorist-pricing-plan-container-->
