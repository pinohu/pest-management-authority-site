<?php
use PHPUnit\Framework\TestCase;

class DirectoristListingsWithMapTest extends TestCase {
    public function test_map_container_class_filter() {
        if (!function_exists('directorist_setup') || !defined('BDMV_VERSION')) {
            $this->markTestSkipped('Directorist Listings With Map not active.');
        }
        $class = apply_filters('bdmv_map_container_class', 'directorist-map');
        $this->assertStringContainsString('ab-mcp-listings-map', $class);
    }
} 