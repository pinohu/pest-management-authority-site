<?php

namespace Directorist_Pricing_Plan\Lib\Logger;

class Logger {

    public static function get_key_log( $namespace, $log_key = '' ) {
        $logger = get_option( 'dpp_logger', [] );

        if ( ! is_array( $logger ) ) {
            return [];
        }

        if ( ! isset( $logger[ $namespace ] ) ) {
            return [];
        }

        if ( empty( $log_key ) ) {
            return $logger[ $namespace ];
        }

        if ( ! isset( $logger[ $namespace ][ $log_key ] ) ) {
            return [];
        }

        return $logger[ $namespace ][ $log_key ];
    }

	public static function update_key_log( $namespace, $log_key, $data ) {
		$logger = get_option( 'dpp_logger', [] );

		if ( ! is_array( $logger ) ) {
			$logger = [];
		}

        if ( ! isset( $logger[ $namespace ] ) ) {
            $logger[ $namespace ] = [];
        }

        if ( ! isset( $logger[ $namespace ][ $log_key ] ) ) {
            $logger[ $namespace ][ $log_key ] = [];
        }

        if ( ! is_array( $logger[ $namespace ][ $log_key ] ) ) {
			$logger[ $namespace ][ $log_key ] = [];
		}

        $logger[ $namespace ][ $log_key ] = array_merge( $logger[ $namespace ][ $log_key ], $data );
		
		update_option( 'dpp_logger', $logger );
	}

    public static function remove_key_log( $namespace, $log_key = '' ) {
        $logger = get_option( 'dpp_logger', [] );

		if ( ! is_array( $logger ) ) {
			return;
		}

        if ( ! isset( $logger[ $namespace ] ) ) {
            return;
        }

        if ( empty( $log_key ) ) {
            unset( $logger[ $namespace ] );
            update_option( 'dpp_logger', $logger );
            return;
        }

        if ( ! isset( $logger[ $namespace ][ $log_key ] ) ) {
            return;
        }

        unset( $logger[ $namespace ][ $log_key ] );

        update_option( 'dpp_logger', $logger );
    }
}