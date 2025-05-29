<?php
/**
 * Atomic Part: Content Summary
 * Mobile-first, accessible, extensible markup for post summaries
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('summary'); ?> role="article" aria-label="Post Summary">
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="entry-meta">
			<?php authority_blueprint_posted_on(); ?>
		</div>
	</header>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article> 