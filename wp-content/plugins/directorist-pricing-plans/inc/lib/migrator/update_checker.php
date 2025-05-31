<?php

namespace Directorist_Pricing_Plan\Lib\Migrator;

class Update_Checker {
	public $prefix          = '';
	public $current_version = '';

	public function __construct( $prefix = '', $current_version = '' ) {
		if ( ! empty( $prefix ) ) {
			$this->prefix = $prefix;
		}

		if ( ! empty( $current_version ) ) {
			$this->current_version = $current_version;
		}

		add_action( 'init', [ $this, 'setup_update_checker' ] );
	}

	public function setup_update_checker() {
		$db_version      = $this->get_db_version();
		$current_version = $this->current_version;

		if ( empty( $db_version ) || version_compare( $db_version, $current_version, '<' ) ) {
			$this->update_db_version( $current_version );
			$this->update_db_version( $db_version, 'previous' );

			do_action( $this->with_prefix( 'upgraded' ), $db_version );
		} else if ( version_compare( $db_version, $current_version, '>' ) ) {
			$this->update_db_version( $current_version );
			$this->update_db_version( $db_version, 'previous' );

			do_action( $this->with_prefix( 'downgraded' ), $db_version );
		}
	}

	/**
	 * Get DB version.
	 *
	 * @param string $type current|previous
	 * @since 0.14
	 *
	 * @return string Version
	 */
	public function get_db_version( $type = 'current' ) {
		$option_key = ( 'current' === $type ) ? $this->with_prefix( 'db_version' ) : $this->with_prefix( 'previous_db_version' );
		return get_option( $option_key, '' );
	}

	/**
	 * Update DB version to current.
	 *
	 * @since 0.14
	 * @param string|null $version New HelpGent DB version or null.
	 * @param string $type current|previous
	 *
	 * @return void
	 */
	public function update_db_version( $version = '', $type = 'current' ) {
		$option_key = ( 'current' === $type ) ? $this->with_prefix( 'db_version' ) : $this->with_prefix( 'previous_db_version' );

		delete_option( $option_key );
		add_option( $option_key, empty( $version ) ? $this->current_version : $version );
	}

	/**
	 * With Prefix
	 * 
	 * @param string $key
	 * @return string Key With Prefix
	 */
	public function with_prefix( $key ) {
		return $this->prefix . '_' . $key;
	}
}