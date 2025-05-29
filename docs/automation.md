# Automation, Plugins, and MCP Integrations

## Authority Utilities Plugins
- **Auto Alt Text**: Generates alt text for images using AltText.ai
- **AI Comment Moderation**: Moderates comments using Insighto.ai
- **Schema Automation**: Injects schema.org JSON-LD markup
- **Internal Linking**: Suggests and inserts internal links
- **Image Optimization**: Generates WebP/AVIF images
- **Social Sharing Cards**: Adds Open Graph/Twitter meta tags
- **Content Freshness**: Flags stale content for review
- **Backup Scheduler**: Schedules daily backups

## MCP Integrations
- **AltText.ai**: Image alt text automation
- **Insighto.ai**: Comment moderation
- **NEURONWriter**: SEO audits/content optimization
- **Pulsetic**: Uptime/performance monitoring
- **UpViral**: Newsletter/engagement automation
- **Agiled/Nifty**: Editorial workflow automation
- **Google Docs/Sheets**: Documentation/reporting

## Monitoring & Extending
- Review plugin settings in WP Admin > Plugins > Authority Utilities
- Check scheduled tasks (WP-Cron) for backup/content freshness
- Monitor analytics in Google Analytics/Search Console
- Review automation logs in `wp-content/backups/` and plugin logs

## Troubleshooting
- Ensure API keys are set for MCP integrations
- Check file permissions for `wp-content/backups/`
- Review WP-Cron status for scheduled tasks
- See plugin readmes for extension points 