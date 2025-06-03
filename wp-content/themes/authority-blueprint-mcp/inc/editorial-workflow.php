<?php
// Editorial Workflow Tool: Content calendar, review status, audit scheduling
add_action('admin_menu', function() {
    add_menu_page(
        __('Editorial Workflow', 'authority-blueprint-mcp'),
        __('Editorial Workflow', 'authority-blueprint-mcp'),
        'edit_posts',
        'ab-mcp-editorial-workflow',
        'ab_mcp_editorial_workflow_page',
        'dashicons-calendar-alt',
        60
    );
});
function ab_mcp_editorial_workflow_page() {
    if (!current_user_can('edit_posts')) return;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ab_mcp_workflow_nonce']) && wp_verify_nonce($_POST['ab_mcp_workflow_nonce'], 'ab_mcp_workflow')) {
        $workflow = array_map('sanitize_text_field', $_POST['workflow'] ?? []);
        update_option('ab_mcp_editorial_workflow', $workflow);
        do_action('abmcp_after_workflow_update', $workflow);
        echo '<div class="updated"><p>' . esc_html__('Workflow updated.', 'authority-blueprint-mcp') . '</p></div>';
    }
    $workflow = get_option('ab_mcp_editorial_workflow', []);
    $posts = get_posts(['post_type' => 'any', 'post_status' => 'publish', 'numberposts' => 50]);
    echo '<div class="wrap"><h1>' . esc_html__('Editorial Workflow', 'authority-blueprint-mcp') . '</h1>';
    echo '<form method="post">' . wp_nonce_field('ab_mcp_workflow', 'ab_mcp_workflow_nonce', true, false);
    echo '<table class="widefat"><thead><tr><th>' . esc_html__('Title', 'authority-blueprint-mcp') . '</th><th>' . esc_html__('Status', 'authority-blueprint-mcp') . '</th><th>' . esc_html__('Reviewer', 'authority-blueprint-mcp') . '</th><th>' . esc_html__('Next Audit', 'authority-blueprint-mcp') . '</th></tr></thead><tbody>';
    foreach ($posts as $post) {
        $wid = $post->ID;
        $row = $workflow[$wid] ?? ['status' => '', 'reviewer' => '', 'audit' => ''];
        echo '<tr>';
        echo '<td><a href="' . get_edit_post_link($wid) . '">' . esc_html(get_the_title($wid)) . '</a></td>';
        echo '<td><input type="text" name="workflow[' . $wid . '][status]" value="' . esc_attr($row['status'] ?? '') . '" style="width:100px;"></td>';
        echo '<td><input type="text" name="workflow[' . $wid . '][reviewer]" value="' . esc_attr($row['reviewer'] ?? '') . '" style="width:120px;"></td>';
        echo '<td><input type="date" name="workflow[' . $wid . '][audit]" value="' . esc_attr($row['audit'] ?? '') . '" style="width:130px;"></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
    echo '<p><input type="submit" class="button-primary" value="' . esc_attr__('Save Workflow', 'authority-blueprint-mcp') . '"></p>';
    echo '</form></div>';
} 