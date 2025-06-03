<?php
use PHPUnit\Framework\TestCase;

class DirectoristStripeTest extends TestCase {
    public function test_stripe_checkout_button_class_filter() {
        if (!function_exists('directorist_setup') || !defined('DTSTRIPE_VERSION')) {
            $this->markTestSkipped('Directorist Stripe not active.');
        }
        $class = apply_filters('dtstripe_checkout_button_class', 'dtstripe-checkout');
        $this->assertStringContainsString('ab-mcp-stripe-checkout', $class);
    }
} 