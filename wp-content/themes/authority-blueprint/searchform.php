<?php
/**
 * Template for displaying search forms
 *
 * @package Authority_Blueprint
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label for="search-field" class="sr-only">
		<?php echo _x('Search for:', 'label', 'authority-blueprint'); ?>
	</label>
	<div class="search-input-wrapper">
		<input type="search" id="search-field" class="search-field" placeholder="<?php echo esc_attr_x('Search pest management topics...', 'placeholder', 'authority-blueprint'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-submit">
			<span class="sr-only"><?php echo _x('Search', 'submit button', 'authority-blueprint'); ?></span>
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<circle cx="11" cy="11" r="8"/>
				<path d="m21 21-4.35-4.35"/>
			</svg>
		</button>
	</div>
</form> 