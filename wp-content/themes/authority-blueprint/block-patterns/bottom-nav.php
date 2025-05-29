<?php
/**
 * Block Pattern: Bottom Navigation
 * Description: Mobile-first, accessible bottom navigation bar for authority sites.
 */
?>
<!-- wp:group {"className":"bottom-navigation-section"} -->
<div class="wp-block-group bottom-navigation-section" aria-label="Bottom Navigation">
	<nav class="bottom-navigation" role="navigation">
		<a href="/" class="bottom-nav-item active" aria-current="page">
			<span class="icon">🏠</span>
			<span>Home</span>
		</a>
		<a href="/search" class="bottom-nav-item">
			<span class="icon">🔍</span>
			<span>Search</span>
		</a>
		<a href="/favorites" class="bottom-nav-item">
			<span class="icon">⭐</span>
			<span>Favorites</span>
		</a>
		<a href="/profile" class="bottom-nav-item">
			<span class="icon">👤</span>
			<span>Profile</span>
		</a>
	</nav>
</div>
<!-- /wp:group --> 