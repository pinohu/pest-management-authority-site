<?php
/**
 * The template for displaying archive pages
 *
 * Implements mobile-first, accessible, SEO-optimized structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */
get_header();
?>
<main id="main" class="site-main" tabindex="-1">
	<?php include locate_template('breadcrumb.php'); ?>
	<header class="page-header">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
	</header>
	<?php get_template_part( 'parts/loop', 'archive' ); ?>
	<?php include locate_template('sidebar.php'); ?>
</main>
<?php
get_footer(); 