<?php
/**
 * WordPress Critical Error Diagnostic
 * Upload this to see detailed error information
 */

// Turn on all error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "<h1>🔍 WordPress Critical Error Diagnostic</h1>";

// Check basic PHP functionality
echo "<h2>1. PHP Environment Check</h2>";
echo "<strong>PHP Version:</strong> " . phpversion() . "<br>";
echo "<strong>Memory Limit:</strong> " . ini_get('memory_limit') . "<br>";
echo "<strong>Max Execution Time:</strong> " . ini_get('max_execution_time') . " seconds<br>";

// Check if WordPress files exist
echo "<h2>2. WordPress Files Check</h2>";
$required_files = [
    'wp-config.php',
    'wp-load.php', 
    'wp-settings.php',
    'wp-includes/wp-db.php',
    'wp-admin/index.php'
];

foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "✅ <strong>$file</strong> - EXISTS<br>";
    } else {
        echo "❌ <strong>$file</strong> - MISSING<br>";
    }
}

// Check if wp-content directories exist
echo "<h2>3. WordPress Directories Check</h2>";
$required_dirs = [
    'wp-content',
    'wp-content/themes',
    'wp-content/plugins',
    'wp-content/themes/authority-blueprint'
];

foreach ($required_dirs as $dir) {
    if (is_dir($dir)) {
        echo "✅ <strong>$dir/</strong> - EXISTS<br>";
    } else {
        echo "❌ <strong>$dir/</strong> - MISSING<br>";
    }
}

// Try to load WordPress with error catching
echo "<h2>4. WordPress Loading Test</h2>";

try {
    // Set up WordPress environment
    define('WP_USE_THEMES', false);
    define('WP_DEBUG', true);
    define('WP_DEBUG_DISPLAY', true);
    
    // Capture any output
    ob_start();
    
    if (file_exists('wp-load.php')) {
        echo "Attempting to load WordPress...<br>";
        require_once('wp-load.php');
        echo "✅ WordPress loaded successfully!<br>";
        
        // Test database connection through WordPress
        global $wpdb;
        if (isset($wpdb)) {
            echo "✅ Database object created successfully<br>";
            $result = $wpdb->get_var("SELECT 1");
            if ($result) {
                echo "✅ Database query test successful<br>";
            }
        }
        
    } else {
        echo "❌ wp-load.php not found<br>";
    }
    
    $output = ob_get_clean();
    echo $output;
    
} catch (Error $e) {
    ob_end_clean();
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h3>❌ Fatal Error Detected:</h3>";
    echo "<strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<strong>File:</strong> " . htmlspecialchars($e->getFile()) . "<br>";
    echo "<strong>Line:</strong> " . $e->getLine() . "<br>";
    echo "</div>";
} catch (Exception $e) {
    ob_end_clean();
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h3>❌ Exception Detected:</h3>";
    echo "<strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "<br>";
    echo "<strong>File:</strong> " . htmlspecialchars($e->getFile()) . "<br>";
    echo "<strong>Line:</strong> " . $e->getLine() . "<br>";
    echo "</div>";
}

// Check for common issues
echo "<h2>5. Common Issues Check</h2>";

// Check file permissions
if (is_writable('wp-content')) {
    echo "✅ wp-content directory is writable<br>";
} else {
    echo "❌ wp-content directory is not writable<br>";
}

// Check for error logs
if (file_exists('wp-content/debug.log')) {
    echo "📄 <strong>Debug log found:</strong> wp-content/debug.log<br>";
    $log_content = file_get_contents('wp-content/debug.log');
    if ($log_content) {
        $lines = explode("\n", $log_content);
        $recent_lines = array_slice($lines, -10); // Last 10 lines
        echo "<div style='background: #f8f9fa; border: 1px solid #dee2e6; padding: 10px; margin: 10px 0; font-family: monospace; font-size: 12px;'>";
        echo "<strong>Recent debug log entries:</strong><br>";
        foreach ($recent_lines as $line) {
            if (trim($line)) {
                echo htmlspecialchars($line) . "<br>";
            }
        }
        echo "</div>";
    }
}

echo "<hr>";
echo "<h2>🔧 Recommended Actions:</h2>";
echo "<ol>";
echo "<li><strong>Check the specific error above</strong> for exact issue</li>";
echo "<li><strong>Try a minimal wp-config.php</strong> without custom themes</li>";
echo "<li><strong>Disable all plugins temporarily</strong></li>";
echo "<li><strong>Switch to a default WordPress theme</strong></li>";
echo "<li><strong>Contact 20i support</strong> with the specific error message</li>";
echo "</ol>";

echo "<p><small>Delete this file after diagnosis for security.</small></p>";
?> 