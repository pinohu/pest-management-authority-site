<?php

namespace Directorist_Pricing_Plan\Background_Listing_Data_Updater;

class Init {

    public function __construct() {
        add_action( 'init', [ $this, 'setup_background_processor' ] );
        $this->includes();
    }

    public function setup_background_processor() {
        $GLOBALS[ DPP_KEY_BG_LISTING_META_UPDATER ] = new Background_Processor();
    }

    public function includes() {
        include_once dirname( __FILE__ ) . '/class-background-processor.php';
        include_once dirname( __FILE__ ) . '/class-callback.php';
    }

}

new Init();