<?php
/**
 * Search Form Template
 * @package Authority_Blueprint_MCP
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <label for="search-field" class="screen-reader-text"><?php esc_html_e('Search for:', 'authority-blueprint-mcp'); ?></label>
  <input type="search" id="search-field" class="search-field" placeholder="<?php esc_attr_e('Search …', 'authority-blueprint-mcp'); ?>" value="<?php echo get_search_query(); ?>" name="s" aria-label="<?php esc_attr_e('Search', 'authority-blueprint-mcp'); ?>" />
  <button type="submit" class="search-submit" aria-label="<?php esc_attr_e('Submit search', 'authority-blueprint-mcp'); ?>">
    <?php esc_html_e('Search', 'authority-blueprint-mcp'); ?>
  </button>
</form> 