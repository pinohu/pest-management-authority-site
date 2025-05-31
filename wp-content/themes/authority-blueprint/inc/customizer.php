<?php
/**
 * Authority Blueprint Theme Customizer
 *
 * @package Authority_Blueprint
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function authority_blueprint_customize_register($wp_customize) {
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'authority_blueprint_customize_partial_blogname',
		));
		$wp_customize->selective_refresh->add_partial('blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'authority_blueprint_customize_partial_blogdescription',
		));
	}

	// Add Pest Management Science section
	$wp_customize->add_section('pest_management_section', array(
		'title'    => __('Pest Management Options', 'authority-blueprint'),
		'priority' => 30,
	));

	// Hero section title
	$wp_customize->add_setting('hero_title', array(
		'default'           => 'Advancing Pest Management Science',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('hero_title', array(
		'label'   => __('Hero Section Title', 'authority-blueprint'),
		'section' => 'pest_management_section',
		'type'    => 'text',
	));

	// Hero section description
	$wp_customize->add_setting('hero_description', array(
		'default'           => 'Leading research, innovation, and education in sustainable pest management solutions for agriculture, urban environments, and public health.',
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('hero_description', array(
		'label'   => __('Hero Section Description', 'authority-blueprint'),
		'section' => 'pest_management_section',
		'type'    => 'textarea',
	));

	// Primary color
	$wp_customize->add_setting('primary_color', array(
		'default'           => '#388e3c',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
		'label'   => __('Primary Color', 'authority-blueprint'),
		'section' => 'pest_management_section',
	)));

	// Secondary color
	$wp_customize->add_setting('secondary_color', array(
		'default'           => '#795548',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
		'label'   => __('Secondary Color', 'authority-blueprint'),
		'section' => 'pest_management_section',
	)));

	// Add selective refresh for hero content
	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial('hero_title', array(
			'selector'        => '.hero-title',
			'render_callback' => 'authority_blueprint_customize_partial_hero_title',
		));
		
		$wp_customize->selective_refresh->add_partial('hero_description', array(
			'selector'        => '.hero-description',
			'render_callback' => 'authority_blueprint_customize_partial_hero_description',
		));
	}
}
add_action('customize_register', 'authority_blueprint_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function authority_blueprint_customize_partial_blogname() {
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function authority_blueprint_customize_partial_blogdescription() {
	bloginfo('description');
}

/**
 * Render the hero title for the selective refresh partial.
 *
 * @return void
 */
function authority_blueprint_customize_partial_hero_title() {
	return get_theme_mod('hero_title', 'Advancing Pest Management Science');
}

/**
 * Render the hero description for the selective refresh partial.
 *
 * @return void
 */
function authority_blueprint_customize_partial_hero_description() {
	return get_theme_mod('hero_description', 'Leading research, innovation, and education in sustainable pest management solutions for agriculture, urban environments, and public health.');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function authority_blueprint_customize_preview_js() {
	wp_enqueue_script('authority-blueprint-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '1.0.0', true);
}
add_action('customize_preview_init', 'authority_blueprint_customize_preview_js');

/**
 * Output custom CSS for customizer settings
 */
function authority_blueprint_customizer_css() {
	$primary_color = get_theme_mod('primary_color', '#388e3c');
	$secondary_color = get_theme_mod('secondary_color', '#795548');
	
	if ($primary_color !== '#388e3c' || $secondary_color !== '#795548') {
		?>
		<style type="text/css">
			:root {
				--color-primary: <?php echo esc_attr($primary_color); ?>;
				--color-secondary: <?php echo esc_attr($secondary_color); ?>;
			}
		</style>
		<?php
	}
}
add_action('wp_head', 'authority_blueprint_customizer_css'); 