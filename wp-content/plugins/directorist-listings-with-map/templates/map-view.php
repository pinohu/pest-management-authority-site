<?php
bdmv_init_template_data();
global $bdmv_listings;
$current_listing_type   = $bdmv_listings->data['listings']->current_listing_type;
do_action( 'before_directorist_template_loaded', 'archive/map-view' );
do_action( 'before_directorist_template_loaded', 'archive-contents' );
do_action( 'before_directorist_template_loaded', 'archive/search-form' );

$types = count( \directory_types() );
$enable_multi_directory = \directorist_multi_directory() && ( 1 < $types ) ? true : false;
?>

<?php if ($bdmv_listings->column_is(3)) { ?>
<div id="directorist" class="directorist-wrapper directorist-contents-wrap"
    data-view-columns="<?php $bdmv_listings->get_the_attr('listings_with_map_columns'); ?>">

    <?php if (!empty($enable_multi_directory)) { ?>
    <div class="directorist-type-nav directorist-type-nav--listings-map">
        <ul class="directorist-type-nav__list">
            <?php if ($bdmv_listings->data['listings']->listing_types) { ?>
            <?php foreach ($bdmv_listings->data['listings']->listing_types as $id => $value) : ?>
            <li
                class="<?php echo ($bdmv_listings->data['listings']->current_listing_type == $value['term']->term_id) ? 'current' : ''; ?> bdmv-directorist-type">
                <a class="directorist-type-nav__link" data-id="<?php echo $value['term']->term_id; ?>"><span
                        class="<?php echo esc_html($value['data']['icon']); ?>"></span>
                    <?php echo esc_html($value['name']); ?></a>
            </li>
            <?php endforeach; ?>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>

    <div class="directorist-map-wrapper directorist-map-columns-three">
        <?php if ($bdmv_listings->has_search_section()) { ?>
        <div class="directorist-map-search">
            <div class="directorist-map-search-content">
                <?php bdmv_get_template('all-listings/columns-three/search'); ?>
            </div>
        </div>
        <?php } ?>
        <div class="directorist-map-listing">
            <?php bdmv_get_template('all-listings/columns-three/map-listing'); ?>
        </div>
        <div class="directorist-ajax-search-result"></div>
        <!--responsive buttons-->
        <div class="directorist-res-btns">
            <a href="" class="directorist-res-btn" id="js-dlm-search"><?php directorist_icon( 'las la-search' ); ?></a>
            <a href="" class="directorist-res-btn active" id="js-dlm-listings"><?php directorist_icon( 'las la-list-ul' ); ?></a>
            <a href="" class="directorist-res-btn" id="js-dlm-map"><?php directorist_icon( 'las la-map' ); ?></a>
        </div>
    </div>
</div>
<?php } elseif ($bdmv_listings->column_is(2)) { ?>
<div id="directorist" class="directorist-wrapper directorist-contents-wrap"
    data-view-columns="<?php $bdmv_listings->get_the_attr('listings_with_map_columns'); ?>">
    <?php if (!empty($enable_multi_directory)) { ?>
    <div class="directorist-type-nav directorist-type-nav--listings-map">
        <ul class="directorist-type-nav__list">
            <?php if ($bdmv_listings->data['listings']->listing_types) { ?>
            <?php foreach ($bdmv_listings->data['listings']->listing_types as $id => $value) : ?>
            <li
                class="<?php echo ($bdmv_listings->data['listings']->current_listing_type == $value['term']->term_id) ? 'current' : ''; ?> bdmv-directorist-type">
                <a class="directorist-type-nav__link" data-id="<?php echo $value['term']->term_id; ?>"><span
                        class="<?php echo esc_html($value['data']['icon']); ?>"></span>
                    <?php echo esc_html($value['name']); ?></a>
            </li>
            <?php endforeach; ?>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
    <div class="directorist-map-wrapper directorist-map-columns-two">
        <div class="directorist-map-search">
            <?php if ($bdmv_listings->has_search_section()) { ?>
            <div class="directorist-map-search-content">
                <?php bdmv_get_template('all-listings/columns-two/search'); ?>
            </div>
            <?php } ?>
        </div>
        <div class="directorist-map-listing">
            <?php bdmv_get_template('all-listings/columns-three/map-listing'); ?>
        </div>
        <div class="directorist-ajax-search-result"></div>
        <!--responsive buttons-->
        <div class="directorist-res-btns">
            <a href="" class="directorist-res-btn" id="js-dlm-search"><?php directorist_icon( 'las la-search' ); ?></a>
            <a href="" class="directorist-res-btn active" id="js-dlm-listings"><?php directorist_icon( 'las la-list-ul' ); ?></a>
            <a href="" class="directorist-res-btn" id="js-dlm-map"><?php directorist_icon( 'las la-map' ); ?></a>
        </div>
    </div>
</div>
<?php } elseif ($bdmv_listings->column_is('2-style-2')) { ?>
<div id="directorist" class="directorist-wrapper directorist-contents-wrap"
    data-view-columns="<?php $bdmv_listings->get_the_attr('listings_with_map_columns'); ?>">
    <div class="directorist-map-listing">
        <?php bdmv_get_template('all-listings/columns-two-(style-two)/map-listing'); ?>
    </div>
    <div class="directorist-ajax-search-result"></div>
    <!--responsive buttons-->
    <div class="directorist-res-btns">
        <a href="" class="directorist-res-btn" id="js-dlm-search"><?php directorist_icon( 'las la-search' ); ?></a>
        <a href="" class="directorist-res-btn active" id="js-dlm-listings"><?php directorist_icon( 'las la-list-ul' ); ?></a>
        <a href="" class="directorist-res-btn" id="js-dlm-map"><?php directorist_icon( 'las la-map' ); ?></a>
    </div>
</div>
<?php } elseif ($bdmv_listings->column_is(1)) { ?>
<div id="directorist" class="directorist-wrapper directorist-contents-wrap"
    data-view-columns="<?php $bdmv_listings->get_the_attr('listings_with_map_columns'); ?>">
    <div class="directorist-map-listing">
        <?php bdmv_get_template('all-listings/columns-one/map-listing'); ?>
    </div>
    <div class="directorist-ajax-search-result"></div>
    <!--responsive buttons-->
    <div class="directorist-res-btns">
        <a href="" class="directorist-res-btn" id="js-dlm-search"><?php directorist_icon( 'las la-search' ); ?></a>
        <a href="" class="directorist-res-btn active" id="js-dlm-listings"><?php directorist_icon( 'las la-list-ul' ); ?></a>
        <a href="" class="directorist-res-btn" id="js-dlm-map"><?php directorist_icon( 'las la-map' ); ?></a>
    </div>
</div>
<?php } ?>
<style>
.directorist-map-wrapper,
.directorist-map-columns-three .directorist-map-listing .directorist-listing,
.directorist-map-columns-three .directorist-map-listing .directorist-map,
.directorist-map-columns-three .directorist-ajax-search-result .directorist-listing,
.bdmv-columns-two .directorist-map-listing, .directorist-map-columns-three .directorist-map-search {
    height: <?php $bdmv_listings->get_the_map_height();
    ?>;
}
</style>


<input type="hidden" id="display_header" value="<?php $bdmv_listings->get_the_data('display_header'); ?>">
<input type="hidden" id="header_title" value="<?php $bdmv_listings->get_the_data('header_title'); ?>">
<input type="hidden" id="show_pagination" value="<?php $bdmv_listings->get_the_data('show_pagination'); ?>">
<input type="hidden" id="listings_per_page" value="<?php $bdmv_listings->get_the_data('listings_per_page'); ?>">
<input type="hidden" id="location_slug" value="<?php $bdmv_listings->get_the_data('location_slug'); ?>">
<input type="hidden" id="category_slug" value="<?php $bdmv_listings->get_the_data('category_slug'); ?>">
<input type="hidden" id="tag_slug" value="<?php $bdmv_listings->get_the_data('tag_slug'); ?>">
<input type="hidden" id="directory_type" value="<?php echo $bdmv_listings->data['listings']->current_listing_type; ?>">
<input type="hidden" id="map_zoom_level" value="<?php echo $bdmv_listings->get_data('map_zoom_level'); ?>">
<input type="hidden" id="map_height" value="<?php echo $bdmv_listings->get_data('map_height'); ?>">
<input type="hidden" id="listings_with_map_columns" value="<?php $bdmv_listings->get_the_data('listings_with_map_columns'); ?>">

<?php bdmv_reset_template_data(); ?>