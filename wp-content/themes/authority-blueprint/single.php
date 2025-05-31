<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Authority_Blueprint
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		
		<?php while (have_posts()) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
				
				<header class="entry-header">
					<?php if (has_post_thumbnail()) : ?>
						<div class="featured-image">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>
					
					<div class="entry-meta">
						<span class="posted-on">
							<time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
								<?php echo get_the_date(); ?>
							</time>
						</span>
						
						<span class="byline">
							<?php esc_html_e('by', 'authority-blueprint'); ?>
							<span class="author vcard">
								<a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
									<?php echo get_the_author(); ?>
								</a>
							</span>
						</span>
						
						<?php if (has_category()) : ?>
							<span class="cat-links">
								<?php esc_html_e('in', 'authority-blueprint'); ?>
								<?php the_category(', '); ?>
							</span>
						<?php endif; ?>
					</div>
					
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
					
					<?php if (has_excerpt()) : ?>
						<div class="entry-excerpt">
							<?php the_excerpt(); ?>
						</div>
					<?php endif; ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php
					the_content(sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__('Continue reading<span class="sr-only"> "%s"</span>', 'authority-blueprint'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post(get_the_title())
					));

					wp_link_pages(array(
						'before' => '<div class="page-links">' . esc_html__('Pages:', 'authority-blueprint'),
						'after'  => '</div>',
					));
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php if (has_tag()) : ?>
						<div class="tag-links">
							<span class="tags-label"><?php esc_html_e('Tags:', 'authority-blueprint'); ?></span>
							<?php the_tags('', ', '); ?>
						</div>
					<?php endif; ?>
					
					<div class="post-navigation">
						<?php
						the_post_navigation(array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'authority-blueprint') . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'authority-blueprint') . '</span> <span class="nav-title">%title</span>',
						));
						?>
					</div>
				</footer><!-- .entry-footer -->

			</article><!-- #post-<?php the_ID(); ?> -->

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