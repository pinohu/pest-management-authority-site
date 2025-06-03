<?php
// OpenAI integration: generate content
function ab_openai_generate_content($prompt) {
    $api_key = get_option('ab_openai_api_key') ?: getenv('AB_OPENAI_API_KEY');
    if (!$api_key || !$prompt) return '';
    $response = wp_remote_post('https://api.openai.com/v1/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 256,
        ]),
        'timeout' => 20,
    ]);
    if (is_wp_error($response)) return '';
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return $body['choices'][0]['text'] ?? '';
}
// TODO: Add block/editor button for AI writing 
// TODO: Add security/rate limiting for production use 