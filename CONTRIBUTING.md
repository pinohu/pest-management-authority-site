# Contributing to Authority Blueprint MCP Theme

## Branch Structure

- **main**: Production-ready, stable theme. Only merged via PR from develop or hotfix branches.
- **develop**: Integration branch for all new features and fixes. PRs from feature branches are merged here.
- **feature/lovable-components**: All Lovable.dev design exports and integration work.
- **feature/wordpress-integration**: All Cursor AI and WordPress-specific integration work.

## Branch Protection Rules

- **main**:
  - Protected: No direct pushes.
  - Require PR review and passing CI before merge.
  - Require up-to-date with develop before merge.
- **develop**:
  - Protected: No direct pushes.
  - Require PR review and passing CI before merge.
- **feature/** branches:
  - Open PRs to develop. No direct pushes to main or develop.

## Pull Request Workflow

1. Create a feature branch from develop (e.g., `feature/my-feature`).
2. Commit and push your changes.
3. Open a PR to develop (or main for hotfixes).
4. Ensure all CI checks pass.
5. Request review from at least one team member.
6. Only merge after approval and passing checks.

## Code Quality & CI

- All code must pass CI (linting, tests) before merge.
- Use semantic PR titles (e.g., `feat: add lovable hero section`).
- Keep commits focused and atomic.

## Directory Structure for Design Integration

- `/lovable-designs/components/`: Individual Lovable components.
- `/lovable-designs/exports/`: Exported design assets.
- `/lovable-designs/docs/`: Documentation for design system and integration.

## General Guidelines

- Keep main stable and production-ready at all times.
- Use develop for all integration and testing.
- Use feature branches for all new work.
- Keep design and code assets organized and documented.
