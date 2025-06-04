# Automation & MCP Monitoring Checklist

## Daily

- [x] Confirm all Authority Utilities plugins are active (automated script)
- [x] Check for failed backups in `wp-content/backups/` (automated alert)
- [x] Review Pulsetic (or similar) uptime/performance alerts (automated integration)
- [x] Monitor for flagged stale content in WP Admin (automated flagging)
- [x] Check for new plugin or WordPress core updates (automated check)

## Weekly

- [x] Review Google Analytics/Search Console for traffic and SEO issues (automated API check)
- [x] Check MCP integration logs (AltText.ai, Insighto.ai, NEURONWriter) (automated log review)
- [x] Test comment moderation and alt text generation (automated test)
- [x] Review scheduled tasks (WP-Cron) for failures (automated monitoring)
- [x] Validate backup files and test restore on staging (automated restore test)

## Monthly

- [x] Audit plugin and theme security (WPScan or similar, automated)
- [x] Review automation and workflow documentation in `docs/automation.md` (manual, scheduled)
- [x] Update API keys and credentials if needed (manual, scheduled)
- [x] Review and update editorial calendar and recurring tasks (manual, scheduled)
- [x] Conduct a full backup and offsite/cloud sync (automated)
- [x] Review and update `docs/lessons-learned.md` (manual, scheduled)

## Escalation Procedures

- [x] Automated alerts for any failed checks or errors (email/SMS/Slack)
- [x] Document all incidents and responses in `docs/lessons-learned.md`
- [x] Review and update all automation scripts quarterly
