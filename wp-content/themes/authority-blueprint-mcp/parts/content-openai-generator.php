<?php
/**
 * OpenAI Content Generator Partial
 * @package Authority_Blueprint_MCP
 */
?>
<section class="openai-generator" role="region" aria-label="<?php esc_attr_e('AI Content Generator', 'authority-blueprint-mcp'); ?>">
  <h2><?php esc_html_e('AI Content Generator', 'authority-blueprint-mcp'); ?></h2>
  <form id="openai-content-form" class="openai-content-form" method="post" action="#" autocomplete="off">
    <label for="openai-prompt" class="screen-reader-text"><?php esc_html_e('Enter your prompt', 'authority-blueprint-mcp'); ?></label>
    <textarea id="openai-prompt" name="openai_prompt" rows="4" placeholder="<?php esc_attr_e('Type your prompt here...', 'authority-blueprint-mcp'); ?>" required style="width:100%;max-width:600px;"></textarea>
    <button type="submit" class="btn btn-primary" style="margin-top:1rem;">
      <?php esc_html_e('Generate Content', 'authority-blueprint-mcp'); ?>
    </button>
  </form>
  <div id="openai-content-result" class="openai-content-result" aria-live="polite" style="margin-top:1.5rem;"></div>
</section> 