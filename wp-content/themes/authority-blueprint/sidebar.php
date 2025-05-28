<?php
/**
 * Sidebar partial for Authority Blueprint
 *
 * Implements contextual navigation and related content modules.
 *
 * @package Authority_Blueprint
 */
?>
<aside id="secondary" class="sidebar" role="complementary" aria-label="Sidebar">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
		<label for="sidebar-search">Search</label>
		<input type="search" id="sidebar-search" class="search-field" placeholder="Search …" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-submit">Search</button>
	</form>
	<section class="widget recent-posts">
		<h2>Recent Posts</h2>
		<ul>
			<?php
				$recent_posts = wp_get_recent_posts(array('numberposts' => 5));
				foreach ($recent_posts as $post) : ?>
					<li><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo esc_html($post['post_title']); ?></a></li>
				<?php endforeach; ?>
			?>
		</ul>
	</section>
	<section class="widget categories">
		<h2>Categories</h2>
		<ul>
			<?php wp_list_categories(array('title_li' => '')); ?>
		</ul>
	</section>
	<section class="widget related-content">
		<h2>Related Content</h2>
		<!-- Placeholder for related content logic -->
	</section>
</aside> 