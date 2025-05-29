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
		<h1>Pest Management Science</h1>
		<p>The leading resource for integrated pest management, biological control, pesticide safety, and sustainable agriculture.</p>
		<a href="#category-navigation" class="button primary-cta">Explore Pest Solutions</a>
	</section>

	<!-- Category Navigation -->
	<section id="category-navigation" class="category-navigation" aria-label="Main Content Sections">
		<h2>Key Topics</h2>
		<div class="category-cards">
			<div class="category-card">
				<a href="#integrated-pest-management"><h3>Integrated Pest Management</h3><p>Strategies for sustainable, science-based pest control.</p></a>
			</div>
			<div class="category-card">
				<a href="#biological-control"><h3>Biological Control</h3><p>Harnessing natural enemies for pest suppression.</p></a>
			</div>
			<div class="category-card">
				<a href="#pesticide-safety"><h3>Pesticide Safety</h3><p>Best practices for safe and effective pesticide use.</p></a>
			</div>
			<div class="category-card">
				<a href="#insect-identification"><h3>Insect Identification</h3><p>Field guides and diagnostics for common pests.</p></a>
			</div>
			<div class="category-card">
				<a href="#crop-protection"><h3>Crop Protection</h3><p>Defending crops from pests, weeds, and diseases.</p></a>
			</div>
			<div class="category-card">
				<a href="#resistance-management"><h3>Resistance Management</h3><p>Preventing and managing pesticide resistance.</p></a>
			</div>
		</div>
	</section>

	<!-- Featured Content -->
	<section class="featured-content" aria-label="Featured Resources">
		<h2>Featured Research & Guides</h2>
		<div class="featured-items">
			<article class="featured-item">
				<a href="#ipm-guide"><h3>Comprehensive Guide to Integrated Pest Management</h3><p>Step-by-step IPM strategies for professionals and growers.</p></a>
			</article>
			<article class="featured-item">
				<a href="#biocontrol-overview"><h3>Biological Control: Natural Solutions</h3><p>How to use beneficial insects and microbes for pest control.</p></a>
			</article>
			<article class="featured-item">
				<a href="#pesticide-safety-checklist"><h3>Pesticide Safety Checklist</h3><p>Essential safety protocols for applicators and researchers.</p></a>
			</article>
		</div>
	</section>

	<!-- Audience Pathways -->
	<section class="audience-pathways" aria-label="Audience Pathways">
		<h2>For Every Stakeholder</h2>
		<div class="audience-cards">
			<div class="audience-card"><h3>Growers & Farmers</h3><p>Practical pest management for sustainable yields.</p></div>
			<div class="audience-card"><h3>Researchers</h3><p>Latest science, data, and peer-reviewed studies.</p></div>
			<div class="audience-card"><h3>Extension Agents</h3><p>Outreach tools and training for community impact.</p></div>
			<div class="audience-card"><h3>Students</h3><p>Learning resources and career pathways in pest science.</p></div>
		</div>
	</section>

	<!-- Social Proof -->
	<section class="social-proof" aria-label="Testimonials and Trust">
		<h2>Trusted by the Pest Science Community</h2>
		<div class="testimonials">
			<blockquote>"The most comprehensive pest management resource online."<cite>Dr. A. Entomo, University of Agriculture</cite></blockquote>
			<blockquote>"Essential reading for anyone in crop protection."<cite>Jane Grower, Certified Crop Advisor</cite></blockquote>
		</div>
	</section>

	<!-- Latest Updates -->
	<section class="latest-updates" aria-label="Latest Updates">
		<h2>Latest Research & News</h2>
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
		<h2>Stay Informed</h2>
		<p>Subscribe for the latest in pest management science, research, and field updates.</p>
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