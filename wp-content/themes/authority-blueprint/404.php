<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Implements mobile-first, accessible, SEO-optimized structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */
get_header();
?>
<main id="main" class="site-main" tabindex="-1">
	<?php include locate_template('breadcrumb.php'); ?>
	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'authority-blueprint' ); ?></h1>
		</header>
		<div class="page-content">
			<p><?php esc_html_e( 'Sorry, the page you are looking for does not exist. You can return to the home page or try searching.', 'authority-blueprint' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button">Home</a>
		</div>
	</section>
	<?php include locate_template('sidebar.php'); ?>
</main>
<?php get_footer(); ?> 