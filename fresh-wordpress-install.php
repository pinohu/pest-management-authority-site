<?php
/**
 * Fresh WordPress Installation Script
 * Downloads and installs the latest WordPress version
 */

set_time_limit(300); // 5 minutes
ini_set('memory_limit', '256M');

echo "<h1>🔄 Fresh WordPress Installation</h1>";

// Step 1: Download fresh WordPress
echo "<h2>Step 1: Download Latest WordPress</h2>";

$wp_url = 'https://wordpress.org/latest.zip';
$wp_zip = 'wordpress-fresh.zip';

echo "Downloading WordPress from: $wp_url<br>";

$context = stream_context_create([
    'http' => [
        'timeout' => 60,
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
    ]
]);

$wp_content = file_get_contents($wp_url, false, $context);

if ($wp_content === false) {
    echo "❌ Failed to download WordPress<br>";
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px;'>";
    echo "<h3>Alternative Solutions:</h3>";
    echo "<ol>";
    echo "<li><strong>Use 20i's WordPress Installer:</strong><br>";
    echo "- Login to 20i control panel<br>";
    echo "- Find 'WordPress' or 'One-click install'<br>";
    echo "- Install WordPress directly on pestmanagementscience.com</li>";
    echo "<li><strong>Contact 20i Support:</strong><br>";
    echo "- Ask them to install WordPress for you<br>";
    echo "- Mention you're getting PHP fatal errors</li>";
    echo "</ol>";
    echo "</div>";
    exit;
}

if (file_put_contents($wp_zip, $wp_content)) {
    echo "✅ WordPress downloaded successfully (" . number_format(strlen($wp_content)) . " bytes)<br>";
} else {
    echo "❌ Failed to save WordPress zip file<br>";
    exit;
}

// Step 2: Backup current installation
echo "<h2>Step 2: Backup Current Installation</h2>";

$backup_dir = 'backup-' . date('Y-m-d-H-i-s');
if (mkdir($backup_dir, 0755)) {
    echo "✅ Created backup directory: $backup_dir<br>";
    
    // Move important files to backup
    $important_files = ['wp-config.php', 'wp-config-backup.php'];
    foreach ($important_files as $file) {
        if (file_exists($file)) {
            copy($file, "$backup_dir/$file");
            echo "✅ Backed up: $file<br>";
        }
    }
    
    // Backup wp-content if it exists
    if (is_dir('wp-content')) {
        rename('wp-content', "$backup_dir/wp-content");
        echo "✅ Backed up: wp-content<br>";
    }
} else {
    echo "❌ Could not create backup directory<br>";
}

// Step 3: Clean current installation
echo "<h2>Step 3: Clean Current Installation</h2>";

$files_to_remove = [
    'wp-admin', 'wp-includes', 'index.php', 'wp-load.php', 
    'wp-settings.php', 'wp-blog-header.php', 'wp-cron.php',
    'wp-login.php', 'wp-mail.php', 'wp-signup.php', 'wp-trackback.php',
    'xmlrpc.php', 'wp-activate.php', 'wp-comments-post.php',
    'wp-links-opml.php'
];

foreach ($files_to_remove as $item) {
    if (is_dir($item)) {
        removeDirectory($item);
        echo "✅ Removed directory: $item<br>";
    } elseif (file_exists($item)) {
        unlink($item);
        echo "✅ Removed file: $item<br>";
    }
}

// Step 4: Extract fresh WordPress
echo "<h2>Step 4: Extract Fresh WordPress</h2>";

$zip = new ZipArchive;
if ($zip->open($wp_zip) === TRUE) {
    $zip->extractTo('./');
    $zip->close();
    echo "✅ WordPress extracted successfully<br>";
    
    // Move files from wordpress/ directory to root
    if (is_dir('wordpress')) {
        $files = glob('wordpress/*');
        foreach ($files as $file) {
            $filename = basename($file);
            if (is_dir($file)) {
                rename($file, $filename);
            } else {
                rename($file, $filename);
            }
        }
        rmdir('wordpress');
        echo "✅ Moved WordPress files to root directory<br>";
    }
    
    // Clean up zip file
    unlink($wp_zip);
} else {
    echo "❌ Failed to extract WordPress<br>";
    exit;
}

// Step 5: Restore wp-content and configuration
echo "<h2>Step 5: Restore Content and Configuration</h2>";

// Restore wp-content if backed up
if (is_dir("$backup_dir/wp-content")) {
    rename("$backup_dir/wp-content", 'wp-content');
    echo "✅ Restored wp-content directory<br>";
}

// Create fresh wp-config.php
$wp_config = "<?php
// Fresh WordPress Configuration for pestmanagementscience.com
define('DB_NAME', 'pestmanagementsite-323038c8c2');
define('DB_USER', 'pestmanagementsite-323038c8c2');
define('DB_PASSWORD', '8huilc2drh');
define('DB_HOST', 'sdb-t.hosting.stackcp.net');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// Security keys - fresh set
define('AUTH_KEY',         'fresh-key-1-" . wp_generate_password(64, true) . "');
define('SECURE_AUTH_KEY',  'fresh-key-2-" . wp_generate_password(64, true) . "');
define('LOGGED_IN_KEY',    'fresh-key-3-" . wp_generate_password(64, true) . "');
define('NONCE_KEY',        'fresh-key-4-" . wp_generate_password(64, true) . "');
define('AUTH_SALT',        'fresh-salt-1-" . wp_generate_password(64, true) . "');
define('SECURE_AUTH_SALT', 'fresh-salt-2-" . wp_generate_password(64, true) . "');
define('LOGGED_IN_SALT',   'fresh-salt-3-" . wp_generate_password(64, true) . "');
define('NONCE_SALT',       'fresh-salt-4-" . wp_generate_password(64, true) . "');

\$table_prefix = 'wp_';
define('WP_DEBUG', false);

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php';
?>";

if (file_put_contents('wp-config.php', $wp_config)) {
    echo "✅ Created fresh wp-config.php<br>";
} else {
    echo "❌ Failed to create wp-config.php<br>";
}

// Step 6: Test installation
echo "<h2>Step 6: Test Fresh Installation</h2>";

try {
    define('WP_USE_THEMES', false);
    require_once('wp-load.php');
    echo "✅ Fresh WordPress loads successfully!<br>";
    
    global $wpdb;
    if ($wpdb) {
        $result = $wpdb->get_var("SELECT 1");
        if ($result) {
            echo "✅ Database connection working!<br>";
        }
    }
    
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h2>🎉 SUCCESS!</h2>";
    echo "<p>Fresh WordPress installation completed successfully!</p>";
    echo "<p><strong>Next steps:</strong></p>";
    echo "<ol>";
    echo "<li><a href='http://pestmanagementscience.com' target='_blank'>Visit your site</a></li>";
    echo "<li><a href='http://pestmanagementscience.com/wp-admin/install.php' target='_blank'>Complete WordPress setup</a></li>";
    echo "<li>Delete this script for security</li>";
    echo "</ol>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "❌ WordPress still has issues: " . htmlspecialchars($e->getMessage()) . "<br>";
    
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px;'>";
    echo "<h3>🔧 Server Issue Detected</h3>";
    echo "<p>The problem appears to be with the server configuration, not WordPress files.</p>";
    echo "<p><strong>Recommended action:</strong> Contact 20i support with this error message.</p>";
    echo "</div>";
}

// Helper function to remove directories recursively
function removeDirectory($dir) {
    if (!is_dir($dir)) return false;
    $files = glob($dir . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    return rmdir($dir);
}

// Generate password function fallback
if (!function_exists('wp_generate_password')) {
    function wp_generate_password($length = 12, $special_chars = true) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ($special_chars) {
            $chars .= '!@#$%^&*()_+-=[]{}|;:,.<>?';
        }
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $password;
    }
}

echo "<p><small>Delete this file after WordPress is working for security.</small></p>";
?> 