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
 * @package Authority_Blueprint
 * @since Authority_Blueprint 1.0
 */

/**
 * Theme Setup
 */
if (!function_exists('authority_blueprint_setup')) :
	function authority_blueprint_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Let WordPress manage the document title.
		add_theme_support('title-tag');

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in multiple locations.
		register_nav_menus(array(
			'primary' => esc_html__('Primary Menu', 'authority-blueprint'),
			'footer' => esc_html__('Footer Menu', 'authority-blueprint'),
		));

		// Switch default core markup for search form, comment form, and comments
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('authority_blueprint_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for core custom logo.
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));

		// Add support for wide and full alignment.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('style.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');
	}
endif;
add_action('after_setup_theme', 'authority_blueprint_setup');

/**
 * Enqueue scripts and styles.
 */
function authority_blueprint_scripts() {
	// Main theme stylesheet
	wp_enqueue_style('authority-blueprint-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

	// Load Google Fonts
	wp_enqueue_style('authority-blueprint-fonts', 
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap',
		array(), null);

	// Main theme JavaScript
	wp_enqueue_script('authority-blueprint-navigation', 
		get_template_directory_uri() . '/js/navigation.js', 
		array('jquery'), wp_get_theme()->get('Version'), true);

	// Skip link focus script
	wp_enqueue_script('authority-blueprint-skip-link-focus-fix', 
		get_template_directory_uri() . '/js/skip-link-focus-fix.js', 
		array(), wp_get_theme()->get('Version'), true);

	// Comment reply script
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Localize script for AJAX
	wp_localize_script('authority-blueprint-navigation', 'authority_blueprint_ajax', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('authority_blueprint_nonce'),
	));
}
add_action('wp_enqueue_scripts', 'authority_blueprint_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

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

/**
 * Include theme enhancement files
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/class-pest-research-widget.php';

// Add theme support for key features
add_action( 'after_setup_theme', function() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'align-wide' );
} );

// Register custom post types and taxonomies for pest management science authority site architecture
add_action( 'init', function() {
	// Pest Pillar Content
	register_post_type( 'pillar', array(
		'labels' => array(
			'name' => __( 'Pest Pillars', 'authority-blueprint' ),
			'singular_name' => __( 'Pest Pillar', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'pillar' ),
	) );
	// Pest Cluster Content
	register_post_type( 'cluster', array(
		'labels' => array(
			'name' => __( 'Pest Clusters', 'authority-blueprint' ),
			'singular_name' => __( 'Pest Cluster', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'cluster' ),
	) );
	// Pest Resource Content
	register_post_type( 'resource', array(
		'labels' => array(
			'name' => __( 'Pest Resources', 'authority-blueprint' ),
			'singular_name' => __( 'Pest Resource', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'resource' ),
	) );
	// Pest Case Study Content
	register_post_type( 'case_study', array(
		'labels' => array(
			'name' => __( 'Pest Case Studies', 'authority-blueprint' ),
			'singular_name' => __( 'Pest Case Study', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'case-study' ),
	) );
	// Pest Glossary Content
	register_post_type( 'glossary', array(
		'labels' => array(
			'name' => __( 'Pest Glossaries', 'authority-blueprint' ),
			'singular_name' => __( 'Pest Glossary', 'authority-blueprint' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions' ),
		'rewrite' => array( 'slug' => 'glossary' ),
	) );
	// Custom Taxonomies
	register_taxonomy( 'topic', array( 'pillar', 'cluster', 'resource', 'case_study', 'glossary' ), array(
		'label' => __( 'Pest Topics', 'authority-blueprint' ),
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'topic' ),
	) );
	register_taxonomy( 'audience', array( 'pillar', 'cluster', 'resource', 'case_study', 'glossary' ), array(
		'label' => __( 'Pest Audiences', 'authority-blueprint' ),
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'audience' ),
	) );
	register_taxonomy( 'control_method', array( 'pillar', 'cluster', 'resource', 'case_study' ), array(
		'label' => __( 'Control Methods', 'authority-blueprint' ),
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'control-method' ),
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

// Register custom block patterns for authority blueprint
add_action('init', function() {
	$patterns = [
		'hero-section',
		'feature-list',
		'testimonial-section',
		'mobile-nav',
		'bottom-nav',
		'mobile-form',
		'feature-card',
		'aspect-ratio-media',
		'cta-section',
		'content-hub',
		'accessibility-announcement',
		'faq-section',
		'comparison-table',
	];
	foreach ($patterns as $pattern) {
		register_block_pattern(
			'authority-blueprint/' . $pattern,
			[
				'title'       => ucwords(str_replace('-', ' ', $pattern)),
				'description' => 'Authority Blueprint: ' . ucwords(str_replace('-', ' ', $pattern)),
				'content'     => file_get_contents(get_template_directory() . '/block-patterns/' . $pattern . '.php'),
				'categories'  => ['authority-blueprint'],
			]
		);
	}
});

// Enqueue editor styles for block editor consistency
add_action( 'after_setup_theme', function() {
	add_editor_style( 'style.css' );
} );

// Enqueue styles and scripts
add_action( 'wp_enqueue_scripts', function() {
	// Google Fonts
	wp_enqueue_style( 'authority-blueprint-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null );
	
	// Theme styles
	wp_enqueue_style( 'authority-blueprint-navigation', get_template_directory_uri() . '/css/navigation.css', array(), '1.0.0' );
	wp_enqueue_style( 'authority-blueprint-components', get_template_directory_uri() . '/css/components.css', array(), '1.0.0' );
	wp_enqueue_style( 'authority-blueprint-enhanced-structure', get_template_directory_uri() . '/css/enhanced-structure.css', array(), '1.0.0' );
	
	// Scripts
	wp_enqueue_script( 'authority-blueprint-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );
} );

// Output skip link for accessibility
add_action( 'wp_body_open', function() {
	echo '<a href="#main" class="skip-link">Skip to main content</a>';
} );

// Enqueue custom block styles and variations
add_action( 'enqueue_block_editor_assets', function() {
	wp_enqueue_script(
		'authority-block-styles',
		get_template_directory_uri() . '/js/block-styles.js',
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
		null,
		true
	);
	wp_enqueue_script(
		'authority-block-variations',
		get_template_directory_uri() . '/js/block-variations.js',
		array( 'wp-blocks' ),
		null,
		true
	);
} );

// Register a placeholder for custom REST API endpoints
add_action( 'rest_api_init', function() {
	// Example: register_rest_route( ... );
} );

// Add privacy policy content (for future plugin/theme data collection)
add_action( 'admin_init', function() {
	if ( function_exists( 'wp_add_privacy_policy_content' ) ) {
		wp_add_privacy_policy_content( 'Authority Blueprint',
			__( 'This theme does not collect or store personal data by default.', 'authority-blueprint' )
		);
	}
} );

// --- Extensibility Hooks ---
// Allow plugins to extend schema.org output
function authority_blueprint_schema_filter($schema, $post) {
    return apply_filters('authority_blueprint_schema', $schema, $post);
}
// Allow plugins to log or enhance performance metrics
function authority_blueprint_performance_metrics($metrics) {
    do_action('authority_blueprint_performance_metrics', $metrics);
}
// Allow plugins to inject content into theme parts
function authority_blueprint_before_header() { do_action('authority_blueprint_before_header'); }
function authority_blueprint_after_header() { do_action('authority_blueprint_after_header'); }
function authority_blueprint_before_footer() { do_action('authority_blueprint_before_footer'); }
function authority_blueprint_after_footer() { do_action('authority_blueprint_after_footer'); }

// --- Advanced Schema.org Output ---
add_action('wp_head', function() {
    if (!is_singular()) return;
    global $post;
    if (!$post) return;
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => is_singular('post') ? 'Article' : (is_page() ? 'WebPage' : 'CreativeWork'),
        'headline' => get_the_title($post),
        'datePublished' => get_the_date('c', $post),
        'dateModified' => get_the_modified_date('c', $post),
        'author' => array(
            '@type' => 'Person',
            'name' => get_the_author_meta('display_name', $post->post_author),
        ),
        'mainEntityOfPage' => get_permalink($post),
        'description' => get_the_excerpt($post),
        'image' => get_the_post_thumbnail_url($post, 'full'),
    );
    $schema = authority_blueprint_schema_filter($schema, $post);
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
});

// --- Performance Metrics Logging ---
add_action('wp_footer', function() {
    $memory = round(memory_get_peak_usage(true) / 1048576, 2);
    $load = timer_stop(0, 3);
    echo '<div class="site-performance" aria-label="Performance Metrics">Memory: ' . esc_html($memory) . 'MB | Load Time: ' . esc_html($load) . 's</div>';
});

// --- Accessibility: ARIA live region for announcements ---
add_action('wp_footer', function() {
    echo '<div id="a11y-announcements" aria-live="polite" class="sr-only" role="status"></div>';
});

// --- Accessibility: Skip link focus management JS ---
add_action('wp_enqueue_scripts', function() {
    wp_add_inline_script('authority-blueprint-navigation',
        'document.addEventListener("DOMContentLoaded",function(){var s=document.querySelector(".skip-link");if(s){s.addEventListener("click",function(e){var m=document.getElementById("main");if(m){m.setAttribute("tabindex","-1");m.focus();}});}});'
    );
});

// --- Extensibility: Filter for internal linking keyword map ---
if (!function_exists('authority_internal_linking_map')) {
    function authority_internal_linking_map($map) {
        return apply_filters('authority_internal_linking_map', $map);
    }
}

// --- Add extensibility hooks for plugins/child themes ---
do_action('authority_blueprint_before_header');
do_action('authority_blueprint_after_header');
do_action('authority_blueprint_before_footer');
do_action('authority_blueprint_after_footer');
do_action('authority_blueprint_before_main');
do_action('authority_blueprint_after_main');

// --- SEO: Canonical and Open Graph Meta Tags ---
add_action('wp_head', function() {
    if (!is_singular()) return;
    global $post;
    if (!$post) return;
    // Canonical tag
    $canonical = get_permalink($post);
    echo '<link rel="canonical" href="' . esc_url($canonical) . '" />\n';
    // Open Graph meta tags
    $og_title = get_the_title($post);
    $og_desc = get_the_excerpt($post);
    $og_url = get_permalink($post);
    $og_img = get_the_post_thumbnail_url($post, 'full');
    echo '<meta property="og:type" content="article" />\n';
    echo '<meta property="og:title" content="' . esc_attr($og_title) . '" />\n';
    echo '<meta property="og:description" content="' . esc_attr($og_desc) . '" />\n';
    echo '<meta property="og:url" content="' . esc_url($og_url) . '" />\n';
    if ($og_img) {
        echo '<meta property="og:image" content="' . esc_url($og_img) . '" />\n';
    }
    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image" />\n';
    echo '<meta name="twitter:title" content="' . esc_attr($og_title) . '" />\n';
    echo '<meta name="twitter:description" content="' . esc_attr($og_desc) . '" />\n';
    if ($og_img) {
        echo '<meta name="twitter:image" content="' . esc_url($og_img) . '" />\n';
    }
    // Extensibility hook
    do_action('authority_blueprint_seo_meta', $post);
});

// --- MCP Integration: AltText.ai for Image Alt Text ---
add_action('add_attachment', function($post_ID) {
    $post = get_post($post_ID);
    if ($post->post_type !== 'attachment') return;
    $mime = get_post_mime_type($post_ID);
    if (strpos($mime, 'image/') !== 0) return;
    $alt = get_post_meta($post_ID, '_wp_attachment_image_alt', true);
    if (!empty($alt)) return; // Alt text already set
    $image_url = wp_get_attachment_url($post_ID);
    // Call AltText.ai MCP (pseudo-code, replace with real API call)
    $alt_text = null;
    try {
        $response = wp_remote_post('https://api.alttext.ai/v1/generate', array(
            'headers' => array('Content-Type' => 'application/json'),
            'body' => json_encode(array('image_url' => $image_url)),
            'timeout' => 10,
        ));
        if (!is_wp_error($response) && isset($response['body'])) {
            $data = json_decode($response['body'], true);
            if (isset($data['alt_text'])) {
                $alt_text = $data['alt_text'];
            }
        }
    } catch (Exception $e) {
        error_log('AltText.ai error: ' . $e->getMessage());
    }
    if ($alt_text) {
        update_post_meta($post_ID, '_wp_attachment_image_alt', sanitize_text_field($alt_text));
        error_log('AltText.ai alt text set for attachment ' . $post_ID . ': ' . $alt_text);
    } else {
        // Fallback: leave alt text empty for manual entry
        error_log('AltText.ai failed for attachment ' . $post_ID . ' (' . $image_url . ')');
    }
    // Extensibility hook for other MCPs
    do_action('authority_blueprint_image_alt_mcp', $post_ID, $alt_text);
});

// === DIRECTORIST INTEGRATION FOR PEST MANAGEMENT SCIENCE ===

// Enqueue Directorist integration styles
add_action('wp_enqueue_scripts', function() {
    if (function_exists('directorist_setup')) {
        wp_enqueue_style('authority-directorist-integration', 
            get_template_directory_uri() . '/css/directorist-integration.css',
            array('authority-blueprint-style'), '1.0.0');
    }
});

// Directorist customization for pest management science
add_action('init', function() {
    if (function_exists('directorist_setup')) {
        add_filter('directorist_listing_types', 'pest_management_directory_types');
        add_filter('directorist_custom_fields', 'pest_management_custom_fields');
    }
});

function pest_management_directory_types($types) {
    $pest_types = array(
        'pest-control-services' => array(
            'name' => 'Pest Control Services',
            'description' => 'Professional pest control and management services',
            'icon' => 'fas fa-bug'
        ),
        'research-institutions' => array(
            'name' => 'Research Institutions',
            'description' => 'Universities and research centers',
            'icon' => 'fas fa-microscope'
        ),
        'product-suppliers' => array(
            'name' => 'Product Suppliers',
            'description' => 'Pest management products and equipment',
            'icon' => 'fas fa-boxes'
        )
    );
    
    return array_merge($types, $pest_types);
}

function pest_management_custom_fields($fields) {
    $pest_fields = array(
        'pest_specialization' => array(
            'label' => 'Pest Specialization',
            'type' => 'select',
            'options' => array(
                'agricultural' => 'Agricultural Pests',
                'urban' => 'Urban Pests',
                'stored-product' => 'Stored Product Pests',
                'structural' => 'Structural Pests',
                'public-health' => 'Public Health Pests'
            )
        ),
        'control_methods' => array(
            'label' => 'Control Methods',
            'type' => 'checkbox',
            'options' => array(
                'biological' => 'Biological Control',
                'chemical' => 'Chemical Control',
                'mechanical' => 'Mechanical Control',
                'cultural' => 'Cultural Control',
                'integrated' => 'Integrated Pest Management'
            )
        ),
        'certifications' => array(
            'label' => 'Certifications',
            'type' => 'text',
            'description' => 'Professional certifications and licenses'
        ),
        'service_area' => array(
            'label' => 'Service Area',
            'type' => 'text',
            'description' => 'Geographic areas served'
        )
    );
    
    return array_merge($fields, $pest_fields);
}

// Add directory showcase to front page
add_filter('the_content', function($content) {
    if (is_front_page() && !is_admin() && function_exists('directorist_setup')) {
        $directory_content = '
        <section class="pest-directory-showcase">
            <h2>Find Pest Management Professionals</h2>
            <p>Connect with certified pest control services, research institutions, and product suppliers in your area.</p>
            <div class="directory-quick-links">
                <a href="/directory/" class="btn btn-primary">Browse Directory</a>
                <a href="/add-listing/" class="btn btn-secondary">Add Your Listing</a>
            </div>
        </section>';
        
        return $content . $directory_content;
    }
    return $content;
});
