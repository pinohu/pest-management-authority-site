<?php
// Register Custom Post Types
add_action('init', function() {
    $cpts = [
        'pillar' => ['Pillar', 'Pillars'],
        'cluster' => ['Cluster', 'Clusters'],
        'resource' => ['Resource', 'Resources'],
        'case_study' => ['Case Study', 'Case Studies'],
        'glossary' => ['Glossary', 'Glossaries'],
        'faq' => ['FAQ', 'FAQs'],
        'comparison' => ['Comparison', 'Comparisons'],
        'tool' => ['Tool', 'Tools'],
        'testimonial' => ['Testimonial', 'Testimonials'],
        'curated_list' => ['Curated List', 'Curated Lists'],
        'author_expert' => ['Author/Expert', 'Authors/Experts'],
    ];
    foreach ($cpts as $slug => $labels) {
        register_post_type($slug, [
            'labels' => [
                'name' => __($labels[1], 'authority-blueprint-mcp'),
                'singular_name' => __($labels[0], 'authority-blueprint-mcp'),
            ],
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
            'rewrite' => ['slug' => $slug],
        ]);
    }

    // Register Taxonomies
    $taxonomies = [
        'topic' => ['Topic', 'Topics'],
        'audience' => ['Audience', 'Audiences'],
        'resource_type' => ['Resource Type', 'Resource Types'],
        // Add more generic taxonomies as needed for your use case
    ];
    foreach ($taxonomies as $slug => $labels) {
        register_taxonomy($slug, array_keys($cpts), [
            'labels' => [
                'name' => __($labels[1], 'authority-blueprint-mcp'),
                'singular_name' => __($labels[0], 'authority-blueprint-mcp'),
            ],
            'public' => true,
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite' => ['slug' => $slug],
        ]);
    }
});

// === Workflow Automation Hooks ===
// Triggered after a post is published
add_action('publish_post', function($post_id) {
    do_action('abmcp_after_post_publish', $post_id);
});
// Triggered after a page is created
add_action('publish_page', function($post_id) {
    do_action('abmcp_after_page_create', $post_id);
});
// Triggered after a custom post type is created
add_action('save_post', function($post_id, $post, $update) {
    if (in_array($post->post_type, ['pillar','cluster','resource','case_study','glossary','faq','comparison','tool','testimonial','curated_list','author_expert'])) {
        do_action('abmcp_after_cpt_create', $post_id, $post->post_type, $update);
    }
}, 10, 3);
// === End Workflow Automation Hooks ===
// See /inc/integrations/ for usage examples. 