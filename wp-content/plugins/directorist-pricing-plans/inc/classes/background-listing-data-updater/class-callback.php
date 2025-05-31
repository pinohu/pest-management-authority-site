<?php

namespace Directorist_Pricing_Plan\Background_Listing_Data_Updater;

use WP_Query;
use Directorist_Pricing_Plan\Lib\Logger\Logger;

class Callback {

    public static function update_listings_plan_sorting_meta( $args = [] ) {
        if ( ! is_array( $args ) ) {
            return false;
        }

        if ( empty( $args['total_listings_count'] ) || empty( $args['plan_id'] ) || ! isset( $args['plan_sorting_order'] ) || empty( $args['callback_id'] ) ) {
            return false;
        }

        $total_items         = ( int ) $args['total_listings_count'];
        $per_page            = 50;
        $reminder            = ( $total_items >= $per_page ) ? $total_items % $per_page : 0;
        $total_items_rounded = $total_items - $reminder;
        $total_page          = ( $total_items_rounded >= $per_page ) ? $total_items_rounded / $per_page : 1;
        $total_page          = $reminder ? $total_page + 1 : $total_page;

        $namespace             = DPP_KEY_BG_LISTING_META_UPDATER . '_' . $args['plan_id'];
        $pagination_option_key = "{$namespace}:current_page";
        $current_page          = ( int ) get_option( $pagination_option_key, 1 );

        $listing_query = new WP_Query( [
            'post_type'      => ATBDP_POST_TYPE,
            'post_status'    => 'any',
            'posts_per_page' => $per_page,
            'paged'          => $current_page,
            'meta_query'     => [
                [
                    'key'     => '_fm_plans',
                    'compare' => '=',
                    'value'   => $args['plan_id'],
                ]
            ],
        ] );

        if ( empty( $listing_query->posts ) ) {
            Logger::remove_key_log( $namespace );
            delete_option( $pagination_option_key );
            return false;
        }

        // Update Listings Meta
        foreach( $listing_query->posts as $post ) {
            update_post_meta( $post->ID, DPP_META_KEY_PLAN_SORTING_ORDER, $args['plan_sorting_order'] );
        }

        // Update Logs
        $logs = Logger::get_key_log( $namespace, $args['callback_id'] );

        if ( empty( $logs ) ) {
            $logs = [
                'total_items'     => $total_items,
                'updated_items'   => 0,
                'remaining_items' => $total_items,
            ];
        }

        if ( $current_page === 1 ) {
            $logs['updated_items']   = count( $listing_query->posts );
            $logs['remaining_items'] = $total_items - count( $listing_query->posts );
        } else {
            $updated_items = $logs['updated_items'] + count( $listing_query->posts );
            $logs['updated_items']   = $updated_items;
            $logs['remaining_items'] = $total_items - $updated_items;
        }

        Logger::update_key_log( $namespace, $args['callback_id'], $logs );

        $next_page = $current_page + 1;
        update_option( $pagination_option_key, $next_page );

        if ( $current_page >= $total_page ) {
            Logger::remove_key_log( $namespace );
            delete_option( $pagination_option_key );
            return false;
        }
        
        return true;
    }

}