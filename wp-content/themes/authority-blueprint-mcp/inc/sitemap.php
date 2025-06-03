<?php
// Custom XML Sitemap for all CPTs and taxonomies
add_action('init', function() {
    add_rewrite_rule('^sitemap\.xml$', 'index.php?sitemap=1', 'top');
});
add_filter('query_vars', function($vars) {
    $vars[] = 'sitemap';
    return $vars;
});
add_action('template_redirect', function() {
    if (get_query_var('sitemap')) {
        header('Content-Type: application/xml; charset=utf-8');
        echo ab_mcp_generate_sitemap();
        exit;
    }
});
function ab_mcp_generate_sitemap() {
    $urls = [];
    // All public CPTs
    $cpts = get_post_types(['public' => true, '_builtin' => false], 'names');
    foreach ($cpts as $cpt) {
        $posts = get_posts(['post_type' => $cpt, 'post_status' => 'publish', 'numberposts' => 1000]);
        foreach ($posts as $post) {
            $urls[] = [
                'loc' => get_permalink($post),
                'lastmod' => get_the_modified_time('c', $post),
            ];
        }
    }
    // All public taxonomies
    $taxes = get_taxonomies(['public' => true, '_builtin' => false], 'names');
    foreach ($taxes as $tax) {
        $terms = get_terms(['taxonomy' => $tax, 'hide_empty' => true]);
        foreach ($terms as $term) {
            $urls[] = [
                'loc' => get_term_link($term),
                'lastmod' => date('c', strtotime($term->term_modified ?? $term->term_id)),
            ];
        }
    }
    $xml = '<?xml version="1.0" encoding="UTF-8"?>\n';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . esc_url($url['loc']) . '</loc>';
        $xml .= '<lastmod>' . esc_html($url['lastmod']) . '</lastmod>';
        $xml .= '</url>';
    }
    $xml .= '</urlset>';
    return $xml;
} 