#!/bin/bash

# Directorist Installation Script for Pest Management Science WordPress Site
# Usage: ./scripts/install-directorist.sh [path-to-directorist-files]

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if WordPress directory exists
if [ ! -f "wp-config.php" ]; then
    print_error "WordPress installation not found. Please run this script from your WordPress root directory."
    exit 1
fi

# Get Directorist files path from user input
if [ -z "$1" ]; then
    read -p "Enter the path to your Directorist files (e.g., ~/Downloads/directorist-files/): " DIRECTORIST_PATH
else
    DIRECTORIST_PATH="$1"
fi

# Verify Directorist files exist
if [ ! -d "$DIRECTORIST_PATH" ]; then
    print_error "Directorist files directory not found: $DIRECTORIST_PATH"
    exit 1
fi

print_status "Starting Directorist integration for Pest Management Science..."

# Step 1: Backup current installation
print_status "Creating backups..."
mkdir -p backups/$(date +%Y%m%d)
cp -r wp-content/themes/authority-blueprint backups/$(date +%Y%m%d)/authority-blueprint-backup
cp -r wp-content/plugins backups/$(date +%Y%m%d)/plugins-backup

# Step 2: Install Directorist plugins
print_status "Installing Directorist plugins..."
cd wp-content/plugins

# Extract any .zip files in the Directorist directory
find "$DIRECTORIST_PATH" -name "*.zip" -type f | while read zipfile; do
    print_status "Extracting: $(basename "$zipfile")"
    unzip -q "$zipfile" -d .
done

cd ../../

# Step 3: Create integration CSS file
print_status "Creating Directorist integration CSS..."
mkdir -p wp-content/themes/authority-blueprint/css

cat > wp-content/themes/authority-blueprint/css/directorist-integration.css << 'EOF'
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
EOF

# Step 4: Add Directorist integration to functions.php
print_status "Adding Directorist integration to theme functions..."

cat >> wp-content/themes/authority-blueprint/functions.php << 'EOF'

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

EOF

# Step 5: Create directory page template
print_status "Creating directory page template..."

cat > wp-content/themes/authority-blueprint/page-directory.php << 'EOF'
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
EOF

# Step 6: Create installation notes
print_status "Creating installation notes..."

cat > directorist-installation-notes.txt << EOF
DIRECTORIST INSTALLATION COMPLETED
=================================

Date: $(date)
Installed to: $(pwd)

NEXT STEPS:
1. Go to WordPress Admin > Plugins
2. Activate the Directorist plugin(s)
3. Run the Directorist Setup Wizard
4. Create a new page called "Directory" and use the "Pest Management Directory" template
5. Configure Directorist settings:
   - Enable the pest management directory types
   - Set up custom fields for specializations and control methods
   - Configure Google Maps API (if needed)
   - Set up payment gateways (for premium listings)

CUSTOMIZATIONS APPLIED:
- Pest Management Science color scheme
- Custom directory types (Pest Control, Research, Suppliers)
- Custom fields for pest specialization and control methods
- Integration with Authority Blueprint theme
- Mobile-responsive directory styling

BACKUP LOCATIONS:
- Themes: backups/$(date +%Y%m%d)/authority-blueprint-backup
- Plugins: backups/$(date +%Y%m%d)/plugins-backup

SUPPORT:
- See docs/directorist-integration-guide.md for detailed instructions
- Test thoroughly before going live
- Check WordPress Admin > Directorist for configuration options

EOF

print_status "Directorist integration completed successfully!"
print_status "Installation notes saved to: directorist-installation-notes.txt"
print_warning "Please activate the Directorist plugin(s) in WordPress Admin and run the setup wizard."
print_warning "Don't forget to test the integration thoroughly before going live."

echo ""
print_status "Summary of changes:"
echo "  ✓ Directorist plugins extracted to wp-content/plugins/"
echo "  ✓ Integration CSS created at wp-content/themes/authority-blueprint/css/directorist-integration.css"
echo "  ✓ Functions.php updated with pest management customizations"
echo "  ✓ Directory page template created (page-directory.php)"
echo "  ✓ Backups created in backups/$(date +%Y%m%d)/"
echo "  ✓ Installation notes created"
echo ""
print_status "Next: Go to WordPress Admin to activate and configure Directorist!" 