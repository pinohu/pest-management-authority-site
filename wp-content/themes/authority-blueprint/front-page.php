<?php
/**
 * The front page template for Authority Blueprint
 *
 * Implements robust, modular home page structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */
get_header();
?>
<main id="main" class="site-main" tabindex="-1">
	<!-- Hero Section -->
	<section class="hero-section" aria-label="Primary Value Proposition">
		<h1><?php bloginfo('name'); ?></h1>
		<p><?php bloginfo('description'); ?></p>
		<a href="#category-navigation" class="button primary-cta">Get Started</a>
	</section>

	<!-- Category Navigation -->
	<section id="category-navigation" class="category-navigation" aria-label="Main Content Sections">
		<h2>Main Topics</h2>
		<div class="category-cards">
			<?php
				$categories = get_categories(array('hide_empty' => 0, 'number' => 6));
				foreach ($categories as $cat) : ?>
					<div class="category-card">
						<a href="<?php echo get_category_link($cat->term_id); ?>">
							<h3><?php echo esc_html($cat->name); ?></h3>
							<p><?php echo esc_html($cat->description); ?></p>
						</a>
					</div>
				<?php endforeach; ?>
		</div>
	</section>

	<!-- Featured Content -->
	<section class="featured-content" aria-label="Featured Resources">
		<h2>Featured Content</h2>
		<div class="featured-items">
			<?php
				$featured = new WP_Query(array('posts_per_page' => 3, 'meta_key' => 'is_featured', 'meta_value' => '1'));
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

	<!-- Audience Pathways -->
	<section class="audience-pathways" aria-label="Audience Pathways">
		<h2>For You</h2>
		<div class="audience-cards">
			<div class="audience-card"><h3>Beginners</h3><p>Start your journey with our beginner guides.</p></div>
			<div class="audience-card"><h3>Professionals</h3><p>Deep dives and advanced resources for experts.</p></div>
			<div class="audience-card"><h3>Businesses</h3><p>Solutions and case studies for organizations.</p></div>
		</div>
	</section>

	<!-- Social Proof -->
	<section class="social-proof" aria-label="Testimonials and Trust">
		<h2>What Our Readers Say</h2>
		<div class="testimonials">
			<blockquote>"This site helped me become an expert in my field."<cite>Jane Doe</cite></blockquote>
			<blockquote>"The resources and guides are top-notch and easy to follow."<cite>John Smith</cite></blockquote>
		</div>
	</section>

	<!-- Latest Updates -->
	<section class="latest-updates" aria-label="Latest Updates">
		<h2>Latest Updates</h2>
		<ul>
			<?php
				$latest = new WP_Query(array('posts_per_page' => 5));
				if ($latest->have_posts()) :
					while ($latest->have_posts()) : $latest->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span class="date"><?php echo get_the_date(); ?></span></li>
					<?php endwhile; wp_reset_postdata(); endif; ?>
		</ul>
	</section>

	<!-- Newsletter Signup -->
	<section class="newsletter-signup" aria-label="Newsletter Signup">
		<h2>Stay Updated</h2>
		<p>Subscribe to our newsletter for the latest authority content and resources.</p>
		<form class="mobile-first-form" method="post" action="#">
			<div class="form-group">
				<label for="newsletter-email">Email Address</label>
				<input type="email" id="newsletter-email" name="newsletter-email" required>
			</div>
			<button type="submit" class="submit-button">Subscribe</button>
		</form>
	</section>
</main>
<?php get_footer(); ?> 