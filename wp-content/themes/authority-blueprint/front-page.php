<?php
/**
 * The front page template file
 *
 * This is the template that displays the front page of the site.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Authority_Blueprint
 */

get_header();
?>

<main id="primary" class="site-main">
	
	<!-- Hero Section -->
	<section class="hero-section">
		<div class="container">
			<div class="hero-content">
				<h1 class="hero-title">
					<?php esc_html_e('Advancing Pest Management Science', 'authority-blueprint'); ?>
				</h1>
				<p class="hero-description">
					<?php esc_html_e('Leading research, innovation, and education in sustainable pest management solutions for agriculture, urban environments, and public health.', 'authority-blueprint'); ?>
				</p>
				<div class="hero-actions">
					<a href="#research" class="btn-primary">
						<?php esc_html_e('Explore Research', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
					<a href="#directory" class="btn-secondary">
						<?php esc_html_e('Find Professionals', 'authority-blueprint'); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Research Areas Section -->
	<section id="research" class="section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php esc_html_e('Research Areas', 'authority-blueprint'); ?></h2>
				<p class="section-description">
					<?php esc_html_e('Comprehensive research across all aspects of pest management science', 'authority-blueprint'); ?>
				</p>
			</div>
			
			<div class="grid md:grid-cols-2 lg:grid-cols-3">
				<div class="card">
					<div class="card-icon">🌱</div>
					<h3 class="card-title"><?php esc_html_e('Integrated Pest Management', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Sustainable approaches combining biological, cultural, physical, and chemical tools for effective pest control.', 'authority-blueprint'); ?>
					</p>
					<a href="#" class="card-action">
						<?php esc_html_e('Learn More', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>

				<div class="card">
					<div class="card-icon">🦗</div>
					<h3 class="card-title"><?php esc_html_e('Biological Control', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Natural enemies and biological agents for environmentally friendly pest management solutions.', 'authority-blueprint'); ?>
					</p>
					<a href="#" class="card-action">
						<?php esc_html_e('Learn More', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>

				<div class="card">
					<div class="card-icon">🛡️</div>
					<h3 class="card-title"><?php esc_html_e('Pesticide Safety', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Research on safe application, resistance management, and environmental impact assessment.', 'authority-blueprint'); ?>
					</p>
					<a href="#" class="card-action">
						<?php esc_html_e('Learn More', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>

				<div class="card">
					<div class="card-icon">🌾</div>
					<h3 class="card-title"><?php esc_html_e('Sustainable Agriculture', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Crop protection strategies that support long-term agricultural sustainability and food security.', 'authority-blueprint'); ?>
					</p>
					<a href="#" class="card-action">
						<?php esc_html_e('Learn More', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>

				<div class="card">
					<div class="card-icon">🏙️</div>
					<h3 class="card-title"><?php esc_html_e('Urban Pest Management', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Specialized approaches for pest control in urban environments and public health protection.', 'authority-blueprint'); ?>
					</p>
					<a href="#" class="card-action">
						<?php esc_html_e('Learn More', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>

				<div class="card">
					<div class="card-icon">📊</div>
					<h3 class="card-title"><?php esc_html_e('Data & Analytics', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Advanced modeling, monitoring technologies, and data-driven decision making tools.', 'authority-blueprint'); ?>
					</p>
					<a href="#" class="card-action">
						<?php esc_html_e('Learn More', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Professional Directory Section -->
	<section id="directory" class="section section-bg-light">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php esc_html_e('Professional Directory', 'authority-blueprint'); ?></h2>
				<p class="section-description">
					<?php esc_html_e('Connect with certified pest management professionals, researchers, and service providers', 'authority-blueprint'); ?>
				</p>
			</div>
			
			<div class="grid md:grid-cols-3">
				<div class="card">
					<div class="card-icon">🏢</div>
					<h3 class="card-title"><?php esc_html_e('Pest Control Services', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Licensed professionals providing comprehensive pest management services for residential and commercial properties.', 'authority-blueprint'); ?>
					</p>
					<a href="/directory/pest-control-services" class="card-action">
						<?php esc_html_e('Browse Services', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>

				<div class="card">
					<div class="card-icon">🔬</div>
					<h3 class="card-title"><?php esc_html_e('Research Institutions', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Universities, laboratories, and research centers advancing pest management science and innovation.', 'authority-blueprint'); ?>
					</p>
					<a href="/directory/research-institutions" class="card-action">
						<?php esc_html_e('Explore Research', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>

				<div class="card">
					<div class="card-icon">📦</div>
					<h3 class="card-title"><?php esc_html_e('Product Suppliers', 'authority-blueprint'); ?></h3>
					<p class="card-description">
						<?php esc_html_e('Manufacturers and distributors of pest management products, equipment, and innovative solutions.', 'authority-blueprint'); ?>
					</p>
					<a href="/directory/product-suppliers" class="card-action">
						<?php esc_html_e('Find Suppliers', 'authority-blueprint'); ?>
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="m9 18 6-6-6-6"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Latest Research Section -->
	<section class="section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php esc_html_e('Latest Research', 'authority-blueprint'); ?></h2>
				<p class="section-description">
					<?php esc_html_e('Recent publications and breakthrough discoveries in pest management science', 'authority-blueprint'); ?>
				</p>
			</div>
			
			<?php
			// Query for latest posts
			$latest_posts = new WP_Query(array(
				'posts_per_page' => 3,
				'post_status' => 'publish'
			));
			
			if ($latest_posts->have_posts()) : ?>
				<div class="grid md:grid-cols-3">
					<?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
						<article class="card">
							<?php if (has_post_thumbnail()) : ?>
								<div class="card-image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium'); ?>
									</a>
								</div>
							<?php endif; ?>
							
							<div class="card-content">
								<h3 class="card-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<p class="card-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
								<a href="<?php the_permalink(); ?>" class="card-action">
									<?php esc_html_e('Read More', 'authority-blueprint'); ?>
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="m9 18 6-6-6-6"/>
									</svg>
								</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
			<?php 
			wp_reset_postdata();
			endif; ?>
		</div>
	</section>

	<!-- Call to Action Section -->
	<section class="section section-bg-light">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php esc_html_e('Join Our Community', 'authority-blueprint'); ?></h2>
				<p class="section-description">
					<?php esc_html_e('Connect with professionals, access exclusive resources, and stay updated on the latest developments', 'authority-blueprint'); ?>
				</p>
				<div class="hero-actions">
					<a href="#" class="btn-primary">
						<?php esc_html_e('Join Network', 'authority-blueprint'); ?>
					</a>
					<a href="#" class="btn-secondary">
						<?php esc_html_e('Subscribe Newsletter', 'authority-blueprint'); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
?> 