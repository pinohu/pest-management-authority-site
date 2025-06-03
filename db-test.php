<?php
/**
 * Database Connection Test for pestmanagementscience.com
 * Upload this file to test your database connection
 */

// Database credentials from your wp-config.php
$db_name = 'pestmanagementsite-323038c8c2';
$db_user = 'pestmanagementsite-323038c8c2';
$db_password = '8huilc2drh';
$db_host = 'sdb-t.hosting.stackcp.net';

echo "<h1>🔍 Database Connection Test</h1>";
echo "<p><strong>Testing connection to:</strong></p>";
echo "<ul>";
echo "<li><strong>Host:</strong> " . htmlspecialchars($db_host) . "</li>";
echo "<li><strong>Database:</strong> " . htmlspecialchars($db_name) . "</li>";
echo "<li><strong>Username:</strong> " . htmlspecialchars($db_user) . "</li>";
echo "<li><strong>Password:</strong> " . str_repeat('*', strlen($db_password)) . "</li>";
echo "</ul>";

// Test the connection
try {
    $pdo = new PDO(
        "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4",
        $db_user,
        $db_password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    
    echo "<div style='background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h2>✅ SUCCESS!</h2>";
    echo "<p>Database connection established successfully!</p>";
    echo "<p><strong>MySQL Version:</strong> " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "</p>";
    echo "</div>";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT NOW() as current_time");
    $result = $stmt->fetch();
    echo "<p><strong>Current server time:</strong> " . htmlspecialchars($result['current_time']) . "</p>";
    
    echo "<div style='background: #cce7ff; border: 1px solid #99d6ff; color: #004085; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h3>🎯 Next Steps:</h3>";
    echo "<ol>";
    echo "<li>Your database connection is working!</li>";
    echo "<li>Delete this db-test.php file from your server</li>";
    echo "<li>Visit your main site: <a href='http://pestmanagementscience.com'>pestmanagementscience.com</a></li>";
    echo "<li>WordPress should now load properly</li>";
    echo "</ol>";
    echo "</div>";

} catch (PDOException $e) {
    echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h2>❌ Connection Failed</h2>";
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "</div>";
    
    echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
    echo "<h3>🔧 Troubleshooting Steps:</h3>";
    echo "<ol>";
    echo "<li><strong>Check with 20i Support:</strong> Database might need activation</li>";
    echo "<li><strong>Verify database details:</strong> Login to 20i control panel → MySQL section</li>";
    echo "<li><strong>Wait a few minutes:</strong> New databases can take time to activate</li>";
    echo "<li><strong>Contact 20i:</strong> They can verify the database is ready</li>";
    echo "</ol>";
    echo "</div>";
}

echo "<hr>";
echo "<p><small>Delete this file after testing for security.</small></p>";
?> 