<?php
// Modular integration for Directorist Pricing Plans
if (!function_exists('directorist_setup') || !defined('DTPP_VERSION')) return;

// Example: Add a custom class to the pricing plan container for theme styling
add_filter('dtpp_pricing_plan_container_class', function($class) {
    return $class . ' ab-mcp-pricing-plan';
});

// TODO: Extend CSS in directorist-integration.css for pricing plan UI if needed 