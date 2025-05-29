<?php
/**
 * The template for displaying all pages
 *
 * Implements mobile-first, accessible, SEO-optimized structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */
get_header();
?>
<main id="main" class="site-main" tabindex="-1">
	<?php get_template_part( 'parts/content', 'page' ); ?>
</main>
<?php get_footer(); ?> 