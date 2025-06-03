<?php
/**
 * Theme Footer
 * @package Authority_Blueprint_MCP
 */
?>
</main>
<footer id="site-footer" class="site-footer" role="contentinfo">
  <nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer Menu', 'authority-blueprint-mcp'); ?>">
    <?php
      wp_nav_menu([
        'theme_location' => 'footer',
        'menu_class'     => 'footer-menu',
        'container'      => false,
        'fallback_cb'    => false
      ]);
    ?>
  </nav>
  <div class="site-info">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'authority-blueprint-mcp'); ?></p>
    <a href="<?php echo esc_url(home_url('/legal/accessibility-statement')); ?>"><?php esc_html_e('Accessibility Statement', 'authority-blueprint-mcp'); ?></a>
    |
    <a href="<?php echo esc_url(home_url('/legal/privacy-policy')); ?>"><?php esc_html_e('Privacy Policy', 'authority-blueprint-mcp'); ?></a>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html> 