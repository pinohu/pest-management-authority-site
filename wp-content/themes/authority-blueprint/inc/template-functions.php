<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Authority_Blueprint
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function authority_blueprint_body_classes($classes) {
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'authority_blueprint_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function authority_blueprint_pingback_header() {
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'authority_blueprint_pingback_header');

/**
 * Breadcrumb Navigation for Enhanced Site Structure
 */
function authority_blueprint_breadcrumbs() {
	if (is_front_page()) return;
	
	$separator = '<span class="breadcrumb-separator"> / </span>';
	$home_title = 'Home';
	
	echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
	echo '<ol class="breadcrumb-list">';
	
	// Home link
	echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">' . esc_html($home_title) . '</a></li>';
	echo '<li class="breadcrumb-item">' . $separator . '</li>';
	
	if (is_category() || is_single()) {
		if (is_single()) {
			$category = get_the_category();
			if (!empty($category)) {
				$last_category = end($category);
				echo '<li class="breadcrumb-item"><a href="' . esc_url(get_category_link($last_category->term_id)) . '">' . esc_html($last_category->name) . '</a></li>';
				echo '<li class="breadcrumb-item">' . $separator . '</li>';
			}
			echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(get_the_title()) . '</li>';
		} else {
			echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(single_cat_title('', false)) . '</li>';
		}
	} elseif (is_page()) {
		$parent_id = wp_get_post_parent_id(get_the_ID());
		if ($parent_id) {
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) {
				echo '<li class="breadcrumb-item">' . $crumb . '</li>';
				echo '<li class="breadcrumb-item">' . $separator . '</li>';
			}
		}
		echo '<li class="breadcrumb-item current" aria-current="page">' . esc_html(get_the_title()) . '</li>';
	} elseif (is_tag()) {
		echo '<li class="breadcrumb-item current" aria-current="page">Tag: ' . esc_html(single_tag_title('', false)) . '</li>';
	} elseif (is_author()) {
		echo '<li class="breadcrumb-item current" aria-current="page">Author: ' . esc_html(get_the_author()) . '</li>';
	} elseif (is_404()) {
		echo '<li class="breadcrumb-item current" aria-current="page">404 Error</li>';
	} elseif (is_search()) {
		echo '<li class="breadcrumb-item current" aria-current="page">Search Results</li>';
	}
	
	echo '</ol>';
	echo '</nav>';
}

/**
 * Custom Comment Display
 */
function authority_blueprint_comment($comment, $args, $depth) {
	if ('div' === $args['style']) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
	<?php if ('div' !== $args['style']) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
	<?php endif; ?>
	
	<div class="comment-content-wrapper">
		<div class="comment-author vcard">
			<?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'avatar')); ?>
			<div class="comment-metadata">
				<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()); ?>
				<a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
					<time datetime="<?php comment_time('c'); ?>">
						<?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()); ?>
					</time>
				</a>
				<?php edit_comment_link(__('(Edit)'), '  ', ''); ?>
			</div>
		</div>
		
		<?php if ($comment->comment_approved == '0') : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-content">
			<?php comment_text(); ?>
		</div>

		<div class="reply">
			<?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
	</div>
	
	<?php if ('div' !== $args['style']) : ?>
		</div>
	<?php endif; ?>
	<?php
}

/**
 * Enhanced Widget Areas for Better Site Structure
 */
function authority_blueprint_widgets_init() {
	register_sidebar(array(
		'name'          => esc_html__('Primary Sidebar', 'authority-blueprint'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'authority-blueprint'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget Area 1', 'authority-blueprint'),
		'id'            => 'footer-1',
		'description'   => esc_html__('Add widgets here to appear in the first footer column.', 'authority-blueprint'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget Area 2', 'authority-blueprint'),
		'id'            => 'footer-2',
		'description'   => esc_html__('Add widgets here to appear in the second footer column.', 'authority-blueprint'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget Area 3', 'authority-blueprint'),
		'id'            => 'footer-3',
		'description'   => esc_html__('Add widgets here to appear in the third footer column.', 'authority-blueprint'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Footer Widget Area 4', 'authority-blueprint'),
		'id'            => 'footer-4',
		'description'   => esc_html__('Add widgets here to appear in the fourth footer column.', 'authority-blueprint'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Homepage Hero Widget Area', 'authority-blueprint'),
		'id'            => 'homepage-hero',
		'description'   => esc_html__('Add widgets here to appear in the homepage hero section.', 'authority-blueprint'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'authority_blueprint_widgets_init');

/**
 * Enhanced Featured Image Sizes
 */
function authority_blueprint_image_sizes() {
	add_image_size('hero-banner', 1920, 600, true);
	add_image_size('card-thumbnail', 400, 250, true);
	add_image_size('post-featured', 800, 400, true);
	add_image_size('sidebar-thumb', 300, 200, true);
}
add_action('after_setup_theme', 'authority_blueprint_image_sizes');

/**
 * Custom Post Meta Display
 */
function authority_blueprint_post_meta() {
	echo '<div class="post-meta">';
	
	// Published date
	echo '<span class="posted-on">';
	echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">';
	echo '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>';
	echo '<line x1="16" y1="2" x2="16" y2="6"></line>';
	echo '<line x1="8" y1="2" x2="8" y2="6"></line>';
	echo '<line x1="3" y1="10" x2="21" y2="10"></line>';
	echo '</svg>';
	echo '<time datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>';
	echo '</span>';
	
	// Author
	echo '<span class="byline">';
	echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">';
	echo '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>';
	echo '<circle cx="12" cy="7" r="4"></circle>';
	echo '</svg>';
	echo '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>';
	echo '</span>';
	
	// Categories
	if (has_category()) {
		echo '<span class="categories">';
		echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">';
		echo '<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>';
		echo '<line x1="7" y1="7" x2="7.01" y2="7"></line>';
		echo '</svg>';
		the_category(', ');
		echo '</span>';
	}
	
	// Reading time
	$content = get_post_field('post_content', get_the_ID());
	$word_count = str_word_count(strip_tags($content));
	$reading_time = ceil($word_count / 200);
	
	echo '<span class="reading-time">';
	echo '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">';
	echo '<circle cx="12" cy="12" r="10"></circle>';
	echo '<polyline points="12,6 12,12 16,14"></polyline>';
	echo '</svg>';
	echo sprintf(_n('%d min read', '%d min read', $reading_time, 'authority-blueprint'), $reading_time);
	echo '</span>';
	
	echo '</div>';
}

/**
 * Social Share Buttons
 */
function authority_blueprint_social_share() {
	$url = urlencode(get_permalink());
	$title = urlencode(get_the_title());
	
	echo '<div class="social-share">';
	echo '<h4>' . esc_html__('Share this article:', 'authority-blueprint') . '</h4>';
	echo '<div class="share-buttons">';
	
	// Twitter
	echo '<a href="https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title . '" target="_blank" class="share-twitter" aria-label="Share on Twitter">';
	echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>';
	echo '</a>';
	
	// LinkedIn
	echo '<a href="https://www.linkedin.com/sharing/share-offsite/?url=' . $url . '" target="_blank" class="share-linkedin" aria-label="Share on LinkedIn">';
	echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>';
	echo '</a>';
	
	// Facebook
	echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" class="share-facebook" aria-label="Share on Facebook">';
	echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>';
	echo '</a>';
	
	echo '</div>';
	echo '</div>';
}
?> 