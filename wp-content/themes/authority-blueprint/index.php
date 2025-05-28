<?php
/**
 * The main template file for Authority Blueprint
 *
 * Implements mobile-first, accessible, SEO-optimized structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main id="main" class="site-main" tabindex="-1">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
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
</main>
<?php wp_footer(); ?>
</body>
</html> 