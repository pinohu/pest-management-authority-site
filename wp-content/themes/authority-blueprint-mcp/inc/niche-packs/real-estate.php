<?php
// @name Real Estate
// @description Starter kit for real estate directories: agents, agencies, properties.
function ab_mcp_import_real_estate_pack() {
    // Demo pages
    $pages = [
        'Agents' => ['title' => 'Agents', 'content' => '<h2>Find Real Estate Agents</h2>'],
        'Agencies' => ['title' => 'Agencies', 'content' => '<h2>Top Real Estate Agencies</h2>'],
        'Properties' => ['title' => 'Properties', 'content' => '<h2>Available Properties</h2>'],
    ];
    foreach ($pages as $slug => $data) {
        $existing = get_page_by_title($data['title']);
        if (!$existing) {
            $id = wp_insert_post([
                'post_title' => $data['title'],
                'post_content' => $data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'meta_input' => ['ab_mcp_niche_pack' => 'real-estate'],
            ]);
        }
    }
    // Directory types and fields (example)
    if (function_exists('directorist_setup')) {
        add_filter('directorist_listing_types', function($types) {
            $types['agent'] = [
                'name' => 'Agent',
                'slug' => 'agent',
                'icon' => 'fas fa-user-tie',
                'description' => 'Real estate agents',
            ];
            $types['agency'] = [
                'name' => 'Agency',
                'slug' => 'agency',
                'icon' => 'fas fa-building',
                'description' => 'Real estate agencies',
            ];
            $types['property'] = [
                'name' => 'Property',
                'slug' => 'property',
                'icon' => 'fas fa-home',
                'description' => 'Properties for sale or rent',
            ];
            return $types;
        });
        add_filter('directorist_custom_fields', function($fields) {
            $fields['property_type'] = [
                'type' => 'select',
                'label' => 'Property Type',
                'options' => [
                    'house' => 'House',
                    'apartment' => 'Apartment',
                    'land' => 'Land',
                ]
            ];
            $fields['price'] = [
                'type' => 'number',
                'label' => 'Price',
                'placeholder' => 'e.g., 250000'
            ];
            return $fields;
        });
    }
} 