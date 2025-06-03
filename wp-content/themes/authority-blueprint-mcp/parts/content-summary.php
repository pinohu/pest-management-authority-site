<?php
/**
 * Content Summary Partial
 * @package Authority_Blueprint_MCP
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('summary'); ?> itemscope itemtype="http://schema.org/Article">
  <header class="entry-header">
    <h2 class="entry-title" itemprop="headline">
      <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h2>
  </header>
  <div class="entry-summary" itemprop="description">
    <?php the_excerpt(); ?>
  </div>
</article> 