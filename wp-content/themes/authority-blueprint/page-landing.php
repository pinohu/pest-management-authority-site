<?php
/**
 * Template Name: Landing Page
 * 
 * A special template for landing pages, campaign pages, or lead generation pages.
 * This template removes navigation and footer distractions for better conversion.
 *
 * @package Authority_Blueprint
 */

get_header('landing');
?>

<main id="primary" class="site-main landing-page">
	<div class="container">
		
		<?php while (have_posts()) : the_post(); ?>
			
			<article id="page-<?php the_ID(); ?>" <?php post_class('landing-content'); ?>>
				
				<!-- Hero Section -->
				<header class="landing-hero">
					<?php if (has_post_thumbnail()) : ?>
						<div class="landing-hero-image">
							<?php the_post_thumbnail('hero-large', array('loading' => 'eager')); ?>
						</div>
					<?php endif; ?>
					
					<div class="landing-hero-content">
						<h1 class="landing-title"><?php the_title(); ?></h1>
						
						<?php 
						$subtitle = get_post_meta(get_the_ID(), '_landing_subtitle', true);
						if ($subtitle) : ?>
							<p class="landing-subtitle"><?php echo esc_html($subtitle); ?></p>
						<?php endif; ?>
					</div>
				</header>

				<!-- Content Area -->
				<div class="landing-main-content">
					<?php
					the_content();

					wp_link_pages(array(
						'before' => '<div class="page-links">' . esc_html__('Pages:', 'authority-blueprint'),
						'after'  => '</div>',
					));
					?>
				</div>

				<!-- Call to Action Section -->
				<?php 
				$cta_title = get_post_meta(get_the_ID(), '_cta_title', true);
				$cta_description = get_post_meta(get_the_ID(), '_cta_description', true);
				$cta_button_text = get_post_meta(get_the_ID(), '_cta_button_text', true);
				$cta_button_url = get_post_meta(get_the_ID(), '_cta_button_url', true);
				
				if ($cta_title || $cta_description) : ?>
					<section class="landing-cta">
						<div class="cta-content">
							<?php if ($cta_title) : ?>
								<h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
							<?php endif; ?>
							
							<?php if ($cta_description) : ?>
								<p class="cta-description"><?php echo esc_html($cta_description); ?></p>
							<?php endif; ?>
							
							<?php if ($cta_button_text && $cta_button_url) : ?>
								<div class="cta-actions">
									<a href="<?php echo esc_url($cta_button_url); ?>" class="btn btn-primary btn-large">
										<?php echo esc_html($cta_button_text); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</section>
				<?php endif; ?>

				<!-- Features/Benefits Section -->
				<?php 
				$features = get_post_meta(get_the_ID(), '_landing_features', true);
				if ($features && is_array($features)) : ?>
					<section class="landing-features">
						<div class="features-grid">
							<?php foreach ($features as $feature) : ?>
								<div class="feature-item">
									<?php if (!empty($feature['icon'])) : ?>
										<div class="feature-icon">
											<?php echo wp_kses_post($feature['icon']); ?>
										</div>
									<?php endif; ?>
									
									<?php if (!empty($feature['title'])) : ?>
										<h3 class="feature-title"><?php echo esc_html($feature['title']); ?></h3>
									<?php endif; ?>
									
									<?php if (!empty($feature['description'])) : ?>
										<p class="feature-description"><?php echo esc_html($feature['description']); ?></p>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<!-- Testimonials Section -->
				<?php 
				$testimonials = get_post_meta(get_the_ID(), '_landing_testimonials', true);
				if ($testimonials && is_array($testimonials)) : ?>
					<section class="landing-testimonials">
						<h2 class="testimonials-title"><?php esc_html_e('What Our Clients Say', 'authority-blueprint'); ?></h2>
						
						<div class="testimonials-grid">
							<?php foreach ($testimonials as $testimonial) : ?>
								<div class="testimonial-item">
									<blockquote class="testimonial-quote">
										<?php echo esc_html($testimonial['quote']); ?>
									</blockquote>
									
									<div class="testimonial-author">
										<?php if (!empty($testimonial['photo'])) : ?>
											<img src="<?php echo esc_url($testimonial['photo']); ?>" alt="<?php echo esc_attr($testimonial['name']); ?>" class="author-photo">
										<?php endif; ?>
										
										<div class="author-info">
											<cite class="author-name"><?php echo esc_html($testimonial['name']); ?></cite>
											<?php if (!empty($testimonial['title'])) : ?>
												<span class="author-title"><?php echo esc_html($testimonial['title']); ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>

				<!-- Footer CTA -->
				<section class="landing-footer-cta">
					<div class="footer-cta-content">
						<h2><?php esc_html_e('Ready to Get Started?', 'authority-blueprint'); ?></h2>
						<p><?php esc_html_e('Join thousands of professionals advancing pest management science.', 'authority-blueprint'); ?></p>
						
						<?php if ($cta_button_text && $cta_button_url) : ?>
							<a href="<?php echo esc_url($cta_button_url); ?>" class="btn btn-primary btn-large">
								<?php echo esc_html($cta_button_text); ?>
							</a>
						<?php endif; ?>
					</div>
				</section>

			</article><!-- #page-<?php the_ID(); ?> -->
			
		<?php endwhile; // End of the loop. ?>

	</div><!-- .container -->
</main><!-- #main -->

<style>
/* Landing Page Specific Styles */
.landing-page {
	padding-top: 0;
}

.landing-hero {
	text-align: center;
	padding: var(--space-16) 0;
	background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
	color: var(--color-white);
	margin-bottom: var(--space-16);
}

.landing-hero-image {
	margin-bottom: var(--space-8);
}

.landing-title {
	font-size: var(--font-size-4xl);
	font-weight: 800;
	margin-bottom: var(--space-6);
	line-height: 1.1;
}

.landing-subtitle {
	font-size: var(--font-size-xl);
	opacity: 0.9;
	max-width: 600px;
	margin: 0 auto;
	line-height: 1.5;
}

.landing-main-content {
	max-width: 800px;
	margin: 0 auto var(--space-16);
	font-size: var(--font-size-lg);
	line-height: 1.7;
}

.landing-cta {
	background: var(--color-gray-50);
	padding: var(--space-16);
	text-align: center;
	border-radius: var(--radius-xl);
	margin-bottom: var(--space-16);
}

.cta-title {
	font-size: var(--font-size-3xl);
	font-weight: 700;
	margin-bottom: var(--space-6);
	color: var(--color-text-primary);
}

.cta-description {
	font-size: var(--font-size-lg);
	color: var(--color-text-secondary);
	margin-bottom: var(--space-8);
	max-width: 600px;
	margin-left: auto;
	margin-right: auto;
}

.landing-features {
	margin-bottom: var(--space-16);
}

.features-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	gap: var(--space-8);
}

.feature-item {
	text-align: center;
	padding: var(--space-8);
	background: var(--color-white);
	border-radius: var(--radius-lg);
	box-shadow: var(--shadow-sm);
}

.feature-icon {
	font-size: 3rem;
	margin-bottom: var(--space-6);
	color: var(--color-primary);
}

.feature-title {
	font-size: var(--font-size-xl);
	font-weight: 600;
	margin-bottom: var(--space-4);
	color: var(--color-text-primary);
}

.feature-description {
	color: var(--color-text-secondary);
	line-height: 1.6;
}

.landing-testimonials {
	margin-bottom: var(--space-16);
}

.testimonials-title {
	text-align: center;
	font-size: var(--font-size-3xl);
	font-weight: 700;
	margin-bottom: var(--space-12);
	color: var(--color-text-primary);
}

.testimonials-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
	gap: var(--space-8);
}

.testimonial-item {
	background: var(--color-white);
	padding: var(--space-8);
	border-radius: var(--radius-lg);
	box-shadow: var(--shadow-sm);
}

.testimonial-quote {
	font-size: var(--font-size-lg);
	font-style: italic;
	margin-bottom: var(--space-6);
	line-height: 1.6;
	color: var(--color-text-secondary);
}

.testimonial-author {
	display: flex;
	align-items: center;
	gap: var(--space-4);
}

.author-photo {
	width: 60px;
	height: 60px;
	border-radius: var(--radius-full);
	object-fit: cover;
}

.author-name {
	font-weight: 600;
	color: var(--color-text-primary);
	display: block;
}

.author-title {
	font-size: var(--font-size-sm);
	color: var(--color-text-tertiary);
}

.landing-footer-cta {
	background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
	color: var(--color-white);
	padding: var(--space-16);
	text-align: center;
	border-radius: var(--radius-xl);
	margin-bottom: var(--space-16);
}

.footer-cta-content h2 {
	font-size: var(--font-size-3xl);
	font-weight: 700;
	margin-bottom: var(--space-6);
}

.footer-cta-content p {
	font-size: var(--font-size-lg);
	opacity: 0.9;
	margin-bottom: var(--space-8);
}

@media (max-width: 768px) {
	.landing-title {
		font-size: var(--font-size-3xl);
	}
	
	.landing-subtitle {
		font-size: var(--font-size-lg);
	}
	
	.features-grid,
	.testimonials-grid {
		grid-template-columns: 1fr;
	}
	
	.testimonial-author {
		flex-direction: column;
		text-align: center;
	}
}
</style>

<?php
get_footer('landing');
?> 