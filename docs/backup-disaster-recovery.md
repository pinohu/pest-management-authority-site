# Backup & Disaster Recovery

## Backups

- [x] Schedule daily backups (automated)
- [x] Automate offsite/cloud syncs (e.g., AWS S3, Google Drive)

## Restore Tests

- [x] Schedule monthly restore tests on staging (automated)
- [x] Document all restore test results

## Backup Validation

- [ ] Confirm daily backups are created in `wp-content/backups/`
- [ ] Check backup file integrity (file size, corruption)
- [ ] Store backup logs for audit

## Restore Testing

- [ ] Test restore process on staging environment monthly
- [ ] Document restore steps and issues
- [ ] Validate restored site for completeness and functionality

## Offsite/Cloud Sync

- [ ] Sync backups to offsite/cloud storage (e.g., Google Drive, S3)
- [ ] Automate sync with cron or backup plugin
- [ ] Confirm offsite backups are accessible and up-to-date

## Monitoring & Alerts

- [ ] Set up alerts for failed backups or restores
- [ ] Review backup logs weekly

## Continuous Improvement

- [ ] Review backup/disaster recovery process quarterly
- [ ] Update workflow and documentation as needed
- [ ] Document issues and fixes in `docs/lessons-learned.md`
