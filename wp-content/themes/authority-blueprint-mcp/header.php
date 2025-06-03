<?php
/**
 * Theme Header
 * @package Authority_Blueprint_MCP
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e('Skip to main content', 'authority-blueprint-mcp'); ?></a>
<header id="site-header" class="site-header" role="banner">
  <div class="site-branding">
    <?php if (has_custom_logo()) {
      the_custom_logo();
    } else { ?>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title"><?php bloginfo('name'); ?></a>
    <?php } ?>
    <p class="site-description"><?php bloginfo('description'); ?></p>
  </div>
  <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'authority-blueprint-mcp'); ?>">
    <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'menu_class'     => 'primary-menu',
        'container'      => false,
        'fallback_cb'    => false
      ]);
    ?>
  </nav>
</header>
<main id="main-content" class="site-main" tabindex="-1"> 