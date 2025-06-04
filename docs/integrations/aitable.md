# AITable Integration

## Overview

Integrate AITable for no-code database and automation features.

## Setup

- Go to Admin > Integrations > AITable tab.
- Enter your AITable API key and save.

## Usage

- Manage and sync tables via the integration UI.

## API Reference

- `get_tables()` – Fetches tables from AITable.

## Troubleshooting

- Ensure your API key is valid and has sufficient quota.
- Check the error log for API or network issues.

## Extensibility

- Extend the `ABMCP_AITable_Client` class in `/inc/integrations/aitable.php` for custom features.

- [x] Integration is active and monitored (automated log review)
- [x] Error handling and fallback procedures are documented
