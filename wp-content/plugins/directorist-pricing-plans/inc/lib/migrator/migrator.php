<?php

namespace Directorist_Pricing_Plan\Lib\Migrator;

class Migrator {

    public $prefix          = '';
	public $current_version = '';

    public $before_start_migration_callback   = null;
	public $after_complete_migration_callback = null;

	public $update_checker;
	public $database_update;

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct( $prefix = '', $current_version = '', $before_start_migration_callback = null, $after_complete_migration_callback = null ) {
		$this->prefix                            = $prefix;
		$this->current_version                   = $current_version;
		$this->before_start_migration_callback   = is_callable( $before_start_migration_callback ) ? $before_start_migration_callback : null;
		$this->after_complete_migration_callback = is_callable( $after_complete_migration_callback ) ? $after_complete_migration_callback : null;

        $this->includes();
        $this->setup();
    }

    /**
     * Setup
     * 
     * @return void
     */
    public function setup() {
        $this->update_checker  = new Update_Checker( $this->prefix, $this->current_version );
        $this->database_update = new Database_Updater( 
            $this->prefix, $this->current_version,
            $this->update_checker,
            $this->before_start_migration_callback,
            $this->after_complete_migration_callback
        );
    }

    /**
     * Includes
     * 
     * @return void
     */
    public function includes() {
        include_once dirname( __FILE__ ) . '/update_checker.php';
        include_once dirname( __FILE__ ) . '/database_updater.php';
    }

}