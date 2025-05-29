<?php
/**
 * Atomic Part: Content Single
 * Mobile-first, accessible, extensible content markup for single posts
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" aria-label="Post Content">
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<?php authority_blueprint_posted_on(); ?>
		</div>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<footer class="entry-footer">
		<?php authority_blueprint_entry_footer(); ?>
	</footer>
</article> 