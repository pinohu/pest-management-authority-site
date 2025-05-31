<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

$playstore_product_id    = get_post_meta( $post->ID, '_dpp_playstore_product_id', true );
$playstore_product_price = get_post_meta( $post->ID, '_dpp_playstore_product_price', true );
$appstore_product_id     = get_post_meta( $post->ID, '_dpp_appstore_product_id', true );
$appstore_product_price  = get_post_meta( $post->ID, '_dpp_appstore_product_price', true );
?>
<table class="directorist-input-box widefat directorist-table-responsive" id="directorist-field-details">
    <tbody>
        <tr class="directorist-field-type">
            <td class="directorist-label">
                <label for="_dpp_playstore_product_id" class="directorist-input-box__title widefat"><?php esc_html_e( 'PlayStore Product ID', 'directorist-pricing-plans' ); ?></label>
            </td>
            <td class="directorist-field-lable directorist-form-group">
                <input name="_dpp_playstore_product_id" value="<?php echo esc_attr( $playstore_product_id ); ?>" type="text" id="_dpp_playstore_product_id" placeholder="<?php esc_attr_e( 'PlayStore product id', 'directorist-pricing-plans' ); ?>">
            </td>
        </tr>
        <tr class="directorist-field-type">
            <td class="directorist-label">
                <label for="_dpp_playstore_product_price" class="directorist-input-box__title widefat"><?php esc_html_e( 'PlayStore Product Price', 'directorist-pricing-plans' ); ?></label>
            </td>
            <td class="directorist-field-lable directorist-form-group">
                <input name="_dpp_playstore_product_price" value="<?php echo esc_attr( $playstore_product_price ); ?>" type="text" id="_dpp_playstore_product_price" placeholder="<?php esc_attr_e( 'PlayStore product price', 'directorist-pricing-plans' ); ?>">
            </td>
        </tr>
        <tr class="directorist-field-type">
            <td class="directorist-label">
                <label for="_dpp_appstore_product_id" class="directorist-input-box__title widefat"><?php esc_html_e( 'AppStore Product ID', 'directorist-pricing-plans' ); ?></label>
            </td>
            <td class="directorist-field-lable directorist-form-group">
                <input name="_dpp_appstore_product_id" value="<?php echo esc_attr( $appstore_product_id ); ?>" type="text" id="_dpp_appstore_product_id" placeholder="<?php esc_attr_e( 'AppStore product id', 'directorist-pricing-plans' ); ?>">
            </td>
        </tr>
        <tr class="directorist-field-type">
            <td class="directorist-label">
                <label for="_dpp_appstore_product_price" class="directorist-input-box__title widefat"><?php esc_html_e( 'AppStore Product Price', 'directorist-pricing-plans' ); ?></label>
            </td>
            <td class="directorist-field-lable directorist-form-group">
                <input name="_dpp_appstore_product_price" value="<?php echo esc_attr( $appstore_product_price ); ?>" type="text" id="_dpp_appstore_product_price" placeholder="<?php esc_attr_e( 'AppStore product price', 'directorist-pricing-plans' ); ?>">
            </td>
        </tr>
    </tbody>
</table>
