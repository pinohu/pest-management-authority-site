<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)

// a helper function to lookup "env_FILE", "env", then fallback
if (!function_exists('getenv_docker')) {
	// https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
	function getenv_docker($env, $default) {
		if ($fileEnv = getenv($env . '_FILE')) {
			return rtrim(file_get_contents($fileEnv), "\r\n");
		}
		else if (($val = getenv($env)) !== false) {
			return $val;
		}
		else {
			return $default;
		}
	}
}

// ** Database settings - CONFIGURED FOR 20i ** //
define('DB_NAME', 'pestmanagementsite-323038c8c2');  // Database name from 20i
define('DB_USER', 'pestmanagementsite-323038c8c2');   // Database username from 20i  
define('DB_PASSWORD', '8huilc2drh'); // Database password from 20i
define('DB_HOST', 'sdb-t.hosting.stackcp.net'); // Database host from 20i

/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/1356f6537220ffdc32b9dad2a6cdbe2d010b7a88/wp-admin/setup-config.php#L224-L238
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8') );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', '') );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'mV&8q#P9Kx!2$wR7@nL5zF*3jH6gB#uY8cD4sW@qE1rT9mV&5zA$3xP7!nK2fL*6g');
define('SECURE_AUTH_KEY',  'xP7!nK2fL*6g$B9cM&8q#V5zA@3sW7rT1jH4gF*9mY2uE8dC&6zA$5xP1!nK4fL*');
define('LOGGED_IN_KEY',    'zA$5xP1!nK4fL*9g$B2cM&7q#V8zA@6sW4rT3jH1gF*2mY5uE9dC&3zA$8xP4!nK');
define('NONCE_KEY',        'dC&3zA$8xP4!nK7fL*2g$B5cM&1q#V9zA@3sW7rT6jH4gF*8mY1uE2dC&9zA$6xP');
define('AUTH_SALT',        'zA@3sW7rT6jH4gF*8mY1uE2dC&9zA$6xP!nK5fL*1g$B8cM&4q#V2zA@9sW3rT7j');
define('SECURE_AUTH_SALT', 'H1gF*5mY8uE4dC&2zA$9xP7!nK1fL*4g$B6cM&3q#V5zA@8sW2rT9jH7gF*1mY3u');
define('LOGGED_IN_SALT',   'E6dC&5zA$2xP9!nK7fL*3g$B1cM&8q#V4zA@6sW5rT2jH9gF*7mY4uE1dC&8zA$5');
define('NONCE_SALT',       'xP3!nK9fL*6g$B4cM&2q#V7zA@1sW8rT5jH3gF*6mY9uE7dC&4zA$1xP2!nK8fL*');
// (See also https://wordpress.stackexchange.com/a/152905/199287)

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
	$_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

// ** WordPress URLs for pestmanagementscience.com ** //
define('WP_HOME','https://pestmanagementscience.com');
define('WP_SITEURL','https://pestmanagementscience.com');

// ** File system method ** //
define('FS_METHOD', 'direct');

// ** SSL Settings ** //
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $_SERVER['HTTPS'] = 'on';
    define('FORCE_SSL_ADMIN', true);
}

// ** Memory limit ** //
ini_set('memory_limit', '512M');

// ** Pest Management Science Authority Site Settings ** //
define('WPLANG', '');
define('WP_CACHE', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
