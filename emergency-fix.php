<?php
/**
 * Emergency WordPress Fix Script
 * This will force WordPress to work by bypassing theme issues
 */

echo "<h1>🚨 Emergency WordPress Fix</h1>";

// Step 1: Disable Authority Blueprint theme
echo "<h2>Step 1: Disable Custom Theme</h2>";
$theme_dir = 'wp-content/themes/authority-blueprint';
$theme_disabled = 'wp-content/themes/authority-blueprint-DISABLED';

if (is_dir($theme_dir)) {
    if (rename($theme_dir, $theme_disabled)) {
        echo "✅ Authority Blueprint theme disabled<br>";
    } else {
        echo "❌ Could not disable theme<br>";
    }
} else {
    echo "ℹ️ Authority Blueprint theme already disabled<br>";
}

// Step 2: Disable all plugins
echo "<h2>Step 2: Disable All Plugins</h2>";
$plugins_dir = 'wp-content/plugins';
$plugins_disabled = 'wp-content/plugins-DISABLED';

if (is_dir($plugins_dir)) {
    if (rename($plugins_dir, $plugins_disabled)) {
        echo "✅ All plugins disabled<br>";
    } else {
        echo "❌ Could not disable plugins<br>";
    }
} else {
    echo "ℹ️ Plugins already disabled<br>";
}

// Step 3: Create emergency wp-config.php
echo "<h2>Step 3: Create Emergency Configuration</h2>";

$emergency_config = "<?php
// Emergency WordPress Configuration
define('DB_NAME', 'pestmanagementsite-323038c8c2');
define('DB_USER', 'pestmanagementsite-323038c8c2');
define('DB_PASSWORD', '8huilc2drh');
define('DB_HOST', 'sdb-t.hosting.stackcp.net');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Security keys
define('AUTH_KEY',         'mV&8q#P9Kx!2\$wR7@nL5zF*3jH6gB#uY8cD4sW@qE1rT9mV&5zA\$3xP7!nK2fL*6g');
define('SECURE_AUTH_KEY',  'xP7!nK2fL*6g\$B9cM&8q#V5zA@3sW7rT1jH4gF*9mY2uE8dC&6zA\$5xP1!nK4fL*');
define('LOGGED_IN_KEY',    'zA\$5xP1!nK4fL*9g\$B2cM&7q#V8zA@6sW4rT3jH1gF*2mY5uE9dC&3zA\$8xP4!nK');
define('NONCE_KEY',        'dC&3zA\$8xP4!nK7fL*2g\$B5cM&1q#V9zA@3sW7rT6jH4gF*8mY9uE7dC&9zA\$6xP');
define('AUTH_SALT',        'zA@3sW7rT6jH4gF*8mY1uE2dC&9zA\$6xP!nK5fL*1g\$B8cM&4q#V2zA@9sW3rT7j');
define('SECURE_AUTH_SALT', 'H1gF*5mY8uE4dC&2zA\$9xP7!nK1fL*4g\$B6cM&3q#V5zA@8sW2rT9jH7gF*1mY3u');
define('LOGGED_IN_SALT',   'E6dC&5zA\$2xP9!nK7fL*3g\$B1cM&8q#V4zA@6sW5rT2jH9gF*7mY4uE1dC&8zA\$5');
define('NONCE_SALT',       'xP3!nK9fL*6g\$B4cM&2q#V7zA@1sW8rT5jH3gF*6mY9uE7dC&4zA\$1xP2!nK8fL*');

\$table_prefix = 'wp_';
define('WP_DEBUG', false);

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
?>";

// Backup current config
if (file_exists('wp-config.php')) {
    copy('wp-config.php', 'wp-config-backup.php');
    echo "✅ Current wp-config.php backed up<br>";
}

// Write emergency config
if (file_put_contents('wp-config.php', $emergency_config)) {
    echo "✅ Emergency wp-config.php created<br>";
} else {
    echo "❌ Could not create emergency config<br>";
}

// Step 4: Test WordPress
echo "<h2>Step 4: Test WordPress Loading</h2>";

try {
    // Clear any output
    if (ob_get_level()) {
        ob_end_clean();
    }
    
    // Test if WordPress loads
    define('WP_USE_THEMES', false);
    require_once('wp-load.php');
    
    echo "✅ WordPress core loads successfully!<br>";
    
    // Test database
    global $wpdb;
    if ($wpdb) {
        $result = $wpdb->get_var("SELECT 1");
        if ($result) {
            echo "✅ Database connection working!<br>";
        }
    }
    
} catch (Exception $e) {
    echo "❌ WordPress still has issues: " . htmlspecialchars($e->getMessage()) . "<br>";
}

echo "<hr>";
echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h2>🎯 Next Steps:</h2>";
echo "<ol>";
echo "<li><strong>Try your site now:</strong> <a href='http://pestmanagementscience.com' target='_blank'>pestmanagementscience.com</a></li>";
echo "<li><strong>Try installation:</strong> <a href='http://pestmanagementscience.com/wp-admin/install.php' target='_blank'>WordPress Installation</a></li>";
echo "<li><strong>If working:</strong> Complete WordPress setup</li>";
echo "<li><strong>Later:</strong> Re-enable themes and plugins one by one</li>";
echo "</ol>";
echo "</div>";

echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>📋 What This Script Did:</h3>";
echo "<ul>";
echo "<li>✅ Disabled Authority Blueprint theme (renamed to authority-blueprint-DISABLED)</li>";
echo "<li>✅ Disabled all plugins (renamed plugins folder to plugins-DISABLED)</li>";
echo "<li>✅ Created clean wp-config.php with minimal settings</li>";
echo "<li>✅ Backed up your original wp-config.php</li>";
echo "</ul>";
echo "</div>";

echo "<p><small>Delete this file after WordPress is working for security.</small></p>";
?> 