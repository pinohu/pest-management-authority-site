<?php
/**
 * Pest Research Publications Widget
 *
 * @package Authority_Blueprint
 */

class Pest_Research_Widget extends WP_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			'pest_research_widget',
			esc_html__('Pest Research Publications', 'authority-blueprint'),
			array(
				'description' => esc_html__('Display recent pest management research publications.', 'authority-blueprint'),
			)
		);
	}

	/**
	 * Widget output
	 */
	public function widget($args, $instance) {
		echo $args['before_widget'];
		
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('Recent Research', 'authority-blueprint');
		$limit = !empty($instance['limit']) ? $instance['limit'] : 5;
		
		echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
		
		$research_posts = new WP_Query(array(
			'post_type'      => array('post', 'pillar', 'cluster', 'resource'),
			'posts_per_page' => $limit,
			'post_status'    => 'publish',
			'meta_query'     => array(
				array(
					'key'     => 'research_type',
					'compare' => 'EXISTS',
				),
			),
		));
		
		if ($research_posts->have_posts()) : ?>
			<div class="pest-research-list">
				<?php while ($research_posts->have_posts()) : $research_posts->the_post(); ?>
					<article class="research-item">
						<?php if (has_post_thumbnail()) : ?>
							<div class="research-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('sidebar-thumb'); ?>
								</a>
							</div>
						<?php endif; ?>
						
						<div class="research-content">
							<h4 class="research-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h4>
							
							<div class="research-meta">
								<span class="research-date">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
										<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
										<line x1="16" y1="2" x2="16" y2="6"></line>
										<line x1="8" y1="2" x2="8" y2="6"></line>
										<line x1="3" y1="10" x2="21" y2="10"></line>
									</svg>
									<?php echo get_the_date(); ?>
								</span>
								
								<?php
								$research_type = get_post_meta(get_the_ID(), 'research_type', true);
								if ($research_type) : ?>
									<span class="research-type badge badge-outline">
										<?php echo esc_html($research_type); ?>
									</span>
								<?php endif; ?>
							</div>
							
							<div class="research-excerpt">
								<?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			
			<div class="research-more">
				<a href="<?php echo esc_url(home_url('/research/')); ?>" class="btn btn-secondary btn-sm">
					<?php esc_html_e('View All Research', 'authority-blueprint'); ?>
				</a>
			</div>
		<?php
		else :
			echo '<p>' . esc_html__('No research publications found.', 'authority-blueprint') . '</p>';
		endif;
		
		wp_reset_postdata();
		
		echo $args['after_widget'];
	}

	/**
	 * Widget form
	 */
	public function form($instance) {
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('Recent Research', 'authority-blueprint');
		$limit = !empty($instance['limit']) ? $instance['limit'] : 5;
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
				<?php esc_attr_e('Title:', 'authority-blueprint'); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
				   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" 
				   value="<?php echo esc_attr($title); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('limit')); ?>">
				<?php esc_attr_e('Number of posts to show:', 'authority-blueprint'); ?>
			</label>
			<input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" 
				   name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="number" 
				   step="1" min="1" value="<?php echo esc_attr($limit); ?>" size="3">
		</p>
		<?php
	}

	/**
	 * Update widget
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
		$instance['limit'] = (!empty($new_instance['limit'])) ? (int) $new_instance['limit'] : 5;
		
		return $instance;
	}
}

/**
 * Register the widget
 */
function register_pest_research_widget() {
	register_widget('Pest_Research_Widget');
}
add_action('widgets_init', 'register_pest_research_widget');
?> 