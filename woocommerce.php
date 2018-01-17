<?php

if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';

    return;
}

$context            = Timber::get_context();
$context['sidebar'] = Timber::get_widgets('shopbar');

if (is_singular('product')) {
    $context['post']    = Timber::get_post();
    $product            = wc_get_product($context['post']->ID);
    $context['product'] = $product;

    $attachment_ids = $product->get_gallery_attachment_ids();
    $gallery        = array();
    foreach ($attachment_ids as $attachment_id) {
        $gallery[] = new TimberImage($attachment_id);
    }

    $context['gallery'] = $gallery;
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
