<?php
use PHPUnit\Framework\TestCase;

class DirectoristPricingPlansTest extends TestCase {
    public function test_pricing_plan_container_class_filter() {
        if (!function_exists('directorist_setup') || !defined('DTPP_VERSION')) {
            $this->markTestSkipped('Directorist Pricing Plans not active.');
        }
        $class = apply_filters('dtpp_pricing_plan_container_class', 'dtpp-pricing-plan');
        $this->assertStringContainsString('ab-mcp-pricing-plan', $class);
    }
} 