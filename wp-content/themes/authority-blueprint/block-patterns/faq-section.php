<?php
/**
 * Block Pattern: FAQ Section
 * Description: Accessible, mobile-first FAQ accordion with ARIA and keyboard navigation.
 */
?>
<!-- wp:group {"className":"faq-section"} -->
<div class="wp-block-group faq-section" aria-label="Frequently Asked Questions">
	<!-- wp:heading {"level":2} -->
	<h2>Frequently Asked Questions</h2>
	<!-- /wp:heading -->
	<!-- wp:group {"className":"faq-list"} -->
	<div class="wp-block-group faq-list" role="list">
		<!-- FAQ Item 1 -->
		<div class="faq-item" role="listitem">
			<button class="faq-question" aria-expanded="false" aria-controls="faq1-answer" id="faq1-question">
				What is Authority Blueprint?
			</button>
			<div class="faq-answer" id="faq1-answer" role="region" aria-labelledby="faq1-question" hidden>
				<p>Authority Blueprint is a comprehensive, mobile-first WordPress theme designed for scalable, SEO-optimized authority sites.</p>
			</div>
		</div>
		<!-- FAQ Item 2 -->
		<div class="faq-item" role="listitem">
			<button class="faq-question" aria-expanded="false" aria-controls="faq2-answer" id="faq2-question">
				How do I customize the theme?
			</button>
			<div class="faq-answer" id="faq2-answer" role="region" aria-labelledby="faq2-question" hidden>
				<p>You can customize the theme using the WordPress block editor, FSE templates, and by adding your own block patterns or child themes.</p>
			</div>
		</div>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  var faqButtons = document.querySelectorAll('.faq-question');
  faqButtons.forEach(function(btn) {
    btn.addEventListener('click', function() {
      var expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', !expanded);
      var answer = document.getElementById(btn.getAttribute('aria-controls'));
      if (answer) {
        answer.hidden = expanded;
      }
      // Collapse others
      faqButtons.forEach(function(otherBtn) {
        if (otherBtn !== btn) {
          otherBtn.setAttribute('aria-expanded', 'false');
          var otherAnswer = document.getElementById(otherBtn.getAttribute('aria-controls'));
          if (otherAnswer) otherAnswer.hidden = true;
        }
      });
    });
    btn.addEventListener('keydown', function(e) {
      if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
        e.preventDefault();
        var idx = Array.prototype.indexOf.call(faqButtons, btn);
        var nextIdx = e.key === 'ArrowDown' ? idx + 1 : idx - 1;
        if (nextIdx >= 0 && nextIdx < faqButtons.length) {
          faqButtons[nextIdx].focus();
        }
      }
    });
  });
});
</script> 