<?php
/**
 * The footer for Authority Blueprint
 *
 * Implements mobile-first, accessible, SEO-optimized structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<nav id="footer-navigation" class="footer-navigation" role="navigation" aria-label="Footer Menu">
		<!-- Footer menu will be implemented here following best practices -->
		<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'menu_id'        => 'footer-menu',
				'container'      => false,
				'fallback_cb'    => false,
			) );
		?>
	</nav>
	<!-- Mobile bottom navigation -->
	<nav class="bottom-navigation" aria-label="Mobile Bottom Navigation">
		<a href="/" class="bottom-nav-item active">
			<span class="icon" aria-hidden="true"></span>
			<span>Home</span>
		</a>
		<a href="/search" class="bottom-nav-item">
			<span class="icon" aria-hidden="true"></span>
			<span>Search</span>
		</a>
		<a href="/favorites" class="bottom-nav-item">
			<span class="icon" aria-hidden="true"></span>
			<span>Favorites</span>
		</a>
		<a href="/profile" class="bottom-nav-item">
			<span class="icon" aria-hidden="true"></span>
			<span>Profile</span>
		</a>
	</nav>
	<div class="site-info">
		&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'authority-blueprint' ); ?>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html> 