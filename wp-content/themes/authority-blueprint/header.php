<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Authority_Blueprint
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link sr-only" href="#primary"><?php esc_html_e('Skip to content', 'authority-blueprint'); ?></a>

<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="container">
			<div class="header-container">
				
				<div class="site-branding">
					<div class="site-logo">
						<?php if (has_custom_logo()) : ?>
							<?php the_custom_logo(); ?>
						<?php else : ?>
							<span aria-hidden="true">🦗</span>
						<?php endif; ?>
					</div>
					
					<div class="site-identity">
						<?php if (is_front_page() && is_home()) : ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
									<?php bloginfo('name'); ?>
								</a>
							</h1>
						<?php else : ?>
							<p class="site-title">
								<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
									<?php bloginfo('name'); ?>
								</a>
							</p>
						<?php endif; ?>
						
						<?php
						$description = get_bloginfo('description', 'display');
						if ($description || is_customize_preview()) :
						?>
							<p class="site-tagline"><?php echo $description; ?></p>
						<?php endif; ?>
					</div>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Primary menu', 'authority-blueprint'); ?>">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'fallback_cb'    => false,
					));
					?>
				</nav><!-- #site-navigation -->

				<div class="header-actions">
					<button class="search-toggle" aria-expanded="false" aria-controls="search-form">
						<span class="sr-only"><?php esc_html_e('Search', 'authority-blueprint'); ?></span>
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="11" cy="11" r="8"/>
							<path d="m21 21-4.35-4.35"/>
						</svg>
					</button>
					
					<a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="cta-button">
						<?php esc_html_e('Get Started', 'authority-blueprint'); ?>
					</a>
					
					<button class="mobile-menu-button" aria-expanded="false" aria-controls="primary-menu">
						<span class="sr-only"><?php esc_html_e('Menu', 'authority-blueprint'); ?></span>
						<span></span>
						<span></span>
						<span></span>
					</button>
				</div><!-- .header-actions -->

			</div><!-- .header-container -->
		</div><!-- .container -->

		<!-- Mobile Search Form -->
		<div id="search-form" class="search-form-container" hidden>
			<div class="container">
				<?php get_search_form(); ?>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content"> 