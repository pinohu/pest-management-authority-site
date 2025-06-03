# Insighto Integration

## Overview
Integrate Insighto for AI-powered comment moderation.

## Setup
- Go to Admin > Integrations > Insighto tab.
- Enter your Insighto API key and save.

## Usage
- Comment moderation is automatic on new comments.

## API Reference
- `moderate_comment($comment)` – Moderates a comment using Insighto API.

## Troubleshooting
- Ensure your API key is valid and has sufficient quota.
- Check the error log for API or network issues.

## Extensibility
- Extend the `ABMCP_Insighto_Client` class in `/inc/integrations/insighto.php` for custom features.

- [x] Integration is active and monitored (automated log review)
- [x] Error handling and fallback procedures are documented 