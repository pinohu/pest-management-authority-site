<?php
authority_blueprint_before_footer();
/**
 * Footer Site Info (Copyright, Accessibility)
 * @package Authority_Blueprint
 */
?>
<div class="site-info">
	&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'authority-blueprint' ); ?>
	<span class="accessibility-link"><a href="/accessibility/">Accessibility Statement</a></span>
</div>
<?php
authority_blueprint_after_footer();
?> 