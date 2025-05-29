<?php
/**
 * The footer for Authority Blueprint
 *
 * Implements mobile-first, accessible, SEO-optimized structure per best practices and blueprints.
 *
 * @package Authority_Blueprint
 */

do_action('authority_blueprint_before_footer');
?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_template_part( 'parts/footer', 'site-info' ); ?>
		<?php get_template_part( 'parts/footer', 'navigation' ); ?>
		<?php
		// Output bottom navigation block pattern
		if ( function_exists( 'register_block_pattern' ) ) {
			echo do_blocks( '<!-- wp:pattern {"slug":"authority-blueprint/bottom-nav"} /-->' );
		}
		// Output accessibility announcement block pattern
		if ( function_exists( 'register_block_pattern' ) ) {
			echo do_blocks( '<!-- wp:pattern {"slug":"authority-blueprint/accessibility-announcement"} /-->' );
		}
		?>
	</footer>
<?php
do_action('authority_blueprint_after_footer');
?>
<?php wp_footer(); ?>
</body>
</html> 