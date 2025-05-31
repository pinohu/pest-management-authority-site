<?php
// Plugin version.
if ( ! defined( 'DT_STRIPE_VERSION' ) ) { define( 'DT_STRIPE_VERSION', directorist_stripe_get_version_from_file_content( DT_STRIPE_FILE ) );}
// API version.
if ( ! defined( 'DT_STRIPE_API_VERSION' ) ) {define( 'DT_STRIPE_API_VERSION', '2019-08-14' );}
// Plugin Folder Path.
if ( ! defined( 'DT_STRIPE_DIR' ) ) { define( 'DT_STRIPE_DIR', plugin_dir_path( DT_STRIPE_FILE ) ); }
// Plugin Folder URL.
if ( ! defined( 'DT_STRIPE_URL' ) ) { define( 'DT_STRIPE_URL', plugin_dir_url( DT_STRIPE_FILE ) ); }
// Plugin Root File.
if ( ! defined( 'DT_STRIPE_BASE' ) ) { define( 'DT_STRIPE_BASE', plugin_basename( DT_STRIPE_FILE ) ); }
// Plugin Library Path
if ( !defined('DT_STRIPE_LIB_DIR') ) { define('DT_STRIPE_LIB_DIR', DT_STRIPE_DIR.'stripe-php-sdk/'); }
// Plugin Language File Path
if ( !defined('DT_STRIPE_LANG_DIR') ) { define('DT_STRIPE_LANG_DIR', dirname(plugin_basename( DT_STRIPE_FILE ) ) . '/languages'); }

// plugin author url
if (!defined('ATBDP_AUTHOR_URL')) {
    define('ATBDP_AUTHOR_URL', 'https://directorist.com');
}
// post id from download post type (edd)
if (!defined('ATBDP_STRIPE_POST_ID')) {
    define('ATBDP_STRIPE_POST_ID', 13700 );
}
