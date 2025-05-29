# Pest Management Science Developer Guide

## Theme Structure
- All core files are in `wp-content/themes/authority-blueprint/`.
- Assets: `/css/`, `/js/`, `/images/`, `/block-patterns/`, `/languages/`, `/tests/`.
- Legal: `/legal/` for compliance docs.

## Coding Standards
- Follow WordPress PHP coding standards.
- Use semantic HTML5 and ARIA for accessibility.
- Write mobile-first, responsive CSS for pest management science.
- Use block patterns for reusable layouts.
- JS: Use vanilla JS or enqueue scripts properly.

## Testing & QA
- Run PHPUnit tests: `vendor/bin/phpunit`.
- Run JS tests: `npx jest`.
- Use Docker Compose for local dev: `docker-compose up`.
- CI runs on GitHub Actions (`.github/workflows/ci.yml`).

## Contributions
- Fork the repo and create a feature branch.
- Follow the PR template and reference issues.
- Run all tests before submitting a PR.

## Extending
- Add new block patterns in `/block-patterns/` for pest management layouts.
- Add translations in `/languages/`.
- Add utilities in the `authority-utilities` plugin. 