<?php

// Adding documentation to the dash
function bc_dashboard_widget_function()
{
    $docs_template = get_template_directory() . '/library/docs.php';
    load_template($docs_template);
}
function bc_add_dashboard_widgets()
{
    wp_add_dashboard_widget('wp_dashboard_widget', 'Old Soul Documentation', 'bc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'bc_add_dashboard_widgets');

// add ie conditional html5 shim to header
function add_ie_html5_shim()
{
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

// Remove WP 4.2 emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Getting rid of WP Default jquery and adding from google
if (!is_admin()) {
    add_action("wp_enqueue_scripts", "jquery_enqueue", 11);
}


function jquery_enqueue()
{
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
    wp_register_script('jquery',  get_template_directory_uri() . '/app/jquery-1.9.1.min.js', false, null);
}

function localInstall()
{

    if (strpos($_SERVER["HTTP_HOST"], 'test') !== false) {
        $reloadScript = 'http://localhost:35729/livereload.js';
        wp_register_script('livereload', $reloadScript, null, false, true);
        wp_enqueue_script('livereload');
    }
}
function slider_scripts()
{
    // wp_register_script('selectric', get_template_directory_uri() . '/app/vendors/selectric.js', null, false, true);
    // wp_enqueue_script('selectric');

    // wp_enqueue_style('slick_style', get_template_directory_uri() . '/app/vendors/slick/slick.min.css', null, null, null);

    wp_register_script('flickity', get_template_directory_uri() . '/app/vendors/flickity/flickity.min.js', null, false, true);
    wp_enqueue_script('flickity');

    wp_enqueue_style('flickity_style', get_template_directory_uri() . '/app/vendors/flickity/flickity.css', null, null, null);
}
wp_register_script('zoom', get_template_directory_uri() . '/app/vendors/zoomzoom/zoom.min.js', null, false, true);



// Enqueuing all of our scripts and styles
function buscemi_scripts()
{
    wp_enqueue_script('jquery');
    if (localInstall() == true) {
        $reloadScript = 'http://localhost:35729/livereload.js';
        wp_register_script('livereload', $reloadScript, null, false, true);
        wp_enqueue_script('livereload');
    }

    $version = '1.8';

    wp_register_script('lazyload', get_template_directory_uri() . '/app/vendors/lazyload.min.js', null, false, true);
    wp_enqueue_script('lazyload');
    wp_register_script('appear', get_template_directory_uri() . '/app/vendors/appear.min.js', null, false, true);
    wp_enqueue_script('appear');
    wp_register_script('picturefill', get_template_directory_uri() . '/app/vendors/picturefill.min.js', null, false, true);
    wp_enqueue_script('picturefill');
    wp_enqueue_style('buscemi_style', get_template_directory_uri() . '/app/main.min.css', null, $version, null);

    wp_enqueue_script('buscemi_script', get_template_directory_uri() . '/app/app.min.js', null, null, null, true);

}
add_action('wp_enqueue_scripts', 'buscemi_scripts');




// Allowing SVG preveiw in WP Upload
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Setting up ACF options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
       acf_add_options_sub_page('Site Options');
    acf_add_options_sub_page('Shop');
}

require_once 'functions--custom-fields.php';
require_once 'functions--custom-posts.php';

function getNextPostLooped()
{
    $post_type = get_post_type();
    if (get_adjacent_post(false, '', false)) {
        return get_next_post();
    } else {
        $loop = new WP_Query('posts_per_page=1&order=ASC&post_type=' . $post_type);
        $loop->the_post();
        $postToReturn = get_post();
        wp_reset_query();
        return $postToReturn;
    }
}

function getPreviousPostLooped()
{
    $post_type = get_post_type();
    if (get_adjacent_post(false, '', true)) {
        return get_previous_post();
    } else {
        $loop = new WP_Query('posts_per_page=1&order=DESC&post_type=' . $post_type);
        $loop->the_post();
        $postToReturn = get_post();
        wp_reset_query();
        return $postToReturn;
    }
}
function getChildExcerpt($id)
{
    $excerpt = get_field('field_5a70d3b7d8984', $id);
    return $excerpt;

}
function getParentTitle($id)
{
    $title = get_field('field_5a70d4895490a', $id);
    return $title;

}


function new_excerpt_more($more) {
  return '<i class="icon-hand-short" data-grunticon-embed></i>';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_action( 'woocommerce_product_query', 'ha_hide_products_category_shop' );
  
function ha_hide_products_category_shop( $q ) {
 
    $tax_query = (array) $q->get( 'tax_query' );
 
    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'classes' ), // Category slug here
           'operator' => 'NOT IN'
    );
 
 
    $q->set( 'tax_query', $tax_query );
 
}