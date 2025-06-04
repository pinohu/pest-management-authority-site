# Directorist Integration Guide for Pest Management Science WordPress Site

## Overview

This guide provides step-by-step instructions for integrating Directorist themes and plugins into your existing Pest Management Science authority site while preserving your current customizations.

## Pre-Integration Checklist

### 1. Backup Current Site

```bash
# Create backup of current site
cp -r wp-content/themes/authority-blueprint wp-content/themes/authority-blueprint-backup
cp -r wp-content/plugins wp-content/plugins-backup
mysqldump -u [username] -p [database_name] > pest-management-backup-$(date +%Y%m%d).sql
```

### 2. Verify Downloads

- [ ] Directorist theme files (.zip)
- [ ] Directorist plugin files (.zip)
- [ ] License keys (if premium)
- [ ] Documentation files

## Installation Options

### Option A: Use Directorist as Primary Theme (Directory-focused site)

### Option B: Integrate Directorist with Authority Blueprint (Hybrid approach)

### Option C: Use Directorist plugins only with Authority Blueprint theme

---

## Option A: Directorist as Primary Theme

### Step 1: Install Directorist Theme

```bash
# Navigate to themes directory
cd wp-content/themes

# Extract Directorist theme (replace with your actual file path)
unzip /path/to/your/directorist-theme.zip

# Verify installation
ls -la directorist-theme-name/
```

### Step 2: Preserve Custom Pest Management Customizations

```bash
# Copy custom functions from Authority Blueprint
cp authority-blueprint/functions.php directorist-theme-name/functions-authority-backup.php

# Copy custom CSS
cp authority-blueprint/style.css directorist-theme-name/style-authority-backup.css

# Copy sample content
cp authority-blueprint/sample-content.xml directorist-theme-name/
```

### Step 3: Customize Directorist for Pest Management Science

1. **Child Theme Creation** (Recommended)

```php
<?php
// wp-content/themes/directorist-pest-management/functions.php
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'pest-management-style', get_stylesheet_directory_uri() . '/style.css' );
});

// Import Authority Blueprint customizations
require_once get_stylesheet_directory() . '/includes/pest-management-customizations.php';
?>
```

2. **Style Customizations**

```css
/* wp-content/themes/directorist-pest-management/style.css */
/*
Theme Name: Directorist Pest Management Science
Template: directorist-parent-theme
Description: Pest Management Science directory site based on Directorist
Version: 1.0.0
*/

/* Pest Management Science Color Palette */
:root {
  --primary-color: #388e3c;
  --secondary-color: #795548;
  --background-color: #f5fbe7;
  --contrast-color: #222;
}

/* Apply pest management branding */
.site-header {
  background: var(--primary-color);
}
.directory-listings {
  border-color: var(--secondary-color);
}
```

---

## Option B: Hybrid Integration (Recommended)

### Step 1: Install Directorist Plugins Only

```bash
# Navigate to plugins directory
cd wp-content/plugins

# Extract Directorist plugins
unzip /path/to/directorist-business-directory.zip
unzip /path/to/directorist-extensions.zip

# Verify plugin installation
ls -la directorist*/
```

### Step 2: Integrate with Authority Blueprint

```php
<?php
// Add to wp-content/themes/authority-blueprint/functions.php

// Directorist Integration for Pest Management Science
add_action('init', function() {
    // Custom directory post types for pest management
    if (function_exists('directorist_setup')) {
        // Customize Directorist for pest management
        add_filter('directorist_listing_types', 'pest_management_directory_types');
        add_filter('directorist_custom_fields', 'pest_management_custom_fields');
    }
});

function pest_management_directory_types($types) {
    $types['pest_control_services'] = array(
        'name' => 'Pest Control Services',
        'slug' => 'pest-control-services',
        'icon' => 'fas fa-bug',
        'description' => 'Professional pest control service providers'
    );

    $types['research_institutions'] = array(
        'name' => 'Research Institutions',
        'slug' => 'research-institutions',
        'icon' => 'fas fa-microscope',
        'description' => 'Pest management research facilities'
    );

    $types['product_suppliers'] = array(
        'name' => 'Product Suppliers',
        'slug' => 'product-suppliers',
        'icon' => 'fas fa-industry',
        'description' => 'Pest management product suppliers'
    );

    return $types;
}

function pest_management_custom_fields($fields) {
    $fields['pest_specialization'] = array(
        'type' => 'select',
        'label' => 'Pest Specialization',
        'options' => array(
            'agricultural' => 'Agricultural Pests',
            'urban' => 'Urban Pest Control',
            'stored_product' => 'Stored Product Pests',
            'structural' => 'Structural Pests',
            'public_health' => 'Public Health Pests'
        )
    );

    $fields['control_methods'] = array(
        'type' => 'checkbox',
        'label' => 'Control Methods',
        'options' => array(
            'biological' => 'Biological Control',
            'chemical' => 'Chemical Control',
            'mechanical' => 'Mechanical Control',
            'cultural' => 'Cultural Control',
            'integrated' => 'Integrated Pest Management'
        )
    );

    return $fields;
}
?>
```

### Step 3: Create Directory Pages

```php
<?php
// wp-content/themes/authority-blueprint/page-directory.php
get_header(); ?>

<main class="pest-management-directory">
    <section class="directory-hero">
        <h1>Pest Management Science Directory</h1>
        <p>Find pest control professionals, researchers, and suppliers in your area</p>

        <?php if (function_exists('directorist_search_form')) {
            directorist_search_form();
        } ?>
    </section>

    <section class="directory-categories">
        <h2>Browse by Category</h2>
        <div class="category-grid">
            <div class="category-card">
                <i class="fas fa-bug"></i>
                <h3>Pest Control Services</h3>
                <a href="<?php echo site_url('/directory/pest-control-services/'); ?>">View Services</a>
            </div>
            <div class="category-card">
                <i class="fas fa-microscope"></i>
                <h3>Research Institutions</h3>
                <a href="<?php echo site_url('/directory/research-institutions/'); ?>">View Research</a>
            </div>
            <div class="category-card">
                <i class="fas fa-industry"></i>
                <h3>Product Suppliers</h3>
                <a href="<?php echo site_url('/directory/product-suppliers/'); ?>">View Suppliers</a>
            </div>
        </div>
    </section>

    <?php if (function_exists('directorist_featured_listings')) {
        directorist_featured_listings();
    } ?>
</main>

<?php get_footer(); ?>
```

---

## Option C: Plugins Only Integration

### Step 1: Install Required Plugins

```bash
# Core Directorist plugin
unzip directorist-business-directory.zip -d wp-content/plugins/

# Optional extensions
unzip directorist-pricing-plans.zip -d wp-content/plugins/
unzip directorist-google-maps.zip -d wp-content/plugins/
unzip directorist-reviews.zip -d wp-content/plugins/
```

### Step 2: Theme Integration Points

```php
<?php
// Add to functions.php
add_action('wp_enqueue_scripts', function() {
    // Ensure Directorist styles work with Authority Blueprint
    wp_enqueue_style('authority-directorist-integration',
        get_template_directory_uri() . '/css/directorist-integration.css',
        array('authority-blueprint-style'), '1.0.0');
});

// Add directory shortcodes to front page
add_filter('the_content', function($content) {
    if (is_front_page() && !is_admin()) {
        $directory_content = '
        <section class="pest-directory-showcase">
            <h2>Find Pest Management Professionals</h2>
            [directorist_search_listing]
            [directorist_all_listing]
        </section>';

        return $content . $directory_content;
    }
    return $content;
});
?>
```

---

## Post-Installation Configuration

### 1. Plugin Activation & Setup

1. **WordPress Admin** → **Plugins** → **Activate Directorist**
2. **Directorist** → **Setup Wizard**
3. Configure:
   - Directory types (Pest Control Services, Research Institutions, Suppliers)
   - Custom fields (Specialization, Certifications, Service Areas)
   - Payment gateways (if premium listings)
   - Map settings (Google Maps API)

### 2. Import Pest Management Sample Data

```php
<?php
// Import script for pest management directory entries
function import_pest_management_directory_data() {
    $sample_listings = array(
        array(
            'title' => 'Green Valley Pest Control',
            'type' => 'pest_control_services',
            'specialization' => 'agricultural',
            'methods' => array('biological', 'integrated'),
            'location' => 'California, USA'
        ),
        array(
            'title' => 'Agricultural Research Institute',
            'type' => 'research_institutions',
            'specialization' => 'agricultural',
            'methods' => array('biological', 'integrated'),
            'location' => 'Iowa, USA'
        )
        // Add more sample entries
    );

    foreach ($sample_listings as $listing) {
        // Create directory listing
        wp_insert_post(array(
            'post_title' => $listing['title'],
            'post_type' => 'at_biz_dir',
            'post_status' => 'publish',
            'meta_input' => array(
                '_directory_type' => $listing['type'],
                '_pest_specialization' => $listing['specialization'],
                '_control_methods' => $listing['methods'],
                '_listing_location' => $listing['location']
            )
        ));
    }
}

// Run once after plugin activation
add_action('init', 'import_pest_management_directory_data');
?>
```

### 3. Menu & Navigation Integration

1. **Appearance** → **Menus**
2. Add directory pages to main navigation:
   - Directory Home
   - Browse Services
   - Add Listing
   - Directory Search

### 4. Widget Areas

1. **Appearance** → **Widgets**
2. Add Directorist widgets:
   - Search Widget (Sidebar)
   - Featured Listings (Footer)
   - Recent Listings (Homepage)

---

## Testing & Verification

### Functionality Tests

- [ ] Directory search works
- [ ] Listing submission works
- [ ] Categories display correctly
- [ ] Maps integration functional
- [ ] Mobile responsiveness maintained
- [ ] SEO optimization preserved

### Integration Tests

- [ ] Authority Blueprint styles preserved
- [ ] Pest management branding consistent
- [ ] Navigation flows properly
- [ ] No plugin conflicts
- [ ] Performance impact acceptable

---

## Maintenance & Updates

### Regular Tasks

- [ ] Update Directorist plugins monthly
- [ ] Monitor directory spam/quality
- [ ] Backup before major updates
- [ ] Test functionality after updates
- [ ] Review and approve new listings

### Performance Optimization

```php
<?php
// Optimize Directorist for performance
add_action('init', function() {
    // Disable unused Directorist features
    remove_action('wp_head', 'directorist_unnecessary_scripts');

    // Lazy load directory images
    add_filter('directorist_listing_image', function($img) {
        return str_replace('<img', '<img loading="lazy"', $img);
    });

    // Cache directory queries
    add_filter('directorist_cache_listings', '__return_true');
});
?>
```

---

## Troubleshooting

### Common Issues

1. **Theme Conflicts**: Use child theme approach
2. **Plugin Conflicts**: Deactivate conflicting plugins
3. **Performance Issues**: Enable caching, optimize images
4. **SEO Conflicts**: Configure Yoast/RankMath for directory pages
5. **Mobile Issues**: Test responsive design thoroughly

### Support Resources

- Directorist Documentation
- WordPress.org Support Forums
- Pest Management Science Community
- Developer Console for debugging

---

## Next Steps

1. Choose your preferred integration option (A, B, or C)
2. Follow the step-by-step installation guide
3. Test thoroughly in staging environment
4. Deploy to production with backups
5. Monitor performance and user feedback

This integration will give you a powerful directory platform specifically tailored for the pest management science community while preserving your authority site's SEO and branding advantages.
