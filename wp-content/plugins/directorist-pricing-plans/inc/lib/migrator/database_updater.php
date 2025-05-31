<?php

namespace Directorist_Pricing_Plan\Lib\Migrator;

class Database_Updater {
	public $prefix                            = '';
	public $current_version                   = '';
	public $before_start_migration_callback   = null;
	public $after_complete_migration_callback = null;

	public $update_checker;

	/**
	 * Background update class.
	 * 
	 * @var object
	 */
	private static $background_updater;

	public function __construct( $prefix = '', $current_version = '', $update_checker = null, $before_start_migration_callback = null, $after_complete_migration_callback = null ) {
		$this->prefix                            = $prefix;
		$this->current_version                   = $current_version;
		$this->update_checker                    = $update_checker;
		$this->before_start_migration_callback   = is_callable( $before_start_migration_callback ) ? $before_start_migration_callback : null;
		$this->after_complete_migration_callback = is_callable( $after_complete_migration_callback ) ? $after_complete_migration_callback : null;

		$this->includes();

		add_action( 'init', [ $this, 'init_background_updater' ], 5 );
		add_action( $this->prefix . '_upgraded', [ $this, 'init_migration' ] );
	}

	public function init_background_updater() {
		self::$background_updater = new Background_Updater( $this->after_complete_migration_callback );
	}

	public function init_migration() {
		$needs_db_update = $this->needs_db_update();

		if ( ! $needs_db_update ) {
			return;
		}

		$this->update();
	}

	public function get_db_update_callbacks() {
		return apply_filters( $this->prefix . '_db_update_callbacks', [
			// 'global' => [
			// 	[
			// 		'callback' => [ Global_Migration::class, 'update_database' ],
			// 	]
			// ],
			// '0.1' => [
			// 	[
			// 		'callback' => [ V_0_1::class, 'update_database' ]
			// 	],
			// ],
		]);
	}

	public function update() {
		$current_version     = $this->current_version;
		$previous_db_version = $this->update_checker->get_db_version( 'previous' );
		$update_queued       = false;

		foreach ( self::get_db_update_callbacks() as $migration_version => $update_callbacks ) {
			if ( 'global' === $migration_version || version_compare( $migration_version, $previous_db_version, '>' ) || version_compare( $current_version, $migration_version, '=' ) ) {
				foreach ( $update_callbacks as $update_callback ) {
					self::$background_updater->push_to_queue( $update_callback );
				}
			}
		}

		if ( ! $update_queued ) {
			return;
		}

		if ( is_callable( $this->before_start_migration_callback ) ) {
			call_user_func( $this->before_start_migration_callback );
		}

		self::$background_updater->save()->dispatch();
	}

	public function needs_db_update() {
		$current_version  = $this->current_version;
		$update_callbacks = $this->get_db_update_callbacks();

		if ( empty( $update_callbacks ) ) {
			return false;
		}

		if ( ! empty( $update_callbacks[ 'global' ] ) ) {
			return true;
		}

		return ( is_null( $current_version ) || version_compare( $current_version, max( array_keys( $update_callbacks ) ), '=' ) );
	}

	/**
     * Includes
     * 
     * @return void
     */
    public function includes() {
        include_once dirname( __FILE__ ) . '/background_updater.php';
    }
}