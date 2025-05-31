<?php

class Global_Migration {

    public const MIGRATION_VERSION = 'global';

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct() {
        add_filter( ATPP_PREFIIX . '_db_update_callbacks', [ $this, 'add_migration_callbacks' ] );
    }

    /**
     * Add Migration Callbacks
     * 
     * @param array $callbacks
     * @return array Callbacks
     */
    public function add_migration_callbacks( $callbacks = [] ) {
        $callbacks[ self::MIGRATION_VERSION ] = [
            [
                'callback' => [ Global_Migration::class, 'add_plan_sort_order_meta_to_listings' ],
            ],
        ];

		return  $callbacks;
    }

    /**
     * Add Plan Sort Order Meta To Listings
     * 
     * @return bool Continue or Stop The Migration
     */
    public static function add_plan_sort_order_meta_to_listings() {
        $prefix       = 'dpp_migration_' . self::MIGRATION_VERSION . 'add_plan_sort_order_meta_to_listings_';
        $current_page = get_option( "{$prefix}current_page", 1 );

        $listings_query_args = [
            'post_type'      => ATBDP_POST_TYPE,
            'paged'          => $current_page,
            'posts_per_page' => apply_filters( 'dpp_listings_migration_per_page', 50 ),
        ];

        $listings_query = new WP_Query( $listings_query_args );

        if ( empty( $listings_query->posts ) ) {
            delete_option( "{$prefix}current_page" );
            return false;
        }

        foreach( $listings_query->posts as $post ) {
            $plan_id            = get_post_meta( $post->ID, '_fm_plans', true );
            $plan_sorting_order = 0;

            if ( ! empty( $plan_id ) ) {
                $plan_sorting_order = directorist_get_plan_sorting_order( $plan_id );
            }

            update_post_meta( $post->ID, DPP_META_KEY_PLAN_SORTING_ORDER, $plan_sorting_order );
        }

        $next_page = $current_page + 1;
        update_option( "{$prefix}current_page", $next_page );

        return true;
    }

}

new Global_Migration();