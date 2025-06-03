<?php
/**
 * 404 Template
 * @package Authority_Blueprint_MCP
 */
get_header();
?>
<section class="error-404 not-found" role="main">
  <header class="page-header">
    <h1 class="page-title"><?php esc_html_e('Page Not Found', 'authority-blueprint-mcp'); ?></h1>
  </header>
  <div class="page-content">
    <p><?php esc_html_e('Sorry, the page you are looking for does not exist.', 'authority-blueprint-mcp'); ?></p>
    <a class="button" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return to homepage', 'authority-blueprint-mcp'); ?></a>
  </div>
</section>
<?php get_footer(); ?> 