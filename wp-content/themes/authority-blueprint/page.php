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
	<?php include locate_template('breadcrumb.php'); ?>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer class="entry-footer">
				<?php edit_post_link( __( 'Edit', 'authority-blueprint' ), '<span class="edit-link">', '</span>' ); ?>
			</footer>
		</article>
	<?php endwhile; ?>
	<?php include locate_template('sidebar.php'); ?>
</main>
<?php get_footer(); ?> 