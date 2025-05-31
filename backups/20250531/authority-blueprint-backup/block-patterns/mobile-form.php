<?php
/**
 * Block Pattern: Mobile-First Form
 * Description: Accessible, mobile-first form section for authority sites.
 */
?>
<!-- wp:group {"className":"mobile-first-form-section"} -->
<div class="wp-block-group mobile-first-form-section" aria-label="Contact Form">
	<form class="mobile-first-form" action="#" method="post">
		<div class="form-group">
			<label for="name">Full Name</label>
			<input type="text" id="name" name="name" required />
		</div>
		<div class="form-group">
			<label for="email">Email Address</label>
			<input type="email" id="email" name="email" required />
		</div>
		<div class="form-group">
			<label for="phone">Phone Number</label>
			<input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" />
		</div>
		<div class="form-group">
			<label for="message">Message</label>
			<textarea id="message" name="message" rows="4"></textarea>
		</div>
		<button type="submit" class="submit-button">Send Message</button>
	</form>
</div>
<!-- /wp:group --> 