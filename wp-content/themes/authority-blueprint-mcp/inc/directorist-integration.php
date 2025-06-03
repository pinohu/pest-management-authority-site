<?php
// All Directorist add-on integrations are modular and handled in inc/integrations/.

// Enqueue Directorist integration styles
add_action('wp_enqueue_scripts', function() {
    if (function_exists('directorist_setup')) {
        wp_enqueue_style('ab-mcp-directorist-integration', get_template_directory_uri() . '/css/directorist-integration.css', ['ab-mcp-style'], AB_MCP_VERSION);
    }
});

// === Generic Directory Types and Fields ===
define('AB_MCP_DIRECTORY_TYPES', [
    'service_provider' => [
        'name' => 'Service Provider',
        'slug' => 'service-provider',
        'icon' => 'fas fa-briefcase',
        'description' => 'Directory of service providers (customize for your niche)'
    ],
    'organization' => [
        'name' => 'Organization',
        'slug' => 'organization',
        'icon' => 'fas fa-building',
        'description' => 'Directory of organizations (customize for your niche)'
    ],
    'product_supplier' => [
        'name' => 'Product Supplier',
        'slug' => 'product-supplier',
        'icon' => 'fas fa-box',
        'description' => 'Directory of product suppliers (customize for your niche)'
    ],
]);

add_action('init', function() {
    if (function_exists('directorist_setup')) {
        add_filter('directorist_listing_types', function($types) {
            return array_merge($types, AB_MCP_DIRECTORY_TYPES);
        });
        add_filter('directorist_custom_fields', function($fields) {
            $fields['specialization'] = [
                'type' => 'select',
                'label' => 'Specialization',
                'options' => [
                    'type1' => 'Type 1',
                    'type2' => 'Type 2',
                    'type3' => 'Type 3',
                ]
            ];
            $fields['certifications'] = [
                'type' => 'text',
                'label' => 'Certifications',
                'placeholder' => 'e.g., Certified Professional, Accredited Organization'
            ];
            return $fields;
        });
    }
}); 