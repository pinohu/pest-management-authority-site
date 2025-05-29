<?php
/**
 * The sidebar containing the main widget area
 * Mobile-first, accessible, extensible markup
 * @package Authority_Blueprint
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside id="secondary" class="sidebar widget-area" role="complementary" aria-label="Sidebar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside> 