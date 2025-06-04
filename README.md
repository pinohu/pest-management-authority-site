# Authority Blueprint MCP Theme

## Integrations Overview

This theme supports modular, production-grade integrations with leading SaaS and automation tools. All integrations are managed under a unified "Integrations" admin menu with tabbed navigation for easy access and configuration.

### Available Integrations

- **OpenAI**: Content generation and AI-powered features.
- **AITable**: No-code database and automation.
- **Reoon**: Email verification and enrichment.
- **Insighto**: AI-powered comment moderation.
- **NeuronWriter**: Content optimization and SEO suggestions.

### Setup Instructions

1. Go to **Admin > Integrations**.
2. Click the tab for the integration you want to configure.
3. Enter your API key and save.
4. Use the integration features as described below.

### Usage & Troubleshooting

#### OpenAI

- **Setup**: Enter your OpenAI API key in the OpenAI tab.
- **Usage**: Use the content generator REST API or admin UI blocks.
- **Troubleshooting**: Ensure your API key is valid. Check logs for errors.

#### AITable

- **Setup**: Enter your AITable API key.
- **Usage**: Sync and manage tables via the integration UI.
- **Troubleshooting**: API errors are logged. Check credentials and network.

#### Reoon

- **Setup**: Enter your Reoon API key.
- **Usage**: Email verification is available in admin tools.
- **Troubleshooting**: Invalid API keys or quota issues will be logged.

#### Insighto

- **Setup**: Enter your Insighto API key.
- **Usage**: Comment moderation is automatic on new comments.
- **Troubleshooting**: Check logs for moderation errors.

#### NeuronWriter

- **Setup**: Enter your NeuronWriter API key.
- **Usage**: Content suggestions appear in the post editor sidebar.
- **Troubleshooting**: Ensure API key is active and check logs for issues.

### Modularization

All integrations are located in `/inc/integrations/` and follow a common API client and admin UI pattern. This ensures maintainability, extensibility, and easy upgrades.

### Unified Admin UI

- All integrations are accessible under a single parent menu.
- Tabbed navigation provides a seamless experience.
- Real-time API key validation and error feedback are planned for future updates.

---

For further help, see `/docs/integrations/` or contact the theme developer.
