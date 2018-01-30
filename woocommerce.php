<?php

if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';

    return;
}

// add_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
//
// add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
// add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
//
// add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
//
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 6);
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
//
// add_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
// add_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
// add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
// add_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
// add_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
add_action('ha_variation_add_to_cart', 'woocommerce_single_variation_add_to_cart_button', 20);

//
// add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
// add_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
// add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
//
// add_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );
// add_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
// add_action( 'woocommerce_review_meta', 'woocommerce_review_display_meta', 10 );
// add_action( 'woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10 );

$context            = Timber::get_context();
$context['sidebar'] = Timber::get_widgets('shopbar');
$context['cafes'] = getCustomPosts('cafe', -1, null, 'date', null, null);
// WooCommerce Notices
$context['wc_notices'] = wc_get_notices();
wc_clear_notices();

if (is_singular('product')) {
    $context['post']    = Timber::get_post();
    $product            = wc_get_product($context['post']->ID);
    $context['product'] = $product;
    $context['details'] = prepareProductFields();

    $attachment_ids = $product->get_gallery_attachment_ids();
    $gallery        = array();
    foreach ($attachment_ids as $attachment_id) {
        $gallery[] = new TimberImage($attachment_id);
    }
    wp_enqueue_script('zoom');
    $context['gallery'] = $gallery;
    if ($product->is_type('variable')) {
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    }

    Timber::render('views/woo/single-product.twig', $context);
} else {

    $posts               = Timber::get_posts();
    $context['products'] = $posts;
// getting any category that isn't a child category
    $parentQuery = array(
        'taxonomy' => 'product_cat',
        'parent'   => 0,
    );

    $context['categories'] = Timber::get_terms($parentQuery);
    if (is_product_category()) {
        $queried_object      = get_queried_object();
        $term_id             = $queried_object->term_id;
        $context['category'] = Timber::get_term($term_id, 'product_cat');
        $context['title']    = single_term_title('', false);
    }

    Timber::render('views/woo/archive.twig', $context);
}
