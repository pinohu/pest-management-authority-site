<?php
/**
 * Front Page Template
 * @package Authority_Blueprint_MCP
 */
get_header();
?>
<section class="hero-section" role="region" aria-label="<?php esc_attr_e('Hero', 'authority-blueprint-mcp'); ?>">
  <div class="hero-content">
    <h1><?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>
    <a class="button" href="<?php echo esc_url(home_url('/directory/')); ?>"><?php esc_html_e('Browse Directory', 'authority-blueprint-mcp'); ?></a>
  </div>
</section>
<section class="directory-showcase" role="region" aria-label="<?php esc_attr_e('Directory Showcase', 'authority-blueprint-mcp'); ?>">
  <h2><?php esc_html_e('Find Service Providers, Organizations, and Suppliers', 'authority-blueprint-mcp'); ?></h2>
  <p><?php esc_html_e('Connect with professionals, organizations, and suppliers in your field. This directory is fully customizable for any niche.', 'authority-blueprint-mcp'); ?></p>
  <div class="directory-quick-links">
    <a href="<?php echo esc_url(home_url('/directory/')); ?>" class="btn btn-primary"><?php esc_html_e('Browse Directory', 'authority-blueprint-mcp'); ?></a>
    <a href="<?php echo esc_url(home_url('/add-listing/')); ?>" class="btn btn-secondary"><?php esc_html_e('Add Your Listing', 'authority-blueprint-mcp'); ?></a>
  </div>
  <?php
    // Placeholder for MCP-powered directory content (e.g., featured listings, stats)
    do_action('ab_mcp_front_page_directory');
  ?>
</section>
<section class="faq-section" role="region" aria-label="<?php esc_attr_e('FAQ', 'authority-blueprint-mcp'); ?>">
  <h2><?php esc_html_e('Frequently Asked Questions', 'authority-blueprint-mcp'); ?></h2>
  <?php
    // Placeholder for MCP-powered FAQ content
    do_action('ab_mcp_front_page_faq');
  ?>
</section>
<?php get_footer(); ?>
<?php get_template_part('parts/content-faq-accordion'); ?>
// All front page content is now niche-agnostic. Customize as needed for your use case. 