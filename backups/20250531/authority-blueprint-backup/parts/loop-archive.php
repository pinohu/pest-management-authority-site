<?php
/**
 * Loop Archive (Archive Pages)
 * @package Authority_Blueprint
 */
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		get_template_part( 'parts/content', 'summary' );
	endwhile;
	the_posts_navigation();
else :
	get_template_part( 'parts/content', 'none' );
endif;
?> 