<?php
/**
 * Accessible FAQ Accordion Partial
 * @package Authority_Blueprint_MCP
 */
?>
<section class="faq-accordion" role="region" aria-label="<?php esc_attr_e('FAQ', 'authority-blueprint-mcp'); ?>">
  <h2><?php esc_html_e('Frequently Asked Questions', 'authority-blueprint-mcp'); ?></h2>
  <div class="accordion" id="faqAccordion">
    <div class="accordion-item">
      <h3 class="accordion-header">
        <button class="accordion-button" aria-expanded="false" aria-controls="faq1" id="faq1-header">
          <?php esc_html_e('What is the Authority Blueprint MCP theme?', 'authority-blueprint-mcp'); ?>
        </button>
      </h3>
      <div class="accordion-panel" id="faq1" role="region" aria-labelledby="faq1-header" aria-hidden="true">
        <p><?php esc_html_e('It is a modern, accessible, automation-ready WordPress theme for authority sites.', 'authority-blueprint-mcp'); ?></p>
      </div>
    </div>
    <div class="accordion-item">
      <h3 class="accordion-header">
        <button class="accordion-button" aria-expanded="false" aria-controls="faq2" id="faq2-header">
          <?php esc_html_e('How do I use the OpenAI content generator?', 'authority-blueprint-mcp'); ?>
        </button>
      </h3>
      <div class="accordion-panel" id="faq2" role="region" aria-labelledby="faq2-header" aria-hidden="true">
        <p><?php esc_html_e('Enter a prompt in the form and submit to generate content using OpenAI.', 'authority-blueprint-mcp'); ?></p>
      </div>
    </div>
    <div class="accordion-item">
      <h3 class="accordion-header">
        <button class="accordion-button" aria-expanded="false" aria-controls="faq3" id="faq3-header">
          <?php esc_html_e('How do I configure API integrations?', 'authority-blueprint-mcp'); ?>
        </button>
      </h3>
      <div class="accordion-panel" id="faq3" role="region" aria-labelledby="faq3-header" aria-hidden="true">
        <p><?php esc_html_e('Go to Theme Settings > API Integrations to enter your API keys.', 'authority-blueprint-mcp'); ?></p>
      </div>
    </div>
  </div>
</section> 