<?php
/**
 * Content Single Partial
 * @package Authority_Blueprint_MCP
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
  <header class="entry-header">
    <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
  </header>
  <div class="entry-content" itemprop="articleBody">
    <?php the_content(); ?>
  </div>
  <footer class="entry-footer">
    <?php edit_post_link(__('Edit', 'authority-blueprint-mcp'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</article> 