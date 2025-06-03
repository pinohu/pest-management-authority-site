<?php
/*
 * Authority Blueprint MCP Theme
 *
 * Plug-and-Play Automation:
 * - On activation, automatically creates demo pages, menus, widgets, homepage, and blog page for Pest Management Science (or any [NICHE])
 * - Runs only once per site (uses ab_mcp_demo_content_installed option)
 * - To customize for another niche, edit the $pages and $menus arrays in the after_switch_theme hook
 * - To re-run, delete the ab_mcp_demo_content_installed option from the options table
 * - All code is in this file, no plugins required
 * - Follows all project best practices for automation, accessibility, SEO, and extensibility
 */

// Authority Blueprint MCP Theme Functions

define('AB_MCP_VERSION', '1.0.0');

define('AB_MCP_DIR', get_template_directory());
define('AB_MCP_URI', get_template_directory_uri());

// Theme setup
add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('automatic-feed-links');
    load_theme_textdomain('authority-blueprint-mcp', AB_MCP_DIR . '/languages');
    register_nav_menus([
        'primary' => __('Primary Menu', 'authority-blueprint-mcp'),
        'footer'  => __('Footer Menu', 'authority-blueprint-mcp'),
    ]);
});

// Enqueue styles and scripts
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('ab-mcp-style', AB_MCP_URI . '/style.css', [], AB_MCP_VERSION);
    wp_enqueue_style('ab-mcp-navigation', AB_MCP_URI . '/css/navigation.css', ['ab-mcp-style'], AB_MCP_VERSION);
    wp_enqueue_script('ab-mcp-navigation', AB_MCP_URI . '/js/navigation.js', [], AB_MCP_VERSION, true);
    wp_enqueue_style('inter-font', 'https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700&display=swap', [], null);
});

// Register widget areas
add_action('widgets_init', function() {
    register_sidebar([
        'name' => __('Main Sidebar', 'authority-blueprint-mcp'),
        'id' => 'sidebar-1',
        'description' => __('Primary sidebar for widgets.', 'authority-blueprint-mcp'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
    register_sidebar([
        'name' => __('Footer Widgets', 'authority-blueprint-mcp'),
        'id' => 'footer-1',
        'description' => __('Footer widget area.', 'authority-blueprint-mcp'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
});

// Load inc files
glob_recursive_include(AB_MCP_DIR . '/inc');
function glob_recursive_include($dir) {
    foreach (glob($dir . '/*.php') as $file) {
        require_once $file;
    }
}

// === MCP INTEGRATIONS ===
// AltText.ai: Auto alt text for images (media upload hook)
// NEURONWriter: Content optimization suggestions (admin metabox)
add_action('add_meta_boxes', function() {
    add_meta_box('neuronwriter_suggestions', __('Content Optimization', 'authority-blueprint-mcp'), function($post) {
        echo '<div id="neuronwriter-suggestions">';
        echo esc_html__('Suggestions will appear here (MCP integration placeholder).', 'authority-blueprint-mcp');
        echo '</div>';
    }, null, 'side');
});

// Insighto.ai: Comment moderation (on comment_post)
add_action('comment_post', function($comment_id) {
    // Pseudo-code: Integrate Insighto.ai API for moderation
    // $comment = get_comment($comment_id);
    // $result = insighto_ai_moderate($comment->comment_content);
    // if ($result === 'spam') wp_spam_comment($comment_id);
}, 10, 1);

// Pulsetic: Performance monitoring (admin dashboard widget)
add_action('wp_dashboard_setup', function() {
    wp_add_dashboard_widget('pulsetic_monitoring', __('Site Monitoring', 'authority-blueprint-mcp'), function() {
        echo '<div id="pulsetic-monitoring">';
        echo esc_html__('Performance and uptime stats will appear here (MCP integration placeholder).', 'authority-blueprint-mcp');
        echo '</div>';
    });
});

// a11y MCP: Automated accessibility testing (admin notice)
add_action('admin_notices', function() {
    echo '<div class="notice notice-info"><p>';
    echo esc_html__('Automated accessibility checks (MCP integration placeholder).', 'authority-blueprint-mcp');
    echo '</p></div>';
});

// Add admin notice for missing AltText.ai API key
add_action('admin_notices', function() {
    if (!get_option('ab_mcp_alttext_api_key')) {
        echo '<div class="notice notice-warning"><p>';
        echo esc_html__('AltText.ai API key is missing. Automated image alt text will not be generated. Set your API key in Theme Settings > API Integrations.', 'authority-blueprint-mcp');
        echo '</p></div>';
    }
});

require_once AB_MCP_DIR . '/inc/mcp-settings.php';
require_once AB_MCP_DIR . '/inc/alttext-ai.php';
require_once AB_MCP_DIR . '/inc/neuronwriter.php';
require_once AB_MCP_DIR . '/inc/insighto.php';
require_once AB_MCP_DIR . '/inc/pulsetic.php';
require_once AB_MCP_DIR . '/inc/a11y.php';
require_once AB_MCP_DIR . '/inc/api-settings.php';
require_once AB_MCP_DIR . '/inc/certopus.php';
require_once AB_MCP_DIR . '/inc/printful.php';
require_once AB_MCP_DIR . '/inc/ai-search.php';
require_once AB_MCP_DIR . '/inc/business-crm.php';
require_once AB_MCP_DIR . '/inc/sitemap.php';
require_once AB_MCP_DIR . '/inc/editorial-workflow.php';
require_once AB_MCP_DIR . '/inc/onboarding.php'; // Modular onboarding and starter kits

// === OpenAI Content Generator REST API ===
add_action('rest_api_init', function() {
    register_rest_route('ab-mcp/v1', '/openai-generate', [
        'methods' => 'POST',
        'callback' => function($request) {
            $params = $request->get_json_params();
            $prompt = isset($params['prompt']) ? sanitize_text_field($params['prompt']) : '';
            if (!$prompt) {
                return new WP_REST_Response(['error' => 'No prompt provided.'], 400);
            }
            $content = ab_openai_generate_content($prompt);
            return new WP_REST_Response(['content' => $content], 200);
        },
        'permission_callback' => '__return_true', // Public for demo; restrict as needed
    ]);
});

// Add theme support for WebP images
add_filter('wp_image_editors', function($editors) {
    array_unshift($editors, 'WP_Image_Editor_Imagick');
    return $editors;
});
add_filter('image_editor_output_format', function($formats) {
    $formats['image/jpeg'] = 'image/webp';
    $formats['image/png'] = 'image/webp';
    return $formats;
});

// Preload critical fonts and add resource hints
add_action('wp_head', function() {
    echo '<link rel="preload" as="font" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700&display=swap" crossorigin>';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link rel="preconnect" href="https://api.openai.com" crossorigin>';
    echo '<link rel="preconnect" href="https://api.aitable.ai" crossorigin>';
    echo '<link rel="preconnect" href="https://api.reoon.com" crossorigin>';
    echo '<link rel="preconnect" href="https://acumbamail.com" crossorigin>';
    echo '<link rel="preconnect" href="https://a11y.mcp" crossorigin>';
    echo '<link rel="preconnect" href="https://api.alttext.ai" crossorigin>';
}, 1);

// Defer non-critical JS (navigation)
add_filter('script_loader_tag', function($tag, $handle) {
    if ('ab-mcp-navigation' === $handle) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}, 10, 2);

// Automated meta/OG/canonical tag generation
add_action('wp_head', function() {
    if (is_singular()) {
        global $post;
        $title = get_the_title($post);
        $desc = get_the_excerpt($post);
        $url = get_permalink($post);
        $img = get_the_post_thumbnail_url($post, 'large');
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />';
        echo '<meta property="og:description" content="' . esc_attr($desc) . '" />';
        echo '<meta property="og:url" content="' . esc_url($url) . '" />';
        if ($img) echo '<meta property="og:image" content="' . esc_url($img) . '" />';
        echo '<link rel="canonical" href="' . esc_url($url) . '" />';
    }
}, 5);

// FAQPage schema for FAQ accordion
add_action('wp_footer', function() {
    if (is_front_page()) {
        $faqs = [
            [
                'question' => __('What is the Authority Blueprint MCP theme?', 'authority-blueprint-mcp'),
                'answer' => __('It is a modern, accessible, automation-ready WordPress theme for authority sites.', 'authority-blueprint-mcp'),
            ],
            [
                'question' => __('How do I use the OpenAI content generator?', 'authority-blueprint-mcp'),
                'answer' => __('Enter a prompt in the form and submit to generate content using OpenAI.', 'authority-blueprint-mcp'),
            ],
            [
                'question' => __('How do I configure API integrations?', 'authority-blueprint-mcp'),
                'answer' => __('Go to Theme Settings > API Integrations to enter your API keys.', 'authority-blueprint-mcp'),
            ],
        ];
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(function($faq) {
                return [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer'],
                    ],
                ];
            }, $faqs),
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
});

// Mobile-optimized block patterns: register FAQ accordion, sticky CTA, comparison cards
add_action('init', function() {
    register_block_pattern('ab-mcp/faq-accordion', [
        'title' => __('FAQ Accordion', 'authority-blueprint-mcp'),
        'content' => "<!-- wp:pattern {'slug':'authority-blueprint-mcp/parts/content-faq-accordion'} /-->",
    ]);
    register_block_pattern('ab-mcp/sticky-cta', [
        'title' => __('Sticky Call to Action', 'authority-blueprint-mcp'),
        'content' => '<div class="sticky-cta" style="position:fixed;bottom:0;width:100%;background:#388e3c;color:#fff;padding:1rem;text-align:center;z-index:1000;">' . esc_html__('Ready to get started? Contact us!', 'authority-blueprint-mcp') . '</div>',
    ]);
    register_block_pattern('ab-mcp/comparison-cards', [
        'title' => __('Comparison Cards', 'authority-blueprint-mcp'),
        'content' => '<div class="comparison-cards" style="display:flex;gap:1rem;flex-wrap:wrap;"><div style="flex:1 1 200px;background:#fff;border-radius:8px;padding:1rem;box-shadow:0 2px 8px rgba(56,142,60,0.07);">' . esc_html__('Card 1', 'authority-blueprint-mcp') . '</div><div style="flex:1 1 200px;background:#fff;border-radius:8px;padding:1rem;box-shadow:0 2px 8px rgba(56,142,60,0.07);">' . esc_html__('Card 2', 'authority-blueprint-mcp') . '</div></div>',
    ]);
});

// Responsive image srcset for mobile
add_filter('wp_calculate_image_srcset', function($sources) {
    foreach ($sources as &$src) {
        if (isset($src['value'])) {
            $src['value'] = add_query_arg('auto', 'webp', $src['value']);
        }
    }
    return $sources;
});

// Font-size adjustments for small screens
add_action('wp_head', function() {
    echo '<style>@media (max-width:600px){body{font-size:0.98rem;}h1{font-size:2rem;}h2{font-size:1.4rem;}h3{font-size:1.1rem;}}</style>';
});

// Mobile a11y testing hook (admin notice if not tested)
add_action('admin_notices', function() {
    if (!get_option('ab_mcp_mobile_a11y_tested')) {
        echo '<div class="notice notice-warning"><p>';
        echo esc_html__('Mobile accessibility testing not yet completed. Please test on real devices.', 'authority-blueprint-mcp');
        echo '</p></div>';
    }
});

// === Automated Demo Content and Setup on Theme Activation ===
// All demo content is now generic and easily customizable for any niche. Edit the $pages and $menus arrays below for your use case.
add_action('after_switch_theme', function() {
    if (get_option('ab_mcp_demo_content_installed')) return;

    // --- 1. Create Pages ---
    $pages = [
        'Home' => [
            'title' => __('Home', 'authority-blueprint-mcp'),
            'content' => '<h2>Welcome to Your Directory & Resource Hub</h2><p>This is a fully customizable, niche-agnostic authority site. Replace this content with your own introduction and value proposition.</p>'
        ],
        'About' => [
            'title' => __('About Us', 'authority-blueprint-mcp'),
            'content' => '<h2>About Our Platform</h2><p>Share your mission, vision, and story here. This theme is ready for any industry or community.</p>'
        ],
        'Contact' => [
            'title' => __('Contact', 'authority-blueprint-mcp'),
            'content' => '<h2>Contact Us</h2><p>Email: info@example.com<br>Phone: (555) 123-4567</p>'
        ],
        'Blog' => [
            'title' => __('Blog', 'authority-blueprint-mcp'),
            'content' => ''
        ],
    ];
    $page_ids = [];
    foreach ($pages as $slug => $data) {
        $existing = get_page_by_title($data['title']);
        if ($existing) {
            $page_ids[$slug] = $existing->ID;
            continue;
        }
        $id = wp_insert_post([
            'post_title'   => $data['title'],
            'post_content' => $data['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
        $page_ids[$slug] = $id;
    }

    // --- 2. Set Homepage and Blog Page ---
    if (!empty($page_ids['Home']) && !empty($page_ids['Blog'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $page_ids['Home']);
        update_option('page_for_posts', $page_ids['Blog']);
    }

    // --- 3. Create Menus and Assign Menu Items ---
    $menus = [
        'Primary Menu' => [
            ['title' => 'Home', 'object' => 'page', 'object_id' => $page_ids['Home'] ?? 0],
            ['title' => 'About', 'object' => 'page', 'object_id' => $page_ids['About'] ?? 0],
            ['title' => 'Blog', 'object' => 'page', 'object_id' => $page_ids['Blog'] ?? 0],
            ['title' => 'Contact', 'object' => 'page', 'object_id' => $page_ids['Contact'] ?? 0],
        ],
        'Footer Menu' => [
            ['title' => 'Privacy Policy', 'url' => '/privacy-policy/'],
            ['title' => 'Terms of Service', 'url' => '/terms/'],
        ],
    ];
    $menu_ids = [];
    foreach ($menus as $menu_name => $items) {
        $menu_id = wp_create_nav_menu($menu_name);
        $menu_ids[$menu_name] = $menu_id;
        foreach ($items as $item) {
            if (!empty($item['object']) && !empty($item['object_id'])) {
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title' => $item['title'],
                    'menu-item-object' => $item['object'],
                    'menu-item-object-id' => $item['object_id'],
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish',
                ]);
            } elseif (!empty($item['url'])) {
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title' => $item['title'],
                    'menu-item-url' => $item['url'],
                    'menu-item-type' => 'custom',
                    'menu-item-status' => 'publish',
                ]);
            }
        }
    }
    // Assign menus to theme locations
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu_ids['Primary Menu'] ?? 0;
    $locations['footer'] = $menu_ids['Footer Menu'] ?? 0;
    set_theme_mod('nav_menu_locations', $locations);

    // --- 4. Set Up Widgets (Main Sidebar) ---
    // To customize widgets for your [NICHE] or layout, edit the array below.
    $sidebars_widgets = get_option('sidebars_widgets');
    $sidebars_widgets['sidebar-1'] = [
        'search-2', 'recent-posts-2', 'categories-2'
    ];
    update_option('sidebars_widgets', $sidebars_widgets);
    // Add default widgets if not present
    $widget_options = [
        'widget_search' => ['_multiwidget' => 1, 2 => []],
        'widget_recent-posts' => ['_multiwidget' => 1, 2 => ['title' => __('Recent Posts', 'authority-blueprint-mcp')]],
        'widget_categories' => ['_multiwidget' => 1, 2 => ['title' => __('Categories', 'authority-blueprint-mcp')]],
    ];
    foreach ($widget_options as $option => $value) {
        if (!get_option($option)) update_option($option, $value);
    }

    // --- 5. (Optional) Add Starter Content for New Installs ---
    // For more advanced demo setups, use WordPress starter content: https://developer.wordpress.org/themes/functionality/starter-content/
    // This can be extended for other [NICHE]s by editing the $pages and $menus arrays above.

    // --- 6. Mark as Installed ---
    // To re-run this automation, delete the ab_mcp_demo_content_installed option from the options table (see README for details).
    update_option('ab_mcp_demo_content_installed', 1);

    // --- 7. Developer Notes ---
    // This is the main place for future maintainers to look for customization and extension instructions.
    // To customize for another niche, change the $pages and $menus arrays above.
    // This automation only runs once per site. To re-run, delete the ab_mcp_demo_content_installed option.

    // --- 8. Best Practices Reminder ---
    // When making changes, follow all project best practices for automation, accessibility, SEO, and extensibility.
});

// Dynamically include all modular integrations
foreach (glob(AB_MCP_DIR . '/inc/integrations/*.php') as $integration_file) {
    require_once $integration_file;
}

// === DIRECTORIST INTEGRATION FOR PEST MANAGEMENT SCIENCE ===
// (Removed: All Directorist integration logic is now modular in inc/integrations/ and inc/directorist-integration.php)
// ... existing code ...

// === Admin Tool: Create Missing Legal & Directory Pages ===
add_action('admin_notices', function() {
    if (!current_user_can('manage_options')) return;
    $missing = [];
    $pages = [
        'Directory' => 'directory',
        'Add Listing' => 'add-listing',
        'Privacy Policy' => 'privacy-policy',
        'Terms of Service' => 'terms',
        'Accessibility Statement' => 'legal/accessibility-statement',
    ];
    foreach ($pages as $title => $slug) {
        $page = get_page_by_path($slug);
        if (!$page) $missing[] = $title;
    }
    if ($missing) {
        $url = add_query_arg('ab_mcp_create_missing_pages', '1');
        echo '<div class="notice notice-warning"><p>';
        echo esc_html__('Some required pages are missing: ', 'authority-blueprint-mcp') . implode(', ', $missing) . '. ';
        echo '<a href="' . esc_url($url) . '" class="button button-primary">' . esc_html__('Create Now', 'authority-blueprint-mcp') . '</a>';
        echo '</p></div>';
    }
});

add_action('admin_init', function() {
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['ab_mcp_create_missing_pages'])) return;
    $created = [];
    $pages = [
        'Directory' => ['slug' => 'directory', 'content' => '<h2>Directory</h2>[directorist_all_listing]'],
        'Add Listing' => ['slug' => 'add-listing', 'content' => '<h2>Add Your Listing</h2>[directorist_add_listing]'],
        'Privacy Policy' => ['slug' => 'privacy-policy', 'content' => '<h2>Privacy Policy</h2><p>Insert your privacy policy here.</p>'],
        'Terms of Service' => ['slug' => 'terms', 'content' => '<h2>Terms of Service</h2><p>Insert your terms of service here.</p>'],
        'Accessibility Statement' => ['slug' => 'legal/accessibility-statement', 'content' => '<h2>Accessibility Statement</h2><p>Insert your accessibility statement here.</p>'],
    ];
    foreach ($pages as $title => $data) {
        $page = get_page_by_path($data['slug']);
        if (!$page) {
            $parent = 0;
            $slug = $data['slug'];
            // Handle nested slugs (e.g., legal/accessibility-statement)
            if (strpos($slug, '/') !== false) {
                $parts = explode('/', $slug);
                $parent_slug = $parts[0];
                $child_slug = $parts[1];
                $parent_page = get_page_by_path($parent_slug);
                if (!$parent_page) {
                    $parent_id = wp_insert_post([
                        'post_title' => ucfirst($parent_slug),
                        'post_name' => $parent_slug,
                        'post_status' => 'publish',
                        'post_type' => 'page',
                    ]);
                    $parent = $parent_id;
                } else {
                    $parent = $parent_page->ID;
                }
                $slug = $child_slug;
            }
            $id = wp_insert_post([
                'post_title' => $title,
                'post_name' => $slug,
                'post_content' => $data['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_parent' => $parent,
            ]);
            if ($id) $created[] = $title;
        }
    }
    if ($created) {
        add_action('admin_notices', function() use ($created) {
            echo '<div class="notice notice-success"><p>';
            echo esc_html__('Created pages: ', 'authority-blueprint-mcp') . implode(', ', $created) . '.';
            echo '</p></div>';
        });
    }
});

// === Lovable UI Base Integration ===
function enqueue_lovable_assets() {
    wp_enqueue_style('lovable-base', get_template_directory_uri() . '/css/lovable/base.css');
    wp_enqueue_style('lovable-components', get_template_directory_uri() . '/css/lovable/components.css');
    wp_enqueue_script('lovable-interactions', get_template_directory_uri() . '/js/lovable/interactions.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('lovable-hero', get_template_directory_uri() . '/css/lovable/hero.css');
}
add_action('wp_enqueue_scripts', 'enqueue_lovable_assets', 15); 