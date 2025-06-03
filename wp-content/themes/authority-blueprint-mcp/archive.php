<?php
/**
 * Archive Template
 * @package Authority_Blueprint_MCP
 */
get_header();
?>
<div class="content-area">
  <header class="page-header">
    <h1 class="page-title"><?php the_archive_title(); ?></h1>
    <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
  </header>
  <div class="site-main">
    <?php if (have_posts()) :
      while (have_posts()) : the_post();
        get_template_part('parts/content', 'summary');
      endwhile;
      the_posts_navigation();
    else :
      get_template_part('parts/content', 'none');
    endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?> 