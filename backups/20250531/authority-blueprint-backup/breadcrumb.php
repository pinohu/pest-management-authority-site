<?php
/**
 * Breadcrumb navigation partial for Authority Blueprint
 *
 * Implements semantic, accessible, SEO-optimized breadcrumbs.
 *
 * @package Authority_Blueprint
 */
if (!function_exists('authority_blueprint_breadcrumbs')) {
function authority_blueprint_breadcrumbs() {
    echo '<nav class="breadcrumb" aria-label="Breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">';
    echo '<ol>';
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a href="' . esc_url(home_url('/')) . '" itemprop="item"><span itemprop="name">Home</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '</li>';
    $position = 2;
    if (is_category() || is_single()) {
        $cat = get_the_category();
        if ($cat && isset($cat[0])) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . esc_url(get_category_link($cat[0]->term_id)) . '" itemprop="item"><span itemprop="name">' . esc_html($cat[0]->name) . '</span></a>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
            $position++;
        }
    }
    if (is_single()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }
    if (is_page() && !is_front_page()) {
        global $post;
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        foreach ($ancestors as $ancestor) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . esc_url(get_permalink($ancestor)) . '" itemprop="item"><span itemprop="name">' . get_the_title($ancestor) . '</span></a>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
            $position++;
        }
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<span itemprop="name">' . get_the_title() . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }
    echo '</ol>';
    echo '</nav>';
}
} 