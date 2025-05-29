<?php
/**
 * Atomic Part: Header Navigation
 * Mobile-first, accessible, extensible navigation markup
 */
?>
<nav id="site-navigation" class="main-navigation primary-navigation" role="navigation" aria-label="Primary Navigation">
	<button class="menu-toggle" aria-expanded="false" aria-controls="primary-menu">
		<span class="sr-only">Menu</span>
		<span class="hamburger-icon"></span>
	</button>
	<?php
	wp_nav_menu( array(
		'theme_location' => 'primary',
		'menu_id'        => 'primary-menu',
		'container'      => false,
		'menu_class'     => 'menu',
		'fallback_cb'    => false,
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'          => 2,
	) );
	?>
</nav> 