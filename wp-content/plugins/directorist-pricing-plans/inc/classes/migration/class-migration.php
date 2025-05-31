<?php

use Directorist_Pricing_Plan\Lib\Migrator\Migrator;

class Migration {

    public function __construct() {
        $this->setup_migrator();
        $this->include_migration_callbacks();

        add_action( 'admin_init', [ $this, 'setup_migration_admin_notice' ] );
    }

    public function setup_migrator() : void {
        new Migrator( 
            ATPP_PREFIIX, 
            ATPP_VERSION, 
            [ $this, 'before_start_migration_callback' ],
            [ $this, 'after_complete_migration_callback' ]
        );
    }

    public function get_migration_callbacks() : array {
        return [
            'global-migration',
        ];
    }

    public function before_start_migration_callback() : void {
        directorist_pp_update_migration_active_status( true );
        directorist_pp_update_version_migration_status( ATPP_VERSION, false );
    }

    public function after_complete_migration_callback() : void {
        directorist_pp_update_migration_active_status( false );
        directorist_pp_update_version_migration_status( ATPP_VERSION, true );
    }

    public function setup_migration_admin_notice() : void {
        if ( ! directorist_pp_is_active_migration() ) {
            return;
        }

        add_action( 'admin_notices', [ $this, 'migration_status_notice' ] );
    }

    public function migration_status_notice() : void {
        ?>
        <div class="notice notice-warning is-dismissible">
            <h3><strong><?php echo esc_html( 'Directorist Pricing Plans' ); ?></strong></h3>
            <p><?php _e( 'A database migration process is running in the background, so you might see unexpected behavior in the Directorist app until the migration process is finished. Please wait until the migration is done.', 'directorist-pricing-plans' ); ?></p>
        </div>
        <?php
    }

    public function include_migration_callbacks() : void {
        foreach( $this->get_migration_callbacks() as $callback ) {
            $path = dirname( __FILE__ ) . "/callbacks/class-{$callback}.php";

            if ( ! file_exists( $path ) ) {
                continue;
            }

            include_once $path;
        }
    }

}