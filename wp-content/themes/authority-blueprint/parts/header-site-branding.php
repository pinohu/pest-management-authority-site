<?php
authority_blueprint_before_header();
/**
 * Site Branding (Logo, Title, Description)
 * @package Authority_Blueprint
 */
?>
<div class="site-branding">
	<?php if ( has_custom_logo() ) : ?>
		<div class="site-logo"><?php the_custom_logo(); ?></div>
	<?php endif; ?>
	<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	<?php if ( get_bloginfo( 'description' ) ) : ?>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
	<?php endif; ?>
</div>
<?php
authority_blueprint_after_header();
?> 