<?php
/**
 * Main Index Template
 * @package Authority_Blueprint_MCP
 */
get_header();
?>
<div class="content-area">
  <div class="site-main">
    <?php if (have_posts()) :
      while (have_posts()) : the_post();
        get_template_part('parts/content', get_post_type());
      endwhile;
      the_posts_navigation();
    else :
      get_template_part('parts/content', 'none');
    endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?> 