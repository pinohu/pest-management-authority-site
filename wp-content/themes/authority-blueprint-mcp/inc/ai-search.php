<?php
// Logically (Afforai) integration: AI-powered Q&A/search
function ab_logically_qa($question) {
    $api_key = get_option('ab_logically_api_key') ?: getenv('AB_LOGICALLY_API_KEY');
    if (!$api_key || !$question) return '';
    $response = wp_remote_post('https://api.afforai.com/v1/qa', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode(['question' => $question]),
        'timeout' => 20,
    ]);
    if (is_wp_error($response)) return '';
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return $body['answer'] ?? '';
}
// exa.ai integration: AI-powered recommendations
function ab_exa_recommend($content) {
    $api_key = get_option('ab_exa_api_key') ?: getenv('AB_EXA_API_KEY');
    if (!$api_key || !$content) return [];
    $response = wp_remote_post('https://api.exa.ai/v1/recommend', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode(['content' => $content]),
        'timeout' => 20,
    ]);
    if (is_wp_error($response)) return [];
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return $body['recommendations'] ?? [];
}
// TODO: Add block/shortcode for frontend search and recommendations 