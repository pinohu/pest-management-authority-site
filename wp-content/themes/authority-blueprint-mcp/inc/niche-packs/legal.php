<?php
// @name Legal Services
// @description Starter kit for legal directories: lawyers, law firms, practice areas.
function ab_mcp_import_legal_pack() {
    // Demo pages
    $pages = [
        'Lawyers' => ['title' => 'Lawyers', 'content' => '<h2>Find Lawyers</h2>'],
        'Law Firms' => ['title' => 'Law Firms', 'content' => '<h2>Top Law Firms</h2>'],
        'Practice Areas' => ['title' => 'Practice Areas', 'content' => '<h2>Legal Practice Areas</h2>'],
    ];
    foreach ($pages as $slug => $data) {
        $existing = get_page_by_title($data['title']);
        if (!$existing) {
            $id = wp_insert_post([
                'post_title' => $data['title'],
                'post_content' => $data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'meta_input' => ['ab_mcp_niche_pack' => 'legal'],
            ]);
        }
    }
    // Directory types and fields (example)
    if (function_exists('directorist_setup')) {
        add_filter('directorist_listing_types', function($types) {
            $types['lawyer'] = [
                'name' => 'Lawyer',
                'slug' => 'lawyer',
                'icon' => 'fas fa-gavel',
                'description' => 'Lawyers and legal professionals',
            ];
            $types['law_firm'] = [
                'name' => 'Law Firm',
                'slug' => 'law-firm',
                'icon' => 'fas fa-balance-scale',
                'description' => 'Law firms and practices',
            ];
            return $types;
        });
        add_filter('directorist_custom_fields', function($fields) {
            $fields['practice_area'] = [
                'type' => 'select',
                'label' => 'Practice Area',
                'options' => [
                    'family' => 'Family Law',
                    'criminal' => 'Criminal Law',
                    'corporate' => 'Corporate Law',
                ]
            ];
            $fields['bar_number'] = [
                'type' => 'text',
                'label' => 'Bar Number',
                'placeholder' => 'e.g., 123456'
            ];
            return $fields;
        });
    }
} 