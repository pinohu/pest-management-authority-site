<?php
/**
 * Custom Shortcodes for Authority Blueprint
 *
 * @package Authority_Blueprint
 */

// Prevent direct access
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Research Card Shortcode
 * 
 * Usage: [research_card id="123" layout="horizontal"]
 */
function authority_blueprint_research_card_shortcode($atts) {
	$atts = shortcode_atts(array(
		'id'     => '',
		'layout' => 'vertical', // vertical, horizontal
		'show_excerpt' => 'true',
		'show_meta' => 'true',
	), $atts, 'research_card');
	
	if (empty($atts['id'])) {
		return '<p class="shortcode-error">Research card ID is required.</p>';
	}
	
	$post = get_post($atts['id']);
	if (!$post) {
		return '<p class="shortcode-error">Research post not found.</p>';
	}
	
	$layout_class = 'research-card research-card-' . esc_attr($atts['layout']);
	
	ob_start();
	?>
	<div class="<?php echo esc_attr($layout_class); ?>">
		<?php if (has_post_thumbnail($post->ID)) : ?>
			<div class="research-card-image">
				<a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
					<?php echo get_the_post_thumbnail($post->ID, 'card-thumbnail'); ?>
				</a>
			</div>
		<?php endif; ?>
		
		<div class="research-card-content">
			<h3 class="research-card-title">
				<a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
					<?php echo esc_html($post->post_title); ?>
				</a>
			</h3>
			
			<?php if ($atts['show_meta'] === 'true') : ?>
				<div class="research-card-meta">
					<span class="research-date">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
							<line x1="16" y1="2" x2="16" y2="6"></line>
							<line x1="8" y1="2" x2="8" y2="6"></line>
							<line x1="3" y1="10" x2="21" y2="10"></line>
						</svg>
						<?php echo get_the_date('', $post->ID); ?>
					</span>
					
					<?php
					$research_type = get_post_meta($post->ID, 'research_type', true);
					if ($research_type) : ?>
						<span class="research-type badge"><?php echo esc_html($research_type); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			<?php if ($atts['show_excerpt'] === 'true') : ?>
				<div class="research-card-excerpt">
					<?php echo wp_trim_words(get_the_excerpt($post->ID), 20, '...'); ?>
				</div>
			<?php endif; ?>
			
			<div class="research-card-actions">
				<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="btn btn-primary btn-sm">
					<?php esc_html_e('Read More', 'authority-blueprint'); ?>
				</a>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('research_card', 'authority_blueprint_research_card_shortcode');

/**
 * Control Methods Showcase Shortcode
 * 
 * Usage: [control_methods columns="3"]
 */
function authority_blueprint_control_methods_shortcode($atts) {
	$atts = shortcode_atts(array(
		'columns' => '3',
		'show_icons' => 'true',
	), $atts, 'control_methods');
	
	$control_methods = array(
		'biological' => array(
			'title' => 'Biological Control',
			'description' => 'Using natural enemies to control pest populations.',
			'icon' => '🦋',
			'examples' => array('Predatory insects', 'Parasitoids', 'Microbial agents')
		),
		'chemical' => array(
			'title' => 'Chemical Control', 
			'description' => 'Strategic use of pesticides for targeted pest management.',
			'icon' => '🧪',
			'examples' => array('Selective pesticides', 'Pheromone traps', 'Growth regulators')
		),
		'cultural' => array(
			'title' => 'Cultural Control',
			'description' => 'Agricultural practices that reduce pest problems.',
			'icon' => '🌱',
			'examples' => array('Crop rotation', 'Resistant varieties', 'Sanitation')
		),
		'mechanical' => array(
			'title' => 'Mechanical Control',
			'description' => 'Physical methods to prevent or eliminate pests.',
			'icon' => '🔧',
			'examples' => array('Barriers', 'Traps', 'Cultivation practices')
		),
		'integrated' => array(
			'title' => 'Integrated Pest Management',
			'description' => 'Combining multiple strategies for sustainable control.',
			'icon' => '⚖️',
			'examples' => array('Monitoring', 'Thresholds', 'Multiple tactics')
		),
	);
	
	$columns_class = 'control-methods-grid columns-' . esc_attr($atts['columns']);
	
	ob_start();
	?>
	<div class="control-methods-showcase">
		<div class="<?php echo esc_attr($columns_class); ?>">
			<?php foreach ($control_methods as $key => $method) : ?>
				<div class="control-method-card">
					<?php if ($atts['show_icons'] === 'true') : ?>
						<div class="method-icon">
							<?php echo $method['icon']; ?>
						</div>
					<?php endif; ?>
					
					<div class="method-content">
						<h4 class="method-title"><?php echo esc_html($method['title']); ?></h4>
						<p class="method-description"><?php echo esc_html($method['description']); ?></p>
						
						<ul class="method-examples">
							<?php foreach ($method['examples'] as $example) : ?>
								<li><?php echo esc_html($example); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('control_methods', 'authority_blueprint_control_methods_shortcode');

/**
 * Expert Profile Shortcode
 * 
 * Usage: [expert_profile user_id="5" layout="card"]
 */
function authority_blueprint_expert_profile_shortcode($atts) {
	$atts = shortcode_atts(array(
		'user_id' => '',
		'layout'  => 'card', // card, inline
		'show_bio' => 'true',
		'show_contact' => 'false',
	), $atts, 'expert_profile');
	
	if (empty($atts['user_id'])) {
		return '<p class="shortcode-error">Expert user ID is required.</p>';
	}
	
	$user = get_userdata($atts['user_id']);
	if (!$user) {
		return '<p class="shortcode-error">Expert not found.</p>';
	}
	
	$layout_class = 'expert-profile expert-profile-' . esc_attr($atts['layout']);
	
	ob_start();
	?>
	<div class="<?php echo esc_attr($layout_class); ?>">
		<div class="expert-avatar">
			<?php echo get_avatar($user->ID, 120); ?>
		</div>
		
		<div class="expert-info">
			<h4 class="expert-name"><?php echo esc_html($user->display_name); ?></h4>
			
			<?php
			$title = get_user_meta($user->ID, 'professional_title', true);
			if ($title) : ?>
				<p class="expert-title"><?php echo esc_html($title); ?></p>
			<?php endif; ?>
			
			<?php
			$specialization = get_user_meta($user->ID, 'specialization', true);
			if ($specialization) : ?>
				<p class="expert-specialization">
					<strong><?php esc_html_e('Specialization:', 'authority-blueprint'); ?></strong>
					<?php echo esc_html($specialization); ?>
				</p>
			<?php endif; ?>
			
			<?php if ($atts['show_bio'] === 'true') : ?>
				<div class="expert-bio">
					<?php echo wp_kses_post(get_user_meta($user->ID, 'description', true)); ?>
				</div>
			<?php endif; ?>
			
			<?php if ($atts['show_contact'] === 'true') : ?>
				<div class="expert-contact">
					<?php if ($user->user_email) : ?>
						<a href="mailto:<?php echo esc_attr($user->user_email); ?>" class="btn btn-secondary btn-sm">
							<?php esc_html_e('Contact Expert', 'authority-blueprint'); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('expert_profile', 'authority_blueprint_expert_profile_shortcode');

/**
 * Pest Alert Shortcode
 * 
 * Usage: [pest_alert type="warning" title="Invasive Species Alert"]
 */
function authority_blueprint_pest_alert_shortcode($atts, $content = null) {
	$atts = shortcode_atts(array(
		'type'  => 'info', // info, warning, danger, success
		'title' => '',
		'icon'  => 'true',
	), $atts, 'pest_alert');
	
	$alert_class = 'pest-alert pest-alert-' . esc_attr($atts['type']);
	
	$icons = array(
		'info'    => '🐛',
		'warning' => '⚠️',
		'danger'  => '🚨',
		'success' => '✅',
	);
	
	ob_start();
	?>
	<div class="<?php echo esc_attr($alert_class); ?>">
		<?php if ($atts['icon'] === 'true' && isset($icons[$atts['type']])) : ?>
			<div class="alert-icon">
				<?php echo $icons[$atts['type']]; ?>
			</div>
		<?php endif; ?>
		
		<div class="alert-content">
			<?php if (!empty($atts['title'])) : ?>
				<h5 class="alert-title"><?php echo esc_html($atts['title']); ?></h5>
			<?php endif; ?>
			
			<div class="alert-message">
				<?php echo wp_kses_post($content); ?>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('pest_alert', 'authority_blueprint_pest_alert_shortcode');

/**
 * Research Statistics Shortcode
 * 
 * Usage: [research_stats]
 */
function authority_blueprint_research_stats_shortcode($atts) {
	$atts = shortcode_atts(array(
		'layout' => 'grid', // grid, inline
	), $atts, 'research_stats');
	
	// Get statistics
	$total_publications = wp_count_posts('post')->publish;
	$total_resources = wp_count_posts('resource')->publish;
	$total_case_studies = wp_count_posts('case_study')->publish;
	$total_researchers = count(get_users(array('role' => 'author')));
	
	$layout_class = 'research-stats research-stats-' . esc_attr($atts['layout']);
	
	ob_start();
	?>
	<div class="<?php echo esc_attr($layout_class); ?>">
		<div class="stat-item">
			<div class="stat-number"><?php echo number_format($total_publications); ?></div>
			<div class="stat-label"><?php esc_html_e('Publications', 'authority-blueprint'); ?></div>
		</div>
		
		<div class="stat-item">
			<div class="stat-number"><?php echo number_format($total_resources); ?></div>
			<div class="stat-label"><?php esc_html_e('Resources', 'authority-blueprint'); ?></div>
		</div>
		
		<div class="stat-item">
			<div class="stat-number"><?php echo number_format($total_case_studies); ?></div>
			<div class="stat-label"><?php esc_html_e('Case Studies', 'authority-blueprint'); ?></div>
		</div>
		
		<div class="stat-item">
			<div class="stat-number"><?php echo number_format($total_researchers); ?></div>
			<div class="stat-label"><?php esc_html_e('Researchers', 'authority-blueprint'); ?></div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('research_stats', 'authority_blueprint_research_stats_shortcode');
?> 