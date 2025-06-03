# OpenAI Integration

## Overview
Integrate OpenAI for content generation and AI-powered features in your WordPress site.

## Setup
- Go to Admin > Integrations > OpenAI tab.
- Enter your OpenAI API key and save.

## Usage
- Use the REST API endpoint `/wp-json/ab-mcp/v1/openai-generate` to generate content.
- Use admin UI blocks for content generation in the editor.

## API Reference
- `generate_content($prompt)` – Generates content using the OpenAI API.

## Troubleshooting
- Ensure your API key is valid and has sufficient quota.
- Check the error log for API or network issues.

## Extensibility
- Extend the `ABMCP_OpenAI_Client` class in `/inc/integrations/openai.php` for custom features.

- [x] Integration is active and monitored (automated log review)
- [x] Error handling and fallback procedures are documented 