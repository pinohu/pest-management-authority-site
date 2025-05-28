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
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				</header>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>
			</article>
		<?php endwhile; ?>
		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<section class="no-results not-found">
			<header class="page-header">
				<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'authority-blueprint' ); ?></h2>
			</header>
			<div class="page-content">
				<p><?php esc_html_e( 'It seems we can't find what you're looking for.', 'authority-blueprint' ); ?></p>
			</div>
		</section>
	<?php endif; ?>
	<?php include locate_template('sidebar.php'); ?>
</main>
<?php
get_footer(); 