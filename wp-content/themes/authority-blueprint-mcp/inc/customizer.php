<?php
// Add customizer settings for hero section, color scheme, and typography
add_action('customize_register', function($wp_customize) {
    // Hero Section
    $wp_customize->add_section('ab_mcp_hero', [
        'title' => __('Hero Section', 'authority-blueprint-mcp'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('ab_mcp_hero_title', [
        'default' => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ab_mcp_hero_title', [
        'label' => __('Hero Title', 'authority-blueprint-mcp'),
        'section' => 'ab_mcp_hero',
        'type' => 'text',
    ]);
    $wp_customize->add_setting('ab_mcp_hero_desc', [
        'default' => get_bloginfo('description'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ab_mcp_hero_desc', [
        'label' => __('Hero Description', 'authority-blueprint-mcp'),
        'section' => 'ab_mcp_hero',
        'type' => 'text',
    ]);
    // Color Scheme
    $wp_customize->add_section('ab_mcp_colors', [
        'title' => __('Color Scheme', 'authority-blueprint-mcp'),
        'priority' => 31,
    ]);
    $wp_customize->add_setting('ab_mcp_primary_color', [
        'default' => '#388e3c',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ab_mcp_primary_color', [
        'label' => __('Primary Color', 'authority-blueprint-mcp'),
        'section' => 'ab_mcp_colors',
    ]));
    $wp_customize->add_setting('ab_mcp_secondary_color', [
        'default' => '#795548',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ab_mcp_secondary_color', [
        'label' => __('Secondary Color', 'authority-blueprint-mcp'),
        'section' => 'ab_mcp_colors',
    ]));
    // Typography
    $wp_customize->add_section('ab_mcp_typography', [
        'title' => __('Typography', 'authority-blueprint-mcp'),
        'priority' => 32,
    ]);
    $wp_customize->add_setting('ab_mcp_font_family', [
        'default' => 'Inter, Arial, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ab_mcp_font_family', [
        'label' => __('Font Family', 'authority-blueprint-mcp'),
        'section' => 'ab_mcp_typography',
        'type' => 'text',
    ]);
    // === Lovable Hero Section Customizer ===
    $wp_customize->add_section('lovable_hero_section', [
        'title'    => __('Lovable Hero Section', 'authority-blueprint-mcp'),
        'priority' => 30,
    ]);
    // Lovable Hero Section: Title
    $wp_customize->add_setting('hero_title', [
        'default' => 'Default Title',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_title', [
        'label' => __('Hero Title', 'authority-blueprint-mcp'),
        'section' => 'lovable_hero_section',
        'type' => 'text',
    ]);
    // Lovable Hero Section: Subtitle
    $wp_customize->add_setting('hero_subtitle', [
        'default' => 'Default Subtitle',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_subtitle', [
        'label' => __('Hero Subtitle', 'authority-blueprint-mcp'),
        'section' => 'lovable_hero_section',
        'type' => 'text',
    ]);
    // Lovable Hero Section: CTA Text
    $wp_customize->add_setting('hero_cta_text', [
        'default' => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_cta_text', [
        'label' => __('Hero CTA Text', 'authority-blueprint-mcp'),
        'section' => 'lovable_hero_section',
        'type' => 'text',
    ]);
    // Lovable Hero Section: Background Type
    $wp_customize->add_setting('hero_background_type', [
        'default' => 'image',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_background_type', [
        'label' => __('Hero Background Type', 'authority-blueprint-mcp'),
        'section' => 'lovable_hero_section',
        'type' => 'select',
        'choices' => [
            'image' => __('Image', 'authority-blueprint-mcp'),
            'gradient' => __('Gradient', 'authority-blueprint-mcp'),
            'color' => __('Solid Color', 'authority-blueprint-mcp'),
        ],
    ]);
}); 