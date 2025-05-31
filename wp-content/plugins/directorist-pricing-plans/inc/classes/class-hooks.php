<?php

class ATPP_Hooks {

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct() {
        $this->listing_sorting_hooks();

        // Add Listings Plan Sorting Meta
        add_action( 'save_post', [ $this, 'add_listings_plan_sorting_meta_if_missing' ], 10, 2 );
        add_action( 'edit_post', [ $this, 'add_listings_plan_sorting_meta_if_missing' ], 10, 2 );
    }

    public function listing_sorting_hooks() {
        // if ( ! directorist_pp_is_version_migrated( '2.3.0' ) ) {
        //     return;
        // }

        add_filter( 'directorist_all_listings_query_arguments', [ $this, 'sort_listings_based_on_featured_and_pricing_plan' ] );
        add_filter( 'atbdp_listing_search_query_argument', [ $this, 'sort_listings_based_on_featured_and_pricing_plan' ] );
    }

    /**
     * Sort Listings Based On Featured And Pricing Plan
     * 
     * @param array $query
     * @return array $query
     */
    public function sort_listings_based_on_featured_and_pricing_plan( $query = [] ) {
        unset( $query['meta_key'] );

        if ( empty( $query['meta_query'] ) ) {
            $query['meta_query'] = [];
        }

        $query['meta_query']['_plan_order'] = [
            "key"     => DPP_META_KEY_PLAN_SORTING_ORDER,
            "type"    => "NUMERIC",
            "compare" => "EXISTS"
        ];
 
        if ( empty( $query['orderby'] ) ) {
            $query['orderby'] = [];
        }

        if ( is_array( $query['orderby'] ) ) {
            $prev_orderby = $query['orderby'];
            unset( $prev_orderby['meta_value_num'] );

            $new_orderby = [
                "_featured"   => "DESC",
                "_plan_order" => "DESC",
            ];

            $query['orderby'] = array_merge( $new_orderby, $prev_orderby );
        } else {
            $orderby = ! empty( $query['orderby'] ) ? explode( ' ',  $query['orderby'] ) : [];
            $orderby = array_filter( $orderby, function( $item ) { return $item !== 'meta_value_num'; } );
            $orderby = array_merge( [ '_featured', '_plan_order' ], $orderby );
            
            $query['orderby'] = implode( ' ', $orderby );
        }

        return $query;
    }

    public function add_listings_plan_sorting_meta_if_missing( int $post_id, WP_Post $post ) {
        if ( ATBDP_POST_TYPE !== $post->post_type ) {
            return;
        }

        $plan_sorting_order = get_post_meta( $post_id, DPP_META_KEY_PLAN_SORTING_ORDER, true );

        if ( is_numeric( $plan_sorting_order ) ) {
            return;
        }

        $plan_id            = get_post_meta( $post_id, '_fm_plans', true );
        $plan_sorting_order = empty( $plan_id ) ? 0 : get_post_meta( $plan_id, DPP_META_KEY_PLAN_SORTING_ORDER, true );

        update_post_meta( $post_id, DPP_META_KEY_PLAN_SORTING_ORDER, $plan_sorting_order );
    }

}