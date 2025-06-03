<?php
/**
 * MINIMAL wp-config.php for pestmanagementscience.com
 * This removes all custom settings to isolate the issue
 */

// ** Database settings - VERIFIED WORKING ** //
define('DB_NAME', 'pestmanagementsite-323038c8c2');  
define('DB_USER', 'pestmanagementsite-323038c8c2');   
define('DB_PASSWORD', '8huilc2drh'); 
define('DB_HOST', 'sdb-t.hosting.stackcp.net');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 */
define('AUTH_KEY',         'mV&8q#P9Kx!2$wR7@nL5zF*3jH6gB#uY8cD4sW@qE1rT9mV&5zA$3xP7!nK2fL*6g');
define('SECURE_AUTH_KEY',  'xP7!nK2fL*6g$B9cM&8q#V5zA@3sW7rT1jH4gF*9mY2uE8dC&6zA$5xP1!nK4fL*');
define('LOGGED_IN_KEY',    'zA$5xP1!nK4fL*9g$B2cM&7q#V8zA@6sW4rT3jH1gF*2mY5uE9dC&3zA$8xP4!nK');
define('NONCE_KEY',        'dC&3zA$8xP4!nK7fL*2g$B5cM&1q#V9zA@3sW7rT6jH4gF*8mY9uE7dC&9zA$6xP');
define('AUTH_SALT',        'zA@3sW7rT6jH4gF*8mY1uE2dC&9zA$6xP!nK5fL*1g$B8cM&4q#V2zA@9sW3rT7j');
define('SECURE_AUTH_SALT', 'H1gF*5mY8uE4dC&2zA$9xP7!nK1fL*4g$B6cM&3q#V5zA@8sW2rT9jH7gF*1mY3u');
define('LOGGED_IN_SALT',   'E6dC&5zA$2xP9!nK7fL*3g$B1cM&8q#V4zA@6sW5rT2jH9gF*7mY4uE1dC&8zA$5');
define('NONCE_SALT',       'xP3!nK9fL*6g$B4cM&2q#V7zA@1sW8rT5jH3gF*6mY9uE7dC&4zA$1xP2!nK8fL*');

/**#@-*/

/**
 * WordPress database table prefix.
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
?> 