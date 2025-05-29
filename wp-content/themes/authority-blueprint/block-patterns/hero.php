<?php
/**
 * Hero block pattern
 */
return array(
    'title'       => __( 'Hero Section', 'authority-blueprint' ),
    'categories'  => array( 'featured', 'homepage' ),
    'content'     => '<!-- wp:cover {"url":"/wp-content/themes/authority-blueprint/images/placeholder.png","dimRatio":60,"minHeight":400,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:400px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="/wp-content/themes/authority-blueprint/images/placeholder.png" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1} --><h1 class="has-text-align-center">Welcome to Authority Blueprint</h1><!-- /wp:heading --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Your journey to authority starts here.</p><!-- /wp:paragraph --></div></div><!-- /wp:cover -->',
); 