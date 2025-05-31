<?php

namespace Directorist_Pricing_Plan\Lib\WP_Background_Processing;

use Directorist_Pricing_Plan\Lib\WP_Background_Processing\WP_Background_Process;
use Exception;

class Core_Background_Process extends WP_Background_Process {

	protected $action                  = 'pricing_plan_background_process';
	public    $after_complete_callback = null;

	public function __construct( $after_complete_callback = null ) {
		parent::__construct();
		$this->after_complete_callback = $after_complete_callback;
	}

	/**
	 * Task
	 *
	 * Override this method to perform any actions required on each
	 * queue item. Return the modified item for further processing
	 * in the next pass through. Or, return false to remove the
	 * item from the queue.
	 *
	 * @param mixed $item Queue item to iterate over
	 *
	 * @return mixed
	 */
	protected function task( $item ) {
		if ( ! $this->is_valid_task( $item ) ) {
			error_log( print_r( [
				'data' => [
					'message' => __( 'The task is not valid', '' ),
					'task'    => $item,
				],
				'path' => __FILE__ . ':' . __LINE__,
			], true ) );
			return false;
		}

		try {
            $args     = isset( $item[ 'args' ] ) && is_array( $item[ 'args' ] ) ? $item[ 'args' ] : [];
            $callback = call_user_func_array( $item[ 'callback' ], [ $args ] );

            if ( false === $callback ) {
                return false;
            }

            if ( is_array( $callback ) ) {
                $item[ 'args' ] = array_merge( $args, $callback );
            }

            return $item;
        } catch ( Exception $e ) {
			error_log( print_r( [
				'data' => [
					'message'       => __( 'The background processor was stopped due to an error', '' ),
					'error_message' => $e->getMessage(),
					'task'          => $item,
				],
				'path' => __FILE__ . ':' . __LINE__,
			], true ) );
            return false;
        }
	}

	public function is_valid_task( $item ): bool {
        if ( ! is_array( $item ) ) {
            return false;
        }

        if ( ! isset( $item[ 'callback' ] ) ) {
            return false;
        }

        if ( ! is_callable( $item[ 'callback' ] ) ) {
            return false;
        }

        return true;
    }

	/**
	 * Complete
	 *
	 * Override if applicable, but ensure that the below actions are
	 * performed, or, call parent::complete().
	 */
	protected function complete() {
		parent::complete();

		if ( is_callable( $this->after_complete_callback ) ) {
			call_user_func( $this->after_complete_callback );
		}
	}

}