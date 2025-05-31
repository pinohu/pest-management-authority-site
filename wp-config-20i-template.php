<?php
/**
 * WordPress Configuration for 20i.com Hosting
 * 
 * INSTRUCTIONS:
 * 1. Rename this file to 'wp-config.php'
 * 2. Update database details from your 20i control panel
 * 3. Generate new security keys at: https://api.wordpress.org/secret-key/1.1/salt/
 * 4. Update your domain name
 */

// ** Database settings ** //
// Get these details from your 20i.com control panel > Databases
define('DB_NAME', 'your_20i_database_name_here');
define('DB_USER', 'your_20i_database_user_here');
define('DB_PASSWORD', 'your_20i_database_password_here');
define('DB_HOST', 'localhost'); // Usually 'localhost' for 20i

// ** Database Table prefix ** //
$table_prefix = 'wp_';

// ** Authentication Unique Keys and Salts ** //
// Generate these at: https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

// ** WordPress debugging ** //
// Set to false for production
define('WP_DEBUG', false);

// ** WordPress URLs ** //
// Update with your actual 20i domain
define('WP_HOME','https://your-domain.com');
define('WP_SITEURL','https://your-domain.com');

// ** File system method ** //
// 20i typically uses 'direct'
define('FS_METHOD', 'direct');

// ** SSL Settings ** //
// 20i provides free SSL certificates
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $_SERVER['HTTPS'] = 'on';
    define('FORCE_SSL_ADMIN', true);
}

// ** Memory limit ** //
// 20i typically allows higher memory limits
ini_set('memory_limit', '512M');

// ** Pest Management Science Authority Site Specific Settings ** //
define('WPLANG', '');
define('WP_CACHE', true); // Enable caching

// ** That's all, stop editing! Happy publishing. ** //

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
?> 