# Authority Blueprint Quickstart

## Local Setup
1. Clone the repository.
2. Run `docker-compose up` to start WordPress and MySQL locally.
3. Access WordPress at http://localhost:8080
4. Log in with the default credentials (see `docker-compose.yml` or set up your own).
5. Activate the Authority Blueprint theme.
6. Import `sample-content.xml` via Tools > Import > WordPress.

## Testing
- Run PHP tests: `vendor/bin/phpunit`
- Run JS tests: `npx jest`

## Deployment
- Push to GitHub; CI will run tests automatically.
- Deploy to your production server using your preferred method (FTP, SSH, CI/CD).

## Support
- See `user-guide.md` and `developer-guide.md` for more details. 