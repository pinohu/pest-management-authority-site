<?php
/*
Plugin Name: Authority Utilities - Content Freshness
Description: Flags stale content (not updated in 12+ months) in the admin dashboard for review.
Version: 1.0
Author: Authority Blueprint
*/

if (!wp_next_scheduled('authority_content_freshness_daily')) {
    wp_schedule_event(time(), 'daily', 'authority_content_freshness_daily');
}
add_action('authority_content_freshness_daily', 'authority_check_stale_content');

function authority_check_stale_content() {
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'date_query' => array(
            array(
                'column' => 'post_modified_gmt',
                'before' => date('Y-m-d', strtotime('-12 months')),
            ),
        ),
        'fields' => 'ids',
    );
    $stale = get_posts($args);
    update_option('authority_stale_content', $stale);
}

add_action('admin_notices', 'authority_show_stale_content_notice');
function authority_show_stale_content_notice() {
    if (!current_user_can('edit_posts')) return;
    $stale = get_option('authority_stale_content', array());
    if (!empty($stale)) {
        $count = count($stale);
        echo '<div class="notice notice-warning"><p>';
        printf(
            __('There are <strong>%d</strong> stale posts (not updated in 12+ months). <a href="%s">Review now</a>.'),
            $count,
            admin_url('edit.php?post__in=' . implode(',', $stale))
        );
        echo '</p></div>';
    }
} 