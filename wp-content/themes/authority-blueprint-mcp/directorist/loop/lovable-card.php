<?php
/**
 * Lovable Directory Card for Directorist
 * @package Authority_Blueprint_MCP
 * @var $listing WP_Post (Directorist listing object)
 */
if (!isset($listing) || !is_object($listing)) return;
$title = get_the_title($listing->ID);
$categories = get_the_terms($listing->ID, ATBDP_CATEGORY);
$rating = get_post_meta($listing->ID, '_average_rating', true);
$price = get_post_meta($listing->ID, '_price', true);
$location = get_post_meta($listing->ID, '_address', true);
?>
<div class="lovable-directory-card">
  <div class="lovable-directory-card__image-skeleton"></div>
  <div class="lovable-directory-card__content">
    <h3 class="lovable-directory-card__title"><?php echo esc_html($title); ?></h3>
    <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
      <div class="lovable-directory-card__category">
        <?php echo esc_html($categories[0]->name); ?>
      </div>
    <?php endif; ?>
    <?php if ($rating) : ?>
      <div class="lovable-directory-card__rating">★ <?php echo esc_html($rating); ?></div>
    <?php endif; ?>
    <?php if ($price) : ?>
      <div class="lovable-directory-card__price"><?php echo esc_html($price); ?></div>
    <?php endif; ?>
    <?php if ($location) : ?>
      <div class="lovable-directory-card__location"><?php echo esc_html($location); ?></div>
    <?php endif; ?>
  </div>
</div>
<!-- Loading Skeleton -->
<div class="lovable-directory-card lovable-directory-card--skeleton">
  <div class="lovable-directory-card__image-skeleton"></div>
  <div class="lovable-directory-card__content">
    <div class="lovable-directory-card__title-skeleton"></div>
    <div class="lovable-directory-card__meta-skeleton"></div>
    <div class="lovable-directory-card__meta-skeleton"></div>
  </div>
</div> 