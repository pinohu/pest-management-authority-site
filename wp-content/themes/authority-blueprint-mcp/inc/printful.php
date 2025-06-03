<?php
// Printful integration: fetch products
function ab_printful_get_products() {
    $api_key = get_option('ab_printful_api_key') ?: getenv('AB_PRINTFUL_API_KEY');
    if (!$api_key) return [];
    $response = wp_remote_get('https://api.printful.com/products', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Accept' => 'application/json',
        ],
        'timeout' => 20,
    ]);
    if (is_wp_error($response)) return [];
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return $body['result'] ?? [];
}
// TODO: Add block/shortcode for shop display 

// Shortcode: [printful-products]
add_shortcode('printful-products', function() {
    ob_start();
    echo '<section class="printful-products" role="region" aria-label="Printful Products">';
    echo '<h2>' . esc_html__('Shop (Printful)', 'authority-blueprint-mcp') . '</h2>';
    $products = ab_printful_get_products();
    if (empty($products)) {
        echo '<div class="error-summary" role="alert">' . esc_html__('No products found or API error.', 'authority-blueprint-mcp') . '</div>';
    } else {
        echo '<div class="printful-product-grid" style="display:flex;flex-wrap:wrap;gap:1.5rem;">';
        foreach ($products as $prod) {
            $name = isset($prod['name']) ? esc_html($prod['name']) : esc_html__('(No Name)', 'authority-blueprint-mcp');
            $img = isset($prod['image']) ? esc_url($prod['image']) : '';
            $price = isset($prod['price']) ? esc_html($prod['price']) : '';
            echo '<div class="printful-product-card" style="background:#fff;border-radius:8px;padding:1rem;box-shadow:0 2px 8px rgba(56,142,60,0.07);flex:1 1 200px;max-width:220px;text-align:center;">';
            if ($img) echo '<img src="' . $img . '" alt="' . $name . '" style="max-width:100%;height:auto;border-radius:4px;">';
            echo '<div class="printful-product-name" style="margin:0.5rem 0;font-weight:600;">' . $name . '</div>';
            if ($price) echo '<div class="printful-product-price" style="color:#388e3c;font-weight:500;">' . $price . '</div>';
            echo '</div>';
        }
        echo '</div>';
    }
    echo '</section>';
    return ob_get_clean();
}); 