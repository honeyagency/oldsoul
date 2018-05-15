<?php
function getCustomPosts($posttype = '', $limit = '', $category = '', $order = 'title', $excluded = null, $tag = null)
{

    if (is_numeric($category)) {
        $category = get_cat_name($category);
    }

    $args = array(
        'posts_per_page' => $limit,
        'post_type'      => $posttype,
        'order'          => 'DESC',
        'orderby'        => $order,

    );

    // Begin statememnts to append the $args array, just so the arrays stay light and clean.

    // If there's a category to filter by, we're gonna go ahead and do that
    if ($category != null) {
        $args['category_name'] = $category;
    }
    if ($tag != null) {
        $args['tag'] = $tag;
    }
    // If there's an excluded post (for example, the current post) we add that here
    if ($excluded != null) {
        $args['post__not_in'] = array($excluded);
    }
// print_r($args);
    $loop = new WP_Query($args);

    // Empty array for the terms

    if ($loop->have_posts()) {
        while ($loop->have_posts()) {

            // Setting up post data
            $loop->the_post();

            // Fill the array with post data we changed in getSinglePost
            $array[] = getSinglePost($posttype);
        }

        // Restores original Post Data
        wp_reset_postdata();

        // Returns an array of terms.
        if ($limit === 1) {
            $array = $array['0'];
        }

        return $array;

    }
}

function getSinglePost($posttype = null, $postId = null)
{
    if (is_array($postId)) {
        $postId = $postId[0];
    }
    if ($postId == null) {
        $postId = get_the_id();
    }
    $attachedimageId = get_post_thumbnail_id($postId);
    if (!empty($attachedimageId)) {
        $attachedimage = new TimberImage($attachedimageId);
    } else {
        $attachedimage = null;
    }

    $categories = get_the_category($postId);

    $author = array(
        'first_name' => get_the_author_firstname($postId),
        'last_name'  => get_the_author_lastname($postId),
    );
    // setup an array to change the post data returned
    $singlePostArray = array(
        'date'       => strtotime(get_the_date($postId)),
        'id'         => $postId,
        'title'      => get_the_title($postId),
        'categories' => $categories,
        'tags'       => get_the_tags($postId),
        'post_type'  => $posttype,
        'image'      => $attachedimage,
        'link'       => get_permalink($postId),
        'excerpt'    => get_the_excerpt($postId),
        'author'     => $author,
    );
    if ($posttype == 'cafe') {
        $singlePostArray['cafe'] = prepareGlobalCafeFields();
    } elseif ($posttype == 'product') {
        $singlePostArray['info'] = prepareProductFields();
    }
    // Restores original Post Data
    wp_reset_postdata();

    return $singlePostArray;
}
