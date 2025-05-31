<?php
/**
 * Landing Page Header
 *
 * Minimal header for landing pages without navigation distractions.
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

<body <?php body_class('landing-page-body'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'authority-blueprint'); ?></a>

	<header id="masthead" class="site-header landing-header">
		<div class="container">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if (is_front_page() && is_home()) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php
				endif;
				$authority_blueprint_description = get_bloginfo('description', 'display');
				if ($authority_blueprint_description || is_customize_preview()) :
					?>
					<p class="site-description"><?php echo $authority_blueprint_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<!-- Minimal Landing Navigation -->
			<nav class="landing-nav" aria-label="<?php esc_attr_e('Landing navigation', 'authority-blueprint'); ?>">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="home-link">
					<?php esc_html_e('Home', 'authority-blueprint'); ?>
				</a>
				<a href="<?php echo esc_url(home_url('/contact')); ?>" class="contact-link">
					<?php esc_html_e('Contact', 'authority-blueprint'); ?>
				</a>
			</nav>

		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

<style>
/* Landing Page Header Styles */
.landing-header {
	background: var(--color-white);
	box-shadow: var(--shadow-sm);
	padding: var(--space-4) 0;
	position: sticky;
	top: 0;
	z-index: 999;
}

.landing-header .container {
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.landing-header .site-branding {
	display: flex;
	align-items: center;
	gap: var(--space-4);
}

.landing-header .site-title {
	font-size: var(--font-size-lg);
	font-weight: 700;
	margin: 0;
}

.landing-header .site-title a {
	color: var(--color-text-primary);
	text-decoration: none;
}

.landing-header .site-description {
	display: none;
}

.landing-nav {
	display: flex;
	gap: var(--space-6);
}

.landing-nav a {
	color: var(--color-text-primary);
	text-decoration: none;
	font-weight: 500;
	padding: var(--space-2) var(--space-4);
	border-radius: var(--radius-md);
	transition: all var(--transition-fast);
}

.landing-nav a:hover {
	background: var(--color-primary);
	color: var(--color-white);
}

@media (max-width: 768px) {
	.landing-header .container {
		flex-direction: column;
		gap: var(--space-4);
	}
	
	.landing-nav {
		gap: var(--space-4);
	}
}
</style>

	</div><!-- #content -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html> 