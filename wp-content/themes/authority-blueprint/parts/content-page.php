<?php
/**
 * Atomic Part: Content Page
 * Mobile-first, accessible, extensible content markup
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" aria-label="Page Content">
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'authority-blueprint' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>
<?php endwhile; ?> 