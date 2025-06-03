<?php
/**
 * Lovable Hero Section (WordPress PHP version)
 * @package Authority_Blueprint_MCP
 */
$title = get_theme_mod('hero_title', 'Default Title');
$subtitle = get_theme_mod('hero_subtitle', 'Default Subtitle');
$cta_text = get_theme_mod('hero_cta_text', 'Learn More');
$bg_type = get_theme_mod('hero_background_type', 'image');
?>
<section class="lovable-hero<?php echo $bg_type ? ' lovable-hero--' . esc_attr($bg_type) : ''; ?>">
  <div class="lovable-hero__content">
    <h1 class="lovable-hero__title"><?php echo esc_html($title); ?></h1>
    <p class="lovable-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
    <?php if ($cta_text) : ?>
      <a href="#" class="lovable-hero__cta btn btn-primary"><?php echo esc_html($cta_text); ?></a>
    <?php endif; ?>
  </div>
</section> 