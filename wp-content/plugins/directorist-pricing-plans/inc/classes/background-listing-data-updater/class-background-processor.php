<?php

namespace Directorist_Pricing_Plan\Background_Listing_Data_Updater;

use Directorist_Pricing_Plan\Lib\WP_Background_Processing\Core_Background_Process;

class Background_Processor extends Core_Background_Process {

	protected $action = 'listing_data_update_background_process';

	public function add_callback( $callback ) {
		$this->push_to_queue( $callback );
	}

	public function run() {
		$this->save()->dispatch();
	}

}