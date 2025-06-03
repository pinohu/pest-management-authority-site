<?php
/**
 * Lovable Hero Section
 * @package Authority_Blueprint_MCP
 */
$bg_type = get_theme_mod('lovable_hero_bg_type', 'gradient');
$content_align = get_theme_mod('lovable_hero_content_align', 'center');
$cta_text = get_theme_mod('lovable_hero_cta_text', __('Get Started', 'authority-blueprint-mcp'));
?>
<section class="lovable-hero lovable-hero--<?php echo esc_attr($bg_type); ?> align-<?php echo esc_attr($content_align); ?>">
  <div class="lovable-hero__content">
    <h1><?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="lovable-hero__cta btn btn-primary"><?php echo esc_html($cta_text); ?></a>
  </div>
</section> 