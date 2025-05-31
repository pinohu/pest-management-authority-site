<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

$post_meta = get_post_meta( get_the_ID() );
?>
<table class="directorist-input-box widefat directorist-table-responsive" id="directorist-field-details">
    <tbody>
        <tr class="directorist-field-type">
            <td class="directorist-label">
                <label class="directorist-input-box__title widefat"><?php _e('Listing Sorting Order', 'directorist-pricing-plans'); ?></label>
            </td>
            <td class="directorist-field-lable">
                <div class="directorist-form-group directorist_price-input">
                    <?php $value = isset( $post_meta[ DPP_META_KEY_PLAN_SORTING_ORDER ] ) ? $post_meta[ DPP_META_KEY_PLAN_SORTING_ORDER ][0] : 1 ?>
                    <input name="<?php echo DPP_META_KEY_PLAN_SORTING_ORDER ?>" type="number" step="1" id="<?php echo DPP_META_KEY_PLAN_SORTING_ORDER ?>" value="<?php echo esc_attr( $value ); ?>" placeholder="<?php _e('Order', 'directorist-pricing-plans'); ?>" />
                </div>
            </td>
        </tr>
    </tbody>
</table>