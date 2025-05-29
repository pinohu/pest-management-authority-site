<?php
/**
 * Block Pattern: Content Hub Section
 * Description: Aggregates featured, latest, and related content with accessible markup.
 */
?>
<!-- wp:group {"className":"content-hub-section"} -->
<div class="wp-block-group content-hub-section" aria-label="Content Hub">
	<!-- wp:heading {"level":2} -->
	<h2>Explore This Topic</h2>
	<!-- /wp:heading -->
	<!-- wp:columns -->
	<div class="wp-block-columns">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3} -->
			<h3>Featured</h3>
			<!-- /wp:heading -->
			<!-- wp:latest-posts {"postsToShow":2,"displayPostDate":true,"className":"featured-posts"} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3} -->
			<h3>Latest</h3>
			<!-- /wp:heading -->
			<!-- wp:latest-posts {"postsToShow":3,"displayPostDate":true,"className":"latest-posts"} /-->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3} -->
			<h3>Related</h3>
			<!-- /wp:heading -->
			<!-- wp:categories {"className":"related-categories"} /-->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group --> 