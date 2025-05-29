<?php
/*
Plugin Name: Authority Utilities - Internal Linking
Description: Suggests and inserts internal links based on content clusters using a keyword-to-URL map.
Version: 1.0
Author: Authority Blueprint
*/

add_filter('the_content', 'authority_internal_linking_automate', 20);

function authority_internal_linking_automate($content) {
    if (!is_singular()) {
        return $content;
    }
    $map = array(
        'mobile-first design' => '/mobile-first-design/',
        'responsive design' => '/responsive-design/',
        'accessibility' => '/accessibility-best-practices/',
        'seo' => '/seo-best-practices/',
        // Add more keyword => URL pairs as needed
    );
    foreach ($map as $keyword => $url) {
        if (stripos($content, $keyword) !== false) {
            $link = '<a href="' . esc_url($url) . '">' . esc_html($keyword) . '</a>';
            $content = preg_replace('/(' . preg_quote($keyword, '/') . ')/i', $link, $content, 1);
        }
    }
    return $content;
} 