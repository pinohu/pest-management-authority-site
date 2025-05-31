<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Authority_Blueprint
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		
		<?php while (have_posts()) : the_post(); ?>
			
			<article id="page-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>
				
				<!-- Page Header -->
				<header class="page-header">
					<?php if (has_post_thumbnail()) : ?>
						<div class="page-featured-image">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>
					
					<div class="page-header-content">
						<?php the_title('<h1 class="page-title">', '</h1>'); ?>
						
						<?php if (has_excerpt()) : ?>
							<div class="page-excerpt">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
						
						<!-- Breadcrumbs -->
						<?php authority_blueprint_breadcrumbs(); ?>
					</div>
				</header><!-- .page-header -->

				<!-- Page Content -->
				<div class="page-content">
					<?php
					the_content();

					wp_link_pages(array(
						'before' => '<div class="page-links">' . esc_html__('Pages:', 'authority-blueprint'),
						'after'  => '</div>',
					));
					?>
				</div><!-- .page-content -->

				<!-- Page Footer -->
				<footer class="page-footer">
					<?php
					// Show edit link for logged in users
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current page. Only visible to screen readers */
								__('Edit <span class="sr-only">%s</span>', 'authority-blueprint'),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post(get_the_title())
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .page-footer -->

			</article><!-- #page-<?php the_ID(); ?> -->

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;
			?>

		<?php endwhile; // End of the loop. ?>

	</div><!-- .container -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?> 