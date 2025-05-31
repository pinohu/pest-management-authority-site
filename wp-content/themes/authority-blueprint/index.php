<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
			
			<header class="page-header section-header">
				<?php if (is_home() && !is_front_page()) : ?>
					<h1 class="section-title"><?php single_post_title(); ?></h1>
				<?php elseif (is_archive()) : ?>
					<?php the_archive_title('<h1 class="section-title">', '</h1>'); ?>
					<?php the_archive_description('<div class="section-description">', '</div>'); ?>
				<?php elseif (is_search()) : ?>
					<h1 class="section-title">
						<?php
						printf(
							/* translators: %s: search query. */
							esc_html__('Search Results for: %s', 'authority-blueprint'),
							'<span>' . get_search_query() . '</span>'
						);
						?>
					</h1>
				<?php else : ?>
					<h1 class="section-title"><?php esc_html_e('Latest Posts', 'authority-blueprint'); ?></h1>
					<p class="section-description"><?php esc_html_e('Stay updated with the latest in pest management science', 'authority-blueprint'); ?></p>
				<?php endif; ?>
			</header><!-- .page-header -->

			<div class="posts-grid grid md:grid-cols-2 lg:grid-cols-3">
				<?php
				/* Start the Loop */
				while (have_posts()) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
						
						<?php if (has_post_thumbnail()) : ?>
							<div class="card-image">
								<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
									<?php the_post_thumbnail('medium', array('class' => 'card-thumbnail')); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="card-content">
							<header class="entry-header">
								<?php
								if (is_singular()) :
									the_title('<h1 class="card-title entry-title">', '</h1>');
								else :
									the_title('<h2 class="card-title entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
								endif;
								?>

								<?php if ('post' === get_post_type()) : ?>
									<div class="entry-meta">
										<time class="published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
											<?php echo esc_html(get_the_date()); ?>
										</time>
										<span class="byline">
											<?php esc_html_e('by', 'authority-blueprint'); ?>
											<span class="author vcard">
												<a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
													<?php echo esc_html(get_the_author()); ?>
												</a>
											</span>
										</span>
									</div><!-- .entry-meta -->
								<?php endif; ?>
							</header><!-- .entry-header -->

							<div class="entry-summary card-description">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->

							<footer class="entry-footer">
								<a href="<?php the_permalink(); ?>" class="card-action">
									<?php esc_html_e('Read More', 'authority-blueprint'); ?>
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="m9 18 6-6-6-6"/>
									</svg>
								</a>
							</footer><!-- .entry-footer -->
						</div><!-- .card-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
					<?php
				endwhile;
				?>
			</div><!-- .posts-grid -->

			<?php
			// Pagination
			the_posts_navigation(array(
				'prev_text' => __('&larr; Older posts', 'authority-blueprint'),
				'next_text' => __('Newer posts &rarr;', 'authority-blueprint'),
			));
			?>

		<?php else : ?>

			<section class="no-results not-found">
				<header class="page-header section-header">
					<h1 class="section-title"><?php esc_html_e('Nothing here', 'authority-blueprint'); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<?php if (is_home() && current_user_can('publish_posts')) : ?>
						<p>
							<?php
							printf(
								wp_kses(
									/* translators: 1: link to WP admin new post page. */
									__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'authority-blueprint'),
									array(
										'a' => array(
											'href' => array(),
										),
									)
								),
								esc_url(admin_url('post-new.php'))
							);
							?>
						</p>
					<?php elseif (is_search()) : ?>
						<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'authority-blueprint'); ?></p>
						<?php get_search_form(); ?>
					<?php else : ?>
						<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'authority-blueprint'); ?></p>
						<?php get_search_form(); ?>
					<?php endif; ?>
				</div><!-- .page-content -->
			</section><!-- .no-results -->

		<?php endif; ?>

	</div><!-- .container -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?> 