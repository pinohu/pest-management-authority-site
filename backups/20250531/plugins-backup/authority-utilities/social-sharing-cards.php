<?php
/*
Plugin Name: Authority Utilities - Social Sharing Cards
Description: Auto-generates Open Graph and Twitter Card meta tags for posts and pages.
Version: 1.0
Author: Authority Blueprint
*/

add_action('wp_head', 'authority_social_sharing_cards_meta', 10);

function authority_social_sharing_cards_meta() {
    if (!is_singular()) {
        return;
    }
    global $post;
    if (!$post) {
        return;
    }
    $title = get_the_title($post);
    $desc = get_the_excerpt($post);
    $url = get_permalink($post);
    $image = get_the_post_thumbnail_url($post, 'full');
    if (!$image) {
        $image = get_site_icon_url();
    }
    echo '<meta property="og:title" content="' . esc_attr($title) . '" />';
    echo '<meta property="og:description" content="' . esc_attr($desc) . '" />';
    echo '<meta property="og:url" content="' . esc_url($url) . '" />';
    echo '<meta property="og:image" content="' . esc_url($image) . '" />';
    echo '<meta name="twitter:card" content="summary_large_image" />';
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '" />';
    echo '<meta name="twitter:description" content="' . esc_attr($desc) . '" />';
    echo '<meta name="twitter:image" content="' . esc_url($image) . '" />';
} 