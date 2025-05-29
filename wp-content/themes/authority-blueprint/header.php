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
	<?php get_template_part( 'parts/header', 'site-branding' ); ?>
	<?php get_template_part( 'parts/header', 'navigation' ); ?>
</header>
<div id="page" class="site">
	<?php get_template_part( 'parts/header', 'site-branding' ); ?>
	<?php get_template_part( 'parts/header', 'navigation' ); ?>
</div> 