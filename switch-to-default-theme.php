<?php
/**
 * Switch to Default Theme Script
 * This will activate a default WordPress theme to bypass our custom theme
 */

// Load WordPress
require_once('wp-load.php');

echo "<h1>🎨 Theme Switcher</h1>";

// Get current theme
$current_theme = wp_get_theme();
echo "<p><strong>Current Theme:</strong> " . $current_theme->get('Name') . "</p>";

// List available themes
$themes = wp_get_themes();
echo "<h2>Available Themes:</h2>";

foreach ($themes as $theme_slug => $theme) {
    echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0;'>";
    echo "<strong>" . $theme->get('Name') . "</strong><br>";
    echo "Description: " . $theme->get('Description') . "<br>";
    echo "Version: " . $theme->get('Version') . "<br>";
    
    if ($theme_slug === 'twentytwentyfour' || $theme_slug === 'twentytwentythree' || $theme_slug === 'twentytwentyfive') {
        echo "<form method='post' style='display: inline;'>";
        echo "<input type='hidden' name='switch_theme' value='" . $theme_slug . "'>";
        echo "<button type='submit' style='background: #0073aa; color: white; padding: 5px 10px; border: none; cursor: pointer;'>Switch to This Theme</button>";
        echo "</form>";
    }
    echo "</div>";
}

// Handle theme switching
if (isset($_POST['switch_theme'])) {
    $new_theme = sanitize_text_field($_POST['switch_theme']);
    
    if (wp_get_theme($new_theme)->exists()) {
        switch_theme($new_theme);
        echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h2>✅ Theme Switched Successfully!</h2>";
        echo "<p>Active theme is now: <strong>" . wp_get_theme()->get('Name') . "</strong></p>";
        echo "<p><a href='http://pestmanagementscience.com' target='_blank' style='background: #0073aa; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px;'>View Site</a></p>";
        echo "</div>";
    } else {
        echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h2>❌ Error</h2>";
        echo "<p>Theme not found: " . htmlspecialchars($new_theme) . "</p>";
        echo "</div>";
    }
}

echo "<hr>";
echo "<h2>🎯 Instructions:</h2>";
echo "<ol>";
echo "<li><strong>Switch to a default theme</strong> (Twenty Twenty-Four recommended)</li>";
echo "<li><strong>Test your site</strong> - it should load without errors</li>";
echo "<li><strong>Complete WordPress installation</strong> if needed</li>";
echo "<li><strong>Switch back to Authority Blueprint</strong> later after setup</li>";
echo "</ol>";

echo "<p><small>Delete this file after use for security.</small></p>";
?> 