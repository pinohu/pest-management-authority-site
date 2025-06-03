<?php
// Insighto.ai (context7) integration for comment moderation
add_action('comment_post', function($comment_id) {
    $api_key = get_option('ab_mcp_insighto_api_key') ?: getenv('AB_MCP_INSIGHTO_API_KEY');
    if (!$api_key) return;
    $comment = get_comment($comment_id);
    if (!$comment) return;
    $response = wp_remote_post('https://api.context7.com/insighto/moderate', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode(['content' => $comment->comment_content, 'author' => $comment->comment_author]),
        'timeout' => 15,
    ]);
    if (is_wp_error($response)) {
        error_log('Insighto.ai error: ' . $response->get_error_message());
        return;
    }
    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (!empty($body['flag']) && $body['flag'] === 'spam') {
        wp_spam_comment($comment_id);
    }
}, 20, 1); 