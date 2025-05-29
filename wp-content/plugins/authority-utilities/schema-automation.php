<?php
/*
Plugin Name: Authority Utilities - Schema Automation
Description: Automatically generates schema.org JSON-LD markup for posts, pages, and custom post types.
Version: 1.0
Author: Authority Blueprint
*/

add_action('wp_head', 'authority_schema_automation_inject', 20);

function authority_schema_automation_inject() {
    if (!is_singular()) {
        return;
    }
    global $post;
    if (!$post) {
        return;
    }
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => get_the_title($post),
        'datePublished' => get_the_date('c', $post),
        'dateModified' => get_the_modified_date('c', $post),
        'author' => array(
            '@type' => 'Person',
            'name' => get_the_author_meta('display_name', $post->post_author),
        ),
        'mainEntityOfPage' => get_permalink($post),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => get_bloginfo('name'),
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => get_site_icon_url(),
            ),
        ),
        'description' => get_the_excerpt($post),
    );
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
} 