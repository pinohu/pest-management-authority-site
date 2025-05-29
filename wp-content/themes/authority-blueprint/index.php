<?php
/**
 * The main template file for Authority Blueprint
 *
 * Implements mobile-first, accessible, SEO-optimized structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */
get_header();
?>
<main id="main" class="site-main" tabindex="-1">
	<?php get_template_part( 'parts/loop', 'main' ); ?>
</main>
<?php get_footer(); ?> 