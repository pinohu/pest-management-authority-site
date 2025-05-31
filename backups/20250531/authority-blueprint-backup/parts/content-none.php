<?php
/**
 * Atomic Part: Content None
 * Mobile-first, accessible, extensible markup for no content found
 */
?>
<section class="no-results not-found" role="region" aria-label="No Results">
	<header class="page-header">
		<h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'authority-blueprint' ); ?></h2>
	</header>
	<div class="page-content">
		<p><?php esc_html_e( 'Sorry, no content matched your criteria. Try searching for something else.', 'authority-blueprint' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</section> 