<?php
/**
 * Authority Blueprint theme functions and definitions
 *
 * Implements best practices from industry blueprints for authority websites, including:
 * - Mobile-first, SEO, accessibility, and performance
 * - Custom post types and taxonomies for pillar, cluster, resource, case study, glossary
 * - Modular, extensible, and fully customizable architecture
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'authority_blueprint_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function authority_blueprint_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'authority_blueprint_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'authority_blueprint_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function authority_blueprint_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'authority-blueprint-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'authority_blueprint_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'authority_blueprint_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function authority_blueprint_pattern_categories() {

		register_block_pattern_category(
			'authority_blueprint_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'authority-blueprint' ),
				'description' => __( 'A collection of full page layouts.', 'authority-blueprint' ),
			)
		);
	}
endif;

add_action( 'init', 'authority_blueprint_pattern_categories' );

// Add theme support for key features
add_action( 'after_setup_theme', function() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'align-wide' );
} );

// Register custom post types and taxonomies for authority site architecture
add_action( 'init', function() {
	// Pillar Content
	register_post_type( 'pillar', array(
		'labels' => array(
			'name' => __( 'Pillars', 'authority-blueprint' ),
			'singular_name' => __( 'Pillar', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'pillar' ),
	) );
	// Cluster Content
	register_post_type( 'cluster', array(
		'labels' => array(
			'name' => __( 'Clusters', 'authority-blueprint' ),
			'singular_name' => __( 'Cluster', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'cluster' ),
	) );
	// Resource Content
	register_post_type( 'resource', array(
		'labels' => array(
			'name' => __( 'Resources', 'authority-blueprint' ),
			'singular_name' => __( 'Resource', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'resource' ),
	) );
	// Case Study Content
	register_post_type( 'case_study', array(
		'labels' => array(
			'name' => __( 'Case Studies', 'authority-blueprint' ),
			'singular_name' => __( 'Case Study', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'case-study' ),
	) );
	// Glossary Content
	register_post_type( 'glossary', array(
		'labels' => array(
			'name' => __( 'Glossaries', 'authority-blueprint' ),
			'singular_name' => __( 'Glossary', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'glossary' ),
	) );
	// Custom Taxonomies
	register_taxonomy( 'topic', array( 'pillar', 'cluster', 'resource', 'case_study', 'glossary' ), array(
		'label' => __( 'Topics', 'authority-blueprint' ),
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'topic' ),
	) );
	register_taxonomy( 'audience', array( 'pillar', 'cluster', 'resource', 'case_study', 'glossary' ), array(
		'label' => __( 'Audiences', 'authority-blueprint' ),
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'audience' ),
	) );
	register_taxonomy( 'resource_type', array( 'resource' ), array(
		'label' => __( 'Resource Types', 'authority-blueprint' ),
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'resource-type' ),
	) );
} );

// Register navigation menus for header and footer
add_action( 'after_setup_theme', function() {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'authority-blueprint' ),
		'footer'  => __( 'Footer Menu', 'authority-blueprint' ),
	) );
} );

// Register block pattern categories and a sample pattern for rapid layout creation
add_action( 'init', function() {
	register_block_pattern_category(
		'authority_blueprint_hero',
		array(
			'label' => __( 'Hero Sections', 'authority-blueprint' ),
		)
	);

	register_block_pattern(
		'authority-blueprint/hero-simple',
		array(
			'title'       => __( 'Simple Hero Section', 'authority-blueprint' ),
			'description' => _x( 'A mobile-first, accessible hero section with headline, description, and call to action.', 'Block pattern description', 'authority-blueprint' ),
			'categories'  => array( 'authority_blueprint_hero' ),
			'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"backgroundColor":"primary","textColor":"background"} -->
<div class="wp-block-group alignfull has-background-color has-primary-background-color has-text-color has-background" style="padding-top:3rem;padding-bottom:3rem"><div class="wp-block-group__inner-container"><!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="has-text-align-center">Welcome to Your Authority Site</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Build trust, rank higher, and convert more with a best-practice, mobile-first, SEO-optimized WordPress site.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"background","textColor":"primary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-background-color has-primary-color has-text-color has-background" href="#">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:group -->',
		)
	);

	// Featured Content pattern category and pattern
	register_block_pattern_category(
		'authority_blueprint_featured',
		array('label' => __( 'Featured Content', 'authority-blueprint' ))
	);
	register_block_pattern(
		'authority-blueprint/featured-content-cards',
		array(
			'title' => __( 'Featured Content Cards', 'authority-blueprint' ),
			'description' => _x( 'A responsive, accessible section for highlighting featured articles or resources.', 'Block pattern description', 'authority-blueprint' ),
			'categories' => array( 'authority_blueprint_featured' ),
			'content' => '<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"2rem"}}} -->
<div class="wp-block-group alignwide"><!-- wp:columns {"isStackedOnMobile":true} -->
<div class="wp-block-columns is-stack-on-mobile"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"https://via.placeholder.com/600x400","dimRatio":30,"minHeight":200,"isDark":false} -->
<div class="wp-block-cover is-light" style="min-height:200px"><img class="wp-block-cover__image-background" alt="" src="https://via.placeholder.com/600x400" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":3} -->
<h3>Featured Guide</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Highlight your best content here for maximum impact.</p>
<!-- /wp:paragraph --><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link" href="#">Read More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:cover {"url":"https://via.placeholder.com/600x400","dimRatio":30,"minHeight":200,"isDark":false} -->
<div class="wp-block-cover is-light" style="min-height:200px"><img class="wp-block-cover__image-background" alt="" src="https://via.placeholder.com/600x400" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"level":3} -->
<h3>Resource Library</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Drive users to your most valuable resources or downloads.</p>
<!-- /wp:paragraph --><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link" href="#">Explore</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
		)
	);

	// Testimonials pattern category and pattern
	register_block_pattern_category(
		'authority_blueprint_testimonials',
		array('label' => __( 'Testimonials', 'authority-blueprint' ))
	);
	register_block_pattern(
		'authority-blueprint/testimonials-simple',
		array(
			'title' => __( 'Simple Testimonials', 'authority-blueprint' ),
			'description' => _x( 'A mobile-first, accessible testimonials section with quotes and author info.', 'Block pattern description', 'authority-blueprint' ),
			'categories' => array( 'authority_blueprint_testimonials' ),
			'content' => '<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"2rem"}}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="has-text-align-center">What Our Readers Say</h2>
<!-- /wp:heading -->
<!-- wp:columns {"isStackedOnMobile":true} -->
<div class="wp-block-columns is-stack-on-mobile"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote -->
<blockquote class="wp-block-quote"><p>"This site helped me become an expert in my field."</p><cite>Jane Doe</cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote -->
<blockquote class="wp-block-quote"><p>"The resources and guides are top-notch and easy to follow."</p><cite>John Smith</cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
		)
	);

	// Newsletter Signup pattern category and pattern
	register_block_pattern_category(
		'authority_blueprint_newsletter',
		array('label' => __( 'Newsletter Signup', 'authority-blueprint' ))
	);
	register_block_pattern(
		'authority-blueprint/newsletter-signup-simple',
		array(
			'title' => __( 'Simple Newsletter Signup', 'authority-blueprint' ),
			'description' => _x( 'A mobile-first, accessible newsletter signup section with headline, description, and form.', 'Block pattern description', 'authority-blueprint' ),
			'categories' => array( 'authority_blueprint_newsletter' ),
			'content' => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem"}}},"backgroundColor":"primary","textColor":"background"} -->
<div class="wp-block-group alignwide has-background-color has-primary-background-color has-text-color has-background" style="padding-top:2rem;padding-bottom:2rem"><div class="wp-block-group__inner-container"><!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="has-text-align-center">Stay Updated</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Subscribe to our newsletter for the latest authority content and resources.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:shortcode -->
[email-subscribers-form id="1"]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div></div>
<!-- /wp:group -->',
		)
	);
});

// Enqueue editor styles for block editor consistency
add_action( 'after_setup_theme', function() {
	add_editor_style( 'style.css' );
} );

// Enqueue navigation JS and CSS for mobile-first hamburger menu
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'authority-blueprint-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );
	wp_enqueue_style( 'authority-blueprint-navigation', get_template_directory_uri() . '/css/navigation.css', array(), '1.0.0' );
} );

// Output skip link for accessibility
add_action( 'wp_body_open', function() {
	echo '<a class="skip-link screen-reader-text" href="#main">Skip to main content</a>';
} );
