<?php
/**
 * Template Name: Topic Hub Page
 * Description: Central navigation point for main topic areas, per authority blueprint.
 * @package Authority_Blueprint
 */
get_header();
?>
<main id="main" class="site-main" tabindex="-1">
	<?php if (function_exists('bcn_display')) : ?>
		<nav class="breadcrumb" aria-label="Breadcrumb">
			<?php bcn_display(); ?>
		</nav>
	<?php endif; ?>

	<section class="topic-intro" aria-label="Topic Introduction">
		<h1><?php the_title(); ?></h1>
		<?php if (has_post_thumbnail()) : ?>
			<div class="topic-image"><?php the_post_thumbnail('large'); ?></div>
		<?php endif; ?>
		<div class="topic-description"><?php the_excerpt(); ?></div>
	</section>

	<nav class="quick-nav" aria-label="Quick Navigation">
		<ul>
			<li><a href="#subtopics">Subtopics</a></li>
			<li><a href="#featured-content">Featured</a></li>
			<li><a href="#latest-content">Latest</a></li>
			<li><a href="#expert-insights">Expert Insights</a></li>
			<li><a href="#related-topics">Related Topics</a></li>
		</ul>
	</nav>

	<section id="subtopics" class="subtopic-cards" aria-label="Subtopics">
		<h2>Subtopics</h2>
		<div class="card-grid">
			<?php
			// Example: show child pages as subtopics
			$children = get_pages(array('child_of' => get_the_ID(), 'sort_column' => 'menu_order'));
			foreach ($children as $child) : ?>
				<div class="subtopic-card">
					<a href="<?php echo get_permalink($child->ID); ?>">
						<h3><?php echo esc_html($child->post_title); ?></h3>
						<p><?php echo esc_html(wp_trim_words($child->post_excerpt, 20)); ?></p>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section id="featured-content" class="featured-content" aria-label="Featured Content">
		<h2>Featured Content</h2>
		<div class="featured-items">
			<?php
			$featured = new WP_Query(array('posts_per_page' => 2, 'meta_key' => 'is_featured', 'meta_value' => '1', 'cat' => get_query_var('cat')));
			if ($featured->have_posts()) :
				while ($featured->have_posts()) : $featured->the_post(); ?>
					<article class="featured-item">
						<a href="<?php the_permalink(); ?>">
							<?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
							<h3><?php the_title(); ?></h3>
							<p><?php echo get_the_excerpt(); ?></p>
						</a>
					</article>
				<?php endwhile; wp_reset_postdata(); endif; ?>
		</div>
	</section>

	<section id="latest-content" class="latest-content" aria-label="Latest Content">
		<h2>Latest in This Topic</h2>
		<ul>
			<?php
			$latest = new WP_Query(array('posts_per_page' => 5, 'cat' => get_query_var('cat')));
			if ($latest->have_posts()) :
				while ($latest->have_posts()) : $latest->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="date"><?php echo get_the_date(); ?></span></li>
				<?php endwhile; wp_reset_postdata(); endif; ?>
		</ul>
	</section>

	<section id="expert-insights" class="expert-insights" aria-label="Expert Insights">
		<h2>Expert Insights</h2>
		<?php if (function_exists('get_coauthors')) : $authors = get_coauthors();
			foreach ($authors as $author) : ?>
				<div class="expert">
					<strong><?php echo esc_html($author->display_name); ?></strong>
					<?php if (!empty($author->description)) : ?><p><?php echo esc_html($author->description); ?></p><?php endif; ?>
				</div>
			<?php endforeach; endif; ?>
	</section>

	<section id="related-topics" class="related-topics" aria-label="Related Topics">
		<h2>Related Topics</h2>
		<ul>
			<?php
			$related = get_categories(array('exclude' => get_query_var('cat'), 'number' => 3));
			foreach ($related as $cat) : ?>
				<li><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo esc_html($cat->name); ?></a></li>
			<?php endforeach; ?>
		</ul>
	</section>

	<section class="topic-cta" aria-label="Call to Action">
		<h2>Ready to Dive Deeper?</h2>
		<a href="/contact" class="button primary-cta">Contact Our Experts</a>
	</section>
</main>
<?php get_footer(); ?> 