<?php
/**
 * Atomic Part: Content 404
 * Mobile-first, accessible, extensible markup for 404 pages
 */
?>
<section class="error-404 not-found" role="region" aria-label="404 Not Found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'authority-blueprint' ); ?></h1>
	</header>
	<div class="page-content">
		<p><?php esc_html_e( 'Sorry, the page you are looking for does not exist. Try searching or return to the homepage.', 'authority-blueprint' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</section> 