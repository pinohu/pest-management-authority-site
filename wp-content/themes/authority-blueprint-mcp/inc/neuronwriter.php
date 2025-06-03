<?php
// NEURONWriter (context7) integration for content optimization suggestions
add_action('add_meta_boxes', function() {
    add_meta_box('neuronwriter_suggestions', __('Content Optimization', 'authority-blueprint-mcp'), 'ab_mcp_neuronwriter_metabox', null, 'side');
});

function ab_mcp_neuronwriter_metabox($post) {
    echo '<div id="neuronwriter-suggestions">';
    echo esc_html__('Loading suggestions...', 'authority-blueprint-mcp');
    echo '</div>';
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch(ajaxurl + '?action=ab_mcp_neuronwriter_suggestions&post_id=<?php echo $post->ID; ?>')
            .then(r => r.json())
            .then(data => {
                const el = document.getElementById('neuronwriter-suggestions');
                if (data.success && data.suggestions) {
                    el.innerHTML = '<ul>' + data.suggestions.map(s => '<li>' + s + '</li>').join('') + '</ul>';
                } else {
                    el.innerHTML = data.error ? data.error : 'No suggestions.';
                }
            });
    });
    </script>
    <?php
}

add_action('wp_ajax_ab_mcp_neuronwriter_suggestions', function() {
    $post_id = intval($_GET['post_id'] ?? 0);
    if (!$post_id) wp_send_json_error(['error' => 'Invalid post ID.']);
    $post = get_post($post_id);
    if (!$post) wp_send_json_error(['error' => 'Post not found.']);
    $api_key = get_option('ab_mcp_neuronwriter_api_key') ?: getenv('AB_MCP_NEURONWRITER_API_KEY');
    if (!$api_key) wp_send_json_error(['error' => 'NEURONWriter API key not set.']);
    $content = $post->post_content;
    $response = wp_remote_post('https://api.context7.com/neuronwriter/optimize', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode(['content' => $content, 'title' => $post->post_title]),
        'timeout' => 20,
    ]);
    if (is_wp_error($response)) {
        wp_send_json_error(['error' => 'API error: ' . $response->get_error_message()]);
    }
    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (!empty($body['suggestions'])) {
        wp_send_json_success(['suggestions' => $body['suggestions']]);
    } else {
        wp_send_json_error(['error' => 'No suggestions returned.']);
    }
}); 