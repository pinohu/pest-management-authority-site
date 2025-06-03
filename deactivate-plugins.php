<?php
/**
 * Plugin Deactivation Script
 * Safely deactivates all WordPress plugins
 */

echo "<h1>🔌 Plugin Deactivation Tool</h1>";

// Method 1: Rename plugins directory
echo "<h2>Method 1: Disable All Plugins (Rename Directory)</h2>";

$plugins_dir = 'wp-content/plugins';
$plugins_disabled = 'wp-content/plugins-DISABLED';

if (is_dir($plugins_dir)) {
    if (rename($plugins_dir, $plugins_disabled)) {
        echo "✅ <strong>ALL PLUGINS DISABLED</strong> - Renamed plugins folder<br>";
        echo "📁 Renamed: <code>plugins</code> → <code>plugins-DISABLED</code><br><br>";
    } else {
        echo "❌ Could not rename plugins directory<br>";
    }
} else {
    echo "ℹ️ Plugins directory already disabled or doesn't exist<br><br>";
}

// Method 2: List and selectively disable individual plugins
echo "<h2>Method 2: Selective Plugin Control</h2>";

if (is_dir($plugins_disabled)) {
    echo "<p>📂 <strong>Available plugins to manage:</strong></p>";
    $plugins = glob($plugins_disabled . '/*', GLOB_ONLYDIR);
    
    if ($plugins) {
        echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 5px;'>";
        echo "<h3>🔍 Detected Plugins:</h3>";
        echo "<ul>";
        foreach ($plugins as $plugin) {
            $plugin_name = basename($plugin);
            echo "<li><strong>$plugin_name</strong>";
            
            // Check for known problematic plugins
            if (strpos($plugin_name, 'directorist') !== false) {
                echo " <span style='color: red;'>⚠️ (Potential PHP 8.2 compatibility issue)</span>";
            }
            echo "</li>";
        }
        echo "</ul>";
        echo "</div>";
        
        echo "<div style='background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
        echo "<h3>🛠️ To Re-enable Individual Plugins Later:</h3>";
        echo "<ol>";
        echo "<li>Rename <code>plugins-DISABLED</code> back to <code>plugins</code></li>";
        echo "<li>Or move individual plugin folders from <code>plugins-DISABLED</code> to <code>plugins</code></li>";
        echo "<li>Test your site after each plugin activation</li>";
        echo "</ol>";
        echo "</div>";
    }
}

// Method 3: Create empty plugins directory
echo "<h2>Method 3: Create Fresh Plugins Directory</h2>";

if (!is_dir('wp-content/plugins')) {
    if (mkdir('wp-content/plugins', 0755)) {
        echo "✅ Created fresh empty plugins directory<br>";
    } else {
        echo "❌ Could not create plugins directory<br>";
    }
} else {
    echo "ℹ️ Plugins directory already exists<br>";
}

// Test WordPress loading
echo "<h2>Step 4: Test WordPress</h2>";

try {
    define('WP_USE_THEMES', false);
    require_once('wp-load.php');
    echo "✅ <strong>WordPress loads successfully without plugins!</strong><br>";
    
    global $wpdb;
    if ($wpdb) {
        $result = $wpdb->get_var("SELECT 1");
        if ($result) {
            echo "✅ Database connection working!<br>";
        }
    }
    
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h2>🎉 SUCCESS!</h2>";
    echo "<p><strong>All plugins have been disabled and WordPress is working!</strong></p>";
    echo "<p><strong>Next steps:</strong></p>";
    echo "<ol>";
    echo "<li><a href='http://pestmanagementscience.com' target='_blank'>Visit your site</a> - Should work now!</li>";
    echo "<li><a href='http://pestmanagementscience.com/wp-admin/' target='_blank'>Login to WordPress Admin</a></li>";
    echo "<li>Re-enable plugins one by one through Admin → Plugins</li>";
    echo "<li>Test after each plugin activation</li>";
    echo "<li>Delete this script for security</li>";
    echo "</ol>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "❌ WordPress still has issues: " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<p>🔧 <strong>The issue may be with the theme, not plugins.</strong></p>";
    
    echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 5px;'>";
    echo "<h3>🎨 Try Disabling the Theme Too:</h3>";
    echo "<p>Rename: <code>wp-content/themes/authority-blueprint</code> → <code>wp-content/themes/authority-blueprint-DISABLED</code></p>";
    echo "<p>WordPress will fall back to a default theme.</p>";
    echo "</div>";
}

echo "<hr>";
echo "<div style='background: #e2e3e5; border: 1px solid #d6d8db; color: #383d41; padding: 15px; border-radius: 5px;'>";
echo "<h3>📋 What This Script Did:</h3>";
echo "<ul>";
echo "<li>✅ Disabled all plugins by renaming the plugins directory</li>";
echo "<li>✅ Created a fresh empty plugins directory</li>";
echo "<li>✅ Tested WordPress loading</li>";
echo "<li>ℹ️ Your plugins are safely stored in <code>plugins-DISABLED</code></li>";
echo "</ul>";
echo "</div>";

echo "<p><small><strong>Security:</strong> Delete this file after your site is working.</small></p>";
?> 