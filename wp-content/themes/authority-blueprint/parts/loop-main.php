<?php
/**
 * Atomic Part: Loop Main
 * Mobile-first, accessible, extensible markup for main post loop
 */
?>
<section class="loop-main card-grid" role="region" aria-label="Post List">
	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'parts/content', get_post_type() === 'page' ? 'page' : 'summary' );
		endwhile;
		if ( function_exists( 'the_posts_navigation' ) ) {
			the_posts_navigation();
		}
	else :
		get_template_part( 'parts/content', 'none' );
	endif; ?>
</section>
?> 