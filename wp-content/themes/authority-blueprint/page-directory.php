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
