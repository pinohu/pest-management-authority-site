# Automation & MCP Monitoring Checklist

## Daily
- [ ] Confirm all Authority Utilities plugins are active
- [ ] Check for failed backups in `wp-content/backups/`
- [ ] Review Pulsetic (or similar) uptime/performance alerts
- [ ] Monitor for flagged stale content in WP Admin
- [ ] Check for new plugin or WordPress core updates

## Weekly
- [ ] Review Google Analytics/Search Console for traffic and SEO issues
- [ ] Check MCP integration logs (AltText.ai, Insighto.ai, NEURONWriter)
- [ ] Test comment moderation and alt text generation
- [ ] Review scheduled tasks (WP-Cron) for failures
- [ ] Validate backup files and test restore on staging

## Monthly
- [ ] Audit plugin and theme security (WPScan or similar)
- [ ] Review automation and workflow documentation in `docs/automation.md`
- [ ] Update API keys and credentials if needed
- [ ] Review and update editorial calendar and recurring tasks
- [ ] Conduct a full backup and offsite/cloud sync
- [ ] Review and update `docs/lessons-learned.md` 