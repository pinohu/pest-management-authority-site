<?php
/**
 * Sidebar Template
 * @package Authority_Blueprint_MCP
 */
?>
<aside id="secondary" class="sidebar widget-area" role="complementary" aria-label="<?php esc_attr_e('Sidebar', 'authority-blueprint-mcp'); ?>">
  <?php if (is_active_sidebar('sidebar-1')) :
    dynamic_sidebar('sidebar-1');
  endif; ?>
</aside> 