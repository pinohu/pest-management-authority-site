# Automation & MCP Setup Instructions

## 1. Plugin Activation
- Activate all Authority Utilities plugins in WP Admin > Plugins or via WP-CLI:
  ```sh
  wp plugin activate authority-utilities/auto-alt-text.php authority-utilities/ai-comment-moderation.php authority-utilities/schema-automation.php authority-utilities/internal-linking.php authority-utilities/image-optimization.php authority-utilities/social-sharing-cards.php authority-utilities/content-freshness.php authority-utilities/backup-scheduler.php
  ```

## 2. API Key Setup
- Obtain API keys for:
  - AltText.ai
  - Insighto.ai
  - NEURONWriter
  - Pulsetic
  - UpViral
  - Agiled/Nifty
- Add keys to plugin settings or `wp-config.php` as needed.

## 3. Scheduling & Cron
- Ensure WP-Cron is enabled for scheduled tasks (backups, content freshness).
- For reliability, set up a real cron job to hit `wp-cron.php` regularly.

## 4. Monitoring & Alerts
- Configure Pulsetic or similar for uptime/performance monitoring.
- Set up email/SMS/Slack alerts for downtime or failed backups.

## 5. Documentation & Reporting
- Review `docs/automation.md` for automation summary.
- Sync documentation and analytics to Google Docs/Sheets as needed.

## 6. Backup & Restore
- Test backup/restore process after setup.
- Store backups offsite/cloud for redundancy.

## 7. Editorial Workflow
- Set up Agiled/Nifty/SuiteDash for editorial calendar and content review.
- Schedule recurring tasks for audits and reviews.

## 8. Internationalization
- Integrate Google Translate API or WPML/Polylang for translation workflows.

## 9. Continuous Improvement
- Review automations and workflows quarterly.
- Update `docs/lessons-learned.md` with fixes and improvements. 