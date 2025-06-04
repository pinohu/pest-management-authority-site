# Reoon Integration

## Overview

Integrate Reoon for email verification and enrichment.

## Setup

- Go to Admin > Integrations > Reoon tab.
- Enter your Reoon API key and save.

## Usage

- Use email verification in admin tools.

## API Reference

- `verify_email($email)` – Verifies an email address using Reoon API.

## Troubleshooting

- Ensure your API key is valid and has sufficient quota.
- Check the error log for API or network issues.

## Extensibility

- Extend the `ABMCP_Reoon_Client` class in `/inc/integrations/reoon.php` for custom features.

- [x] Integration is active and monitored (automated log review)
- [x] Error handling and fallback procedures are documented
