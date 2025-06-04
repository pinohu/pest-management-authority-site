# Authority Blueprint MCP Theme

**Note:** This theme is now fully niche-agnostic. All demo content, directory types, and templates are generic and easily customizable for any industry or use case.

## Overview

A modern, MCP-integrated, accessible, high-performance WordPress theme for authority sites, directories, and resource hubs in any niche.

## Features

- Modern CSS Grid/Flexbox, mobile-first, responsive
- Accessibility (WCAG 2.2 AA), ARIA, skip links, focus management
- Custom post types: pillar, cluster, resource, case_study, glossary, faq, comparison, tool, testimonial, curated_list, author_expert
- Custom taxonomies: topic, audience, resource_type, and more (all generic)
- Directorist integration: modular, extensible directory types and fields
- SEO: meta tags, Open Graph, Twitter Card, JSON-LD schema, canonical, breadcrumbs
- Performance: lazy loading, WebP, font optimization, async JS, resource hints
- MCP integrations: AltText.ai (alt text), NEURONWriter (content optimization), Insighto.ai (comment moderation), Pulsetic (monitoring), a11y MCP (accessibility checks)
- **API Integrations:**
  - AiTable (dynamic directory/resources)
  - Reoon Email Verifier (email validation)
  - Acumbamail (newsletter signup/campaigns)
  - OpenAI (AI content tools)
  - Certopus (certificate automation)
  - Printful (merchandise shop)
  - Logically (Afforai) (AI Q&A/search)
  - exa.ai (AI recommendations)
  - Flowlu, Agiled, SuiteDash, Brilliant Directory (business/CRM automation)
  - Gemini, DeepSeek (AI content/search)
- Customizer: hero section, color scheme, typography
- Block patterns: FAQ, comparison, mobile, CTA, etc.
- i18n ready, legal statements included

## Setup

1. Copy the theme to `wp-content/themes/authority-blueprint-mcp`.
2. Activate in WordPress admin.
3. Install and activate Directorist plugin.
4. Add required pages (Directory, Add Listing, etc.).
5. Configure menus, widgets, and customizer settings.
6. Go to **Settings → API Integrations** to enter your API keys for all services you wish to use.

## API Integrations

- **AiTable:** Enter API key and Table ID. Use for dynamic directory/resources. Sync or display via block/shortcode.
- **Reoon Email Verifier:** Enter API key. Email validation on registration, directory, and contact forms.
- **Acumbamail:** Enter API key. Newsletter signup block/shortcode, campaign automation.
- **OpenAI:** Enter API key. AI content generation in editor or via block.
- **Certopus:** Enter API key. Generate/send certificates for events, courses, or memberships.
- **Printful:** Enter API key. Fetch and display shop products via block/shortcode.
- **Logically (Afforai):** Enter API key. AI-powered Q&A/search block/shortcode.
- **exa.ai:** Enter API key. AI-powered recommendations for content or directory.
- **Flowlu, Agiled, SuiteDash, Brilliant Directory:** Enter API keys. Sync directory data, automate business processes.
- **Gemini, DeepSeek:** Enter API keys. Use for advanced AI content/search features.

## OpenAI Content Generator

A frontend UI for AI-powered content generation is available on the front page. Enter a prompt, submit, and receive generated content via OpenAI's API.

- **Location:** Front page (below FAQ)
- **How it works:**
  - Enter a prompt in the AI Content Generator form.
  - The form submits via AJAX to `/wp-json/ab-mcp/v1/openai-generate`.
  - The backend calls OpenAI and returns the generated content.
- **API Key:**
  - Set via the theme settings page or as the `AB_OPENAI_API_KEY` environment variable.
- **Security:**
  - The endpoint is public for demo; restrict as needed for production.

## Customization

- Use the Customizer for hero, colors, and typography.
- Edit `/inc/` files for CPTs, taxonomies, and enhancements.
- Add/modify block patterns in `/block-patterns/`.
- Update `/css/` and `/js/` for custom styles/scripts.

## Development

- Follows WordPress coding standards.
- All API integrations are modular and secure.
- Add tests in `/tests/` as needed.

## License

GPL v2 or later.

## Integrations: Default Feature Scaffolds

- **AiTable:** Dynamic directory/resource sync. UI block/shortcode planned. Configure API key in theme settings.
- **Reoon:** Email validation for forms. UI widget planned. Configure API key in theme settings.
- **Acumbamail:** Newsletter signup/campaigns. UI block/shortcode planned. Configure API key in theme settings.
- **Certopus:** Certificate automation. UI block/shortcode planned. Configure API key in theme settings.
- **Printful:** Merchandise shop integration. UI block/shortcode planned. Configure API key in theme settings.
- **Logically/Afforai:** AI search/Q&A. UI block/shortcode planned. Configure API key in theme settings.
- **exa.ai:** AI recommendations. UI block/shortcode planned. Configure API key in theme settings.
- **Flowlu, Agiled, SuiteDash, Brilliant Directory:** Business/CRM automation. UI widget/shortcode planned. Configure API key in theme settings.

## Accessibility (a11y) Enhancements

- **Automated Alt Text:** Images uploaded via Media Library get alt text from AltText.ai (API key required).
- **Error Summary for Forms:** All forms display an error summary at the top, with ARIA live region and focus management.
- **Accessible FAQ Accordion:** FAQ sections use an ARIA-compliant, keyboard-navigable accordion pattern.
- **Automated a11y Testing:** On post/page save, a11y MCP audits the page and reports issues as admin notices (API key required).

## Performance Enhancements

- **WebP Image Support:** JPEG/PNG images are auto-converted to WebP for modern browsers.
- **Font Preloading & Resource Hints:** Critical fonts and MCP APIs are preloaded/preconnected for faster rendering.
- **Async/Defer JS:** Non-critical JS (navigation) is deferred for faster page load.

## SEO Enhancements

- **Automated Meta/OG/Canonical Tags:** All posts/pages output Open Graph, meta description, and canonical tags automatically.
- **FAQPage Schema:** If FAQ accordion is present, outputs FAQPage schema for rich results.

## Mobile Experience Enhancements

- **Block Patterns:** FAQ accordion, sticky CTA, and comparison cards for mobile-first layouts.
- **Responsive Images:** srcset and WebP for mobile optimization.
- **Font-size Adjustments:** Improved readability on small screens.
- **Mobile a11y Testing Reminder:** Admin notice prompts for real device accessibility testing.

## Integrations: Live Demo & Backend Logic

- **AiTable:** Directory/resource sync with live data display.
- **Reoon:** Email validation with live API check and error summary.
- **Acumbamail:** Newsletter signup with live subscription and error summary.
- **Certopus:** Certificate request with live API call and error summary.
- **Printful:** Product grid with live data from Printful API.

## Security & Internationalization

- **Security:** API keys are securely managed. For vulnerability monitoring, use WPScan or similar tools. Follow WordPress best practices for file permissions and updates.
- **Internationalization:** Theme is translation-ready (text domain: authority-blueprint-mcp). Can be extended with WPML/Polylang for multilingual sites.

## Developer Documentation

- **Extending Integrations:** Add new MCP/API integrations in /inc/ as modular PHP files. Register REST endpoints as needed.
- **Customizing Frontend Blocks:** Add or modify partials in /parts/ and register new block patterns in functions.php.
- **REST Endpoints:** All AJAX/REST endpoints are registered under /wp-json/ab-mcp/v1/.
- **API Keys:** Managed via theme settings or environment variables.

## New Features

- **Custom XML Sitemap:** All custom post types and taxonomies are included at /sitemap.xml for SEO completeness.
- **Editorial Workflow Tool:** Admin page for content calendar, review status, and audit scheduling. Accessible from the WP admin menu.

## Plug-and-Play Demo Content Automation

This theme automatically sets up all demo content (pages, menus, widgets, homepage, blog page) on activation. All demo content is now generic and can be easily customized for any niche.

- Runs once on theme activation (uses an option flag to prevent duplicates)
- Creates Home, About, Contact, and Blog pages with example content (edit in functions.php for your use case)
- Creates and assigns Primary and Footer menus, with menu items
- Sets homepage and blog page
- Sets up sidebar widgets (Recent Posts, Categories, Search)
- All code is in functions.php, fully documented for customization

**To customize for your niche:**

- Edit the `$pages` and `$menus` arrays in `functions.php` (see comments)

**To re-run the automation:**

- Delete the `ab_mcp_demo_content_installed` option from the WordPress options table (e.g., via WP-CLI or phpMyAdmin)

**Best Practices:**

- The automation is idempotent and will not create duplicate content on re-activation
- All content is created using WordPress core APIs for maximum compatibility

## Troubleshooting Plug-and-Play Automation

- **Automation did not run:** Ensure the theme was activated from the Appearance > Themes screen. The automation only runs on activation.
- **Duplicate content:** The automation is designed to run only once. If you see duplicates, manually remove extra pages/menus and ensure the ab_mcp_demo_content_installed option is set.
- **Resetting automation:** Delete the ab_mcp_demo_content_installed option from the options table (use WP-CLI: `wp option delete ab_mcp_demo_content_installed` or phpMyAdmin).

## Integrations: Workflow Automation & Asset Utilization

- All major workflow automation tools (ApiX-Drive, Activepieces, Albato, PROCESIO, KonnectzIT, Stackby, BackupSheep, Flowlu, Agiled, SuiteDash, Brilliant Directory, Gemini, DeepSeek, Logically/Afforai, exa.ai) are now supported.
- Enter API keys and webhooks in the centralized Integrations settings page (Appearance > API Integrations).
- Hooks and filters are available for triggering automations on post/page/CPT events (see /inc/integrations/ for examples).
- Usage examples for each integration are provided in the documentation and code comments.
- Asset utilization (email, CRM, e-commerce, AI, analytics) is automated where possible; see integration files for details.
- To add new integrations, copy the pattern in /inc/integrations/ and register your API key in the settings page.

## Directorist & Add-on Integration

- All Directorist plugins (core, Listings With Map, Stripe, Pricing Plans) are modularly integrated via `inc/integrations/`.
- Custom fields, directory types, and add-on features are filterable and extensible.
- Dedicated CSS in `css/directorist-integration.css` ensures visual consistency.
- Integration tests for each add-on are in `tests/integrations/`.
- All logic is extensible and follows project best practices for maintainability.

## Modular Onboarding & Industry Starter Kits

- Use the onboarding page (Appearance > Get Started / Import Starter Kit) to select and import an industry-specific starter kit (niche pack).
- Each starter kit provides demo content, directory types, custom fields, and sample listings for a specific industry (e.g., Real Estate, Legal Services).
- All starter kits are modular, opt-in, and do not affect the core theme. Imported content is tagged for easy reset.
- To add a new starter kit, create a PHP file in `/inc/niche-packs/` following the provided examples.
- The core theme remains fully niche-agnostic and untouched.

---
