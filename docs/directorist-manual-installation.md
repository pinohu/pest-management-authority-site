# Manual Directorist Installation Guide for Pest Management Science

## Quick Start (5 Minutes)

### Step 1: Extract Directorist Files
1. Locate your downloaded Directorist `.zip` files
2. Extract them to `wp-content/plugins/` directory
3. You should see new directories like `directorist/` or `directorist-business-directory/`

### Step 2: Upload to WordPress
**If using WordPress Admin:**
1. Go to **Plugins** → **Add New** → **Upload Plugin**
2. Upload each Directorist `.zip` file
3. Click **Install Now** → **Activate Plugin**

**If using FTP/File Manager:**
1. Copy extracted plugin folders to `wp-content/plugins/`
2. Go to **Plugins** in WordPress Admin
3. Find Directorist plugin(s) and click **Activate**

### Step 3: Basic Configuration
1. Go to **Directorist** → **Setup Wizard** in WordPress Admin
2. Complete the setup process
3. Create basic directory types and categories

## Integration with Pest Management Science Theme

### Add Custom Styling (Copy & Paste)
1. Create folder: `wp-content/themes/authority-blueprint/css/`
2. Create file: `directorist-integration.css`
3. Paste this CSS:

```css
/* Directorist Integration Styles for Pest Management Science */

/* Apply pest management color scheme to Directorist elements */
.directorist .atbd_content_module .widget {
    border-color: #388e3c;
}

.directorist .btn.btn-primary,
.directorist .atbd_submit_btn {
    background-color: #388e3c;
    border-color: #388e3c;
}

.directorist .btn.btn-primary:hover,
.directorist .atbd_submit_btn:hover {
    background-color: #2e7d32;
    border-color: #2e7d32;
}

/* Directory listing cards */
.directorist .atbd_single_listing {
    border: 1px solid #795548;
    background: #f5fbe7;
}

/* Category icons styling for pest management */
.pest-directory-category .fas.fa-bug { color: #388e3c; }
.pest-directory-category .fas.fa-microscope { color: #795548; }
.pest-directory-category .fas.fa-industry { color: #2e7d32; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .directorist .atbd_search_form .form-group {
        margin-bottom: 15px;
    }
}

/* Pest management specific directory styling */
.pest-management-directory .directory-hero {
    background: linear-gradient(135deg, #388e3c, #2e7d32);
    color: white;
    padding: 60px 0;
    text-align: center;
}

.pest-management-directory .category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin: 40px 0;
}

.pest-management-directory .category-card {
    background: white;
    border: 1px solid #795548;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    transition: transform 0.3s ease;
}

.pest-management-directory .category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.pest-management-directory .category-card i {
    font-size: 3em;
    color: #388e3c;
    margin-bottom: 20px;
}
```

### Add Theme Integration (Copy & Paste)
1. Open `wp-content/themes/authority-blueprint/functions.php`
2. Add this code at the bottom (before the closing `?>` if it exists):

```php
// === DIRECTORIST INTEGRATION FOR PEST MANAGEMENT SCIENCE ===

// Enqueue Directorist integration styles
add_action('wp_enqueue_scripts', function() {
    if (function_exists('directorist_setup')) {
        wp_enqueue_style('authority-directorist-integration', 
            get_template_directory_uri() . '/css/directorist-integration.css',
            array('authority-blueprint-style'), '1.0.0');
    }
});

// Directorist customization for pest management science
add_action('init', function() {
    if (function_exists('directorist_setup')) {
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
    
    $fields['certifications'] = array(
        'type' => 'text',
        'label' => 'Certifications',
        'placeholder' => 'e.g., Licensed Pest Control Operator, IPM Certified'
    );
    
    return $fields;
}

// Add directory showcase to front page
add_filter('the_content', function($content) {
    if (is_front_page() && !is_admin() && function_exists('directorist_setup')) {
        $directory_content = '
        <section class="pest-directory-showcase">
            <h2>Find Pest Management Professionals</h2>
            <p>Connect with certified pest control services, research institutions, and product suppliers in your area.</p>
            <div class="directory-quick-links">
                <a href="/directory/" class="btn btn-primary">Browse Directory</a>
                <a href="/add-listing/" class="btn btn-secondary">Add Your Listing</a>
            </div>
        </section>';
        
        return $content . $directory_content;
    }
    return $content;
});
```

### Create Directory Page Template
1. Create file: `wp-content/themes/authority-blueprint/page-directory.php`
2. Paste this code:

```php
<?php
/*
Template Name: Pest Management Directory
*/

get_header(); ?>

<main class="pest-management-directory">
    <section class="directory-hero">
        <div class="container">
            <h1>Pest Management Science Directory</h1>
            <p>Find pest control professionals, researchers, and suppliers in your area</p>
            
            <?php if (function_exists('directorist_search_form')) {
                echo do_shortcode('[directorist_search_listing]');
            } ?>
        </div>
    </section>
    
    <section class="directory-categories">
        <div class="container">
            <h2>Browse by Category</h2>
            <div class="category-grid">
                <div class="category-card pest-directory-category">
                    <i class="fas fa-bug"></i>
                    <h3>Pest Control Services</h3>
                    <p>Professional pest control companies and operators</p>
                    <a href="<?php echo site_url('/directory/pest-control-services/'); ?>" class="btn btn-primary">View Services</a>
                </div>
                <div class="category-card pest-directory-category">
                    <i class="fas fa-microscope"></i>
                    <h3>Research Institutions</h3>
                    <p>Universities and research facilities</p>
                    <a href="<?php echo site_url('/directory/research-institutions/'); ?>" class="btn btn-primary">View Research</a>
                </div>
                <div class="category-card pest-directory-category">
                    <i class="fas fa-industry"></i>
                    <h3>Product Suppliers</h3>
                    <p>Equipment, chemicals, and biological control suppliers</p>
                    <a href="<?php echo site_url('/directory/product-suppliers/'); ?>" class="btn btn-primary">View Suppliers</a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="featured-listings">
        <div class="container">
            <h2>Featured Listings</h2>
            <?php if (function_exists('directorist_featured_listings')) {
                echo do_shortcode('[directorist_all_listing featured="yes" listings_per_page="6"]');
            } ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
```

## Create Directory Page in WordPress

1. Go to **Pages** → **Add New**
2. Title: "Directory"
3. On the right side, find **Page Attributes** → **Template**
4. Select "Pest Management Directory"
5. Publish the page

## Configure Directory Categories

1. Go to **Directorist** → **Directory Types**
2. Add these categories:
   - **Pest Control Services** (slug: `pest-control-services`)
   - **Research Institutions** (slug: `research-institutions`)  
   - **Product Suppliers** (slug: `product-suppliers`)

## Add Custom Fields

1. Go to **Directorist** → **Form Fields**
2. Add these custom fields:
   - **Pest Specialization** (dropdown): Agricultural Pests, Urban Pest Control, etc.
   - **Control Methods** (checkboxes): Biological Control, Chemical Control, etc.
   - **Certifications** (text field)

## Test Your Integration

1. Visit your Directory page
2. Try adding a test listing
3. Check that pest management categories appear
4. Verify styling matches your site

## Troubleshooting

- **Styling not working?** Check that `directorist-integration.css` file exists
- **Custom fields missing?** Make sure Directorist plugin is activated
- **Directory page blank?** Verify template is selected correctly
- **Search not working?** Check Directorist settings and shortcodes

## Next Steps

- Configure Google Maps integration
- Set up payment gateways for premium listings
- Add sample directory entries
- Customize search filters
- Set up email notifications

---

**Need help?** See the full guide at `docs/directorist-integration-guide.md` or contact support. 