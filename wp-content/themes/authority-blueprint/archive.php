<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Authority_Blueprint
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		
		<?php if (have_posts()) : ?>
			
			<header class="page-header">
				<?php
				the_archive_title('<h1 class="page-title">', '</h1>');
				the_archive_description('<div class="archive-description">', '</div>');
				?>
			</header><!-- .page-header -->

			<div class="posts-grid">
				<?php
				/* Start the Loop */
				while (have_posts()) :
					the_post();
				?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
						
						<?php if (has_post_thumbnail()) : ?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium'); ?>
								</a>
							</div>
						<?php endif; ?>
						
						<div class="post-content">
							<header class="entry-header">
								<div class="entry-meta">
									<span class="posted-on">
										<time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
											<?php echo get_the_date(); ?>
										</time>
									</span>
									
									<?php if (has_category()) : ?>
										<span class="cat-links">
											<?php the_category(', '); ?>
										</span>
									<?php endif; ?>
								</div>
								
								<?php
								if (is_singular()) :
									the_title('<h1 class="entry-title">', '</h1>');
								else :
									the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
								endif;
								?>
							</header><!-- .entry-header -->

							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
							
							<footer class="entry-footer">
								<a href="<?php the_permalink(); ?>" class="read-more">
									<?php esc_html_e('Read More', 'authority-blueprint'); ?>
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="m9 18 6-6-6-6"/>
									</svg>
								</a>
							</footer><!-- .entry-footer -->
						</div><!-- .post-content -->
						
					</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; ?>
			</div><!-- .posts-grid -->

			<?php
			the_posts_navigation(array(
				'prev_text' => esc_html__('Older posts', 'authority-blueprint'),
				'next_text' => esc_html__('Newer posts', 'authority-blueprint'),
			));

		else :
		?>
			
			<section class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e('Nothing here', 'authority-blueprint'); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'authority-blueprint'); ?></p>
					
					<?php get_search_form(); ?>
					
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'authority-blueprint'); ?></h2>
						<ul>
							<?php
							wp_list_categories(array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							));
							?>
						</ul>
					</div><!-- .widget -->
				</div><!-- .page-content -->
			</section><!-- .no-results -->

		<?php endif; ?>

	</div><!-- .container -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?> 