<?php

namespace Directorist_Pricing_Plan\Lib\Migrator;

use Directorist_Pricing_Plan\Lib\WP_Background_Processing\Core_Background_Process;

class Background_Updater extends Core_Background_Process {

	protected $action = 'migrator_database_update_background_process';

}