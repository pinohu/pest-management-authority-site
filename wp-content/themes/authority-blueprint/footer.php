<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Authority_Blueprint
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer-content">
				
				<div class="footer-section">
					<h3><?php esc_html_e('About Pest Management Science', 'authority-blueprint'); ?></h3>
					<p><?php esc_html_e('Leading the way in sustainable pest management solutions through research, innovation, and education.', 'authority-blueprint'); ?></p>
					<div class="footer-social">
						<a href="#" aria-label="<?php esc_attr_e('Follow us on Twitter', 'authority-blueprint'); ?>">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
								<path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
							</svg>
						</a>
						<a href="#" aria-label="<?php esc_attr_e('Follow us on LinkedIn', 'authority-blueprint'); ?>">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
								<path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
								<circle cx="4" cy="4" r="2"/>
							</svg>
						</a>
						<a href="#" aria-label="<?php esc_attr_e('Follow us on YouTube', 'authority-blueprint'); ?>">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
								<path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"/>
								<polygon points="9.75,15.02 15.5,11.75 9.75,8.48"/>
							</svg>
						</a>
					</div>
				</div>

				<div class="footer-section">
					<h3><?php esc_html_e('Research Areas', 'authority-blueprint'); ?></h3>
					<ul>
						<li><a href="#"><?php esc_html_e('Integrated Pest Management', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Biological Control', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Pesticide Safety', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Sustainable Agriculture', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Urban Pest Management', 'authority-blueprint'); ?></a></li>
					</ul>
				</div>

				<div class="footer-section">
					<h3><?php esc_html_e('Resources', 'authority-blueprint'); ?></h3>
					<ul>
						<li><a href="#"><?php esc_html_e('Research Publications', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Best Practices Guide', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Training Materials', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Industry Standards', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Professional Directory', 'authority-blueprint'); ?></a></li>
					</ul>
				</div>

				<div class="footer-section">
					<h3><?php esc_html_e('Connect', 'authority-blueprint'); ?></h3>
					<ul>
						<li><a href="#"><?php esc_html_e('Contact Us', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Newsletter', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Events & Conferences', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Professional Network', 'authority-blueprint'); ?></a></li>
						<li><a href="#"><?php esc_html_e('Support', 'authority-blueprint'); ?></a></li>
					</ul>
				</div>

			</div><!-- .footer-content -->

			<div class="footer-bottom">
				<div class="footer-copyright">
					<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'authority-blueprint'); ?></p>
				</div>
				
				<nav class="footer-navigation" aria-label="<?php esc_attr_e('Footer menu', 'authority-blueprint'); ?>">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 1,
					));
					?>
				</nav>
			</div><!-- .footer-bottom -->

		</div><!-- .container -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html> 