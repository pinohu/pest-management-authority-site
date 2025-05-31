<?php
/**
 * Block Pattern: Mobile Navigation
 * Description: Mobile-first, accessible navigation bar for authority sites.
 */
?>
<!-- wp:group {"className":"mobile-nav-section"} -->
<div class="wp-block-group mobile-nav-section" aria-label="Primary Navigation">
	<!-- wp:buttons {"className":"mobile-nav-buttons"} -->
	<div class="wp-block-buttons mobile-nav-buttons">
		<!-- wp:button {"className":"menu-toggle","aria-expanded":"false","aria-controls":"primary-menu"} -->
		<div class="wp-block-button menu-toggle"><button aria-expanded="false" aria-controls="primary-menu"><span class="sr-only">Menu</span><span class="hamburger-icon"></span></button></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
	<!-- wp:navigation {"overlayMenu":true,"className":"primary-navigation","id":"primary-menu"} /-->
</div>
<!-- /wp:group --> 