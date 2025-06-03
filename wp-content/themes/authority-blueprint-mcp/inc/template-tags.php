<?php
// Output meta tags, Open Graph, Twitter Card, canonical
add_action('wp_head', function() {
    if (is_singular()) {
        global $post;
        $title = get_the_title($post);
        $desc = get_the_excerpt($post);
        $url = get_permalink($post);
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />';
        echo '<meta property="og:description" content="' . esc_attr($desc) . '" />';
        echo '<meta property="og:url" content="' . esc_url($url) . '" />';
        echo '<meta name="twitter:card" content="summary_large_image" />';
        echo '<link rel="canonical" href="' . esc_url($url) . '" />';
    }
});

// Output JSON-LD schema for Article, FAQ, etc.
add_action('wp_head', function() {
    if (is_singular('faq')) {
        global $post;
        $faq = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [[
                '@type' => 'Question',
                'name' => get_the_title($post),
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => apply_filters('the_content', $post->post_content),
                ],
            ]],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($faq) . '</script>';
    }
});

// Breadcrumbs (semantic, accessible)
function ab_mcp_breadcrumbs() {
    if (!is_front_page()) {
        echo '<nav class="breadcrumbs" aria-label="Breadcrumbs">';
        echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'authority-blueprint-mcp') . '</a> &raquo; ';
        if (is_singular()) {
            the_title();
        } elseif (is_archive()) {
            the_archive_title();
        }
        echo '</nav>';
    }
}

// === Integration Meta Tag Injection ===
add_action('wp_head', function() {
    // Allow integrations to inject additional meta tags, schema, or tracking
    echo apply_filters('abmcp_integration_wp_head', '');
});
// === End Integration Meta Tag Injection ===
// See /inc/integrations/ for usage examples.

// All meta, schema, and breadcrumb output is now fully generic and niche-agnostic. Customize as needed for your use case. 