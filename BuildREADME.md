# Authority Blueprint WordPress Theme

## Project Overview

**Authority Blueprint** is a robust, multi-page, mobile-first WordPress theme designed for authority blogs and content-driven sites. It is fully customizable for any niche and implements best practices from industry-leading blueprints, including mobile-first, accessibility, SEO, and performance standards.

---

## Key Features & Architecture

- **Mobile-First, Responsive Design**: All layouts, navigation, and components are designed mobile-first, scaling up for tablets and desktops.
- **Accessibility (a11y)**: Skip links, focus styles, ARIA attributes, screen-reader text, and semantic HTML ensure WCAG compliance.
- **SEO-Optimized**: Semantic markup, microdata breadcrumbs, optimized headings, and performance best practices.
- **Performance**: Lazy loading, responsive images, code splitting, and print/high-contrast modes.
- **Custom Post Types**: `pillar`, `cluster`, `resource`, `case_study`, `glossary` for advanced content modeling.
- **Custom Taxonomies**: `topic`, `audience`, `resource_type` for flexible categorization.
- **Block Patterns**: Hero, featured content, testimonials, newsletter signup, and more for rapid layout creation.
- **Navigation**: Mobile hamburger menu, bottom nav for mobile, accessible header/footer menus.
- **Sidebar & Breadcrumbs**: Modular sidebar with search, recent posts, categories, and related content. SEO-friendly breadcrumb navigation.
- **Editor Styles**: Consistent block editor experience with theme.json and editor styles.
- **Print & High-Contrast Modes**: Print-optimized and user-preference high-contrast CSS.
- **Extensible & Modular**: Clean separation of templates, partials, and styles for easy customization.

---

## Best Practices & Standards Implemented

- **Mobile-First Design**: All CSS and layouts start with mobile, using progressive enhancement for larger screens.
- **Accessibility**: Skip links, focus indicators, ARIA roles/attributes, screen-reader utilities, and visually hidden regions.
- **SEO**: Semantic HTML5, microdata for breadcrumbs, optimized heading structure, and meta support.
- **Performance**: Lazy loading, responsive images, minimal HTTP requests, and optimized CSS/JS.
- **Cross-Browser Compatibility**: CSS resets, appearance fixes, and responsive tables/code blocks.
- **Editor & Frontend Parity**: theme.json and editor styles ensure WYSIWYG editing.

---

## Custom Post Types & Taxonomies

- **Post Types**: `pillar`, `cluster`, `resource`, `case_study`, `glossary`
- **Taxonomies**: `topic`, `audience`, `resource_type`
- **Purpose**: Enables advanced content architectures for authority/cluster content, resources, and more.

---

## Block Patterns & Layouts

- **Hero Section**
- **Featured Content Cards**
- **Testimonials**
- **Newsletter Signup**
- **Category Navigation**
- **Audience Pathways**
- **Social Proof**
- **Latest Updates**

All patterns are mobile-first, accessible, and ready for use in the block editor.

---

## Theme Structure

- **Templates**: `front-page.php`, `single.php`, `page.php`, `archive.php`, `404.php`, `index.php`
- **Partials**: `header.php`, `footer.php`, `sidebar.php`, `breadcrumb.php`
- **Assets**: `style.css`, `js/navigation.js`, `css/navigation.css`, `theme.json`
- **Editor Styles**: `add_editor_style('style.css')` for block editor consistency

---

## How to Use & Customize

1. **Install the Theme**: Copy the `authority-blueprint` folder to your `wp-content/themes` directory.
2. **Activate**: In the WordPress admin, activate the "Authority Blueprint" theme.
3. **Menus**: Assign menus to the `Primary` and `Footer` locations.
4. **Customize**: Use the block editor and block patterns to build pages. Add content to custom post types as needed.
5. **Branding**: Update logo, colors, and typography via `theme.json` or the Customizer.
6. **Sidebar & Breadcrumbs**: Sidebar and breadcrumbs are included on all major templates for navigation and context.
7. **Newsletter**: Integrate with your preferred newsletter plugin (e.g., Email Subscribers) for the signup form.

---

## Testing & Verification

- **Mobile/Tablet/Desktop**: Test all layouts and navigation on real devices and emulators.
- **Accessibility**: Use screen readers, keyboard navigation, and a11y tools (axe, Lighthouse).
- **SEO**: Validate with Google Lighthouse, Rich Results Test, and browser dev tools.
- **Performance**: Test lazy loading, image optimization, and print/high-contrast modes.
- **Cross-Browser**: Verify in Chrome, Firefox, Safari, Edge, and mobile browsers.

---

## Next Steps & Recommendations

- **Content Customization**: Add your own categories, posts, and custom post types.
- **Integrate Plugins**: SEO (Yoast, Rank Math), caching, security, and newsletter plugins.
- **Extend Patterns**: Add more block patterns for your niche.
- **Deploy**: Move to production, enable SSL, and set up analytics.
- **Contribute**: Fork and extend the theme for your own needs or contribute improvements.

---

## Credits & References

- Based on best practices from: Mobile-First Design, Responsive Design, Accessibility, SEO, and Authority Site Blueprints.
- See `/docs` for detailed reference files and blueprints used in this build.

# Build & Development Guide

## Docker Usage
- `docker compose up -d` — Start all services
- `docker compose exec wpcli wp core update` — Update WordPress core
- `docker compose exec wpcli wp plugin update --all` — Update all plugins
- `docker compose exec wpcli wp theme update --all` — Update all themes
- `docker compose exec wpcli wp db export /var/www/html/backup.sql` — Backup database

## Security Best Practices
- File editing disabled in dashboard
- SSL enforced for admin
- Sensitive files protected via .htaccess
- Debugging disabled in production

## Performance
- Object caching enabled (add Redis/Memcached for best results)
- PHP memory limits increased
- Image optimization and lazy loading recommended

## Theme/Plugin Development
- Use WP-CLI for scaffolding and management
- Custom block styles and variations supported
- See `/wp-content/themes/authority-blueprint` for theme structure

## Automation
- Use WP-CLI in Docker for backups, updates, and migrations
- Example: `docker compose exec wpcli wp search-replace 'oldurl' 'newurl' --skip-columns=guid`

## Testing
- Add PHPUnit for backend, Cypress for frontend
- Use GitHub Actions for CI/CD

## Accessibility & SEO
- Run a11y audits regularly
- Use semantic HTML and ARIA best practices

## Further Reading
- See referenced best practices docs in `/` for architecture, SEO, accessibility, and more. 