<?php
/**
 * Atomic Part: Footer Navigation
 * Mobile-first, accessible, extensible navigation markup
 */
?>
<nav class="footer-navigation" role="navigation" aria-label="Footer Navigation">
	<?php
	wp_nav_menu( array(
		'theme_location' => 'footer',
		'menu_id'        => 'footer-menu',
		'container'      => false,
		'menu_class'     => 'menu',
		'fallback_cb'    => false,
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'          => 1,
	) );
	?>
</nav>
<nav class="bottom-navigation" aria-label="Mobile Bottom Navigation">
	<a href="/" class="bottom-nav-item active"><span class="icon" aria-hidden="true"></span><span>Home</span></a>
	<a href="/search" class="bottom-nav-item"><span class="icon" aria-hidden="true"></span><span>Search</span></a>
	<a href="/favorites" class="bottom-nav-item"><span class="icon" aria-hidden="true"></span><span>Favorites</span></a>
	<a href="/profile" class="bottom-nav-item"><span class="icon" aria-hidden="true"></span><span>Profile</span></a>
</nav> 