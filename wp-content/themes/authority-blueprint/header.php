<?php
/**
 * The header for Authority Blueprint
 *
 * Implements mobile-first, accessible, SEO-optimized structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header id="masthead" class="site-header" role="banner">
	<div class="site-branding">
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-logo"><?php the_custom_logo(); ?></div>
		<?php endif; ?>
		<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php if ( get_bloginfo( 'description' ) ) : ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php endif; ?>
	</div>
	<button class="menu-toggle" aria-expanded="false" aria-controls="primary-menu">
		<span class="sr-only">Menu</span>
		<span class="hamburger-icon" aria-hidden="true"></span>
	</button>
	<nav id="primary-menu" class="primary-navigation" role="navigation" aria-label="Primary Menu" hidden>
		<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu-list',
				'container'      => false,
				'menu_class'     => 'menu',
				'fallback_cb'    => false,
			) );
		?>
	</nav>
</header> 