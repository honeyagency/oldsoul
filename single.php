<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['comment_form'] = TimberHelper::get_comment_form();
$context['prefooter'] = prepareGlobalPreFooter();
if ($post->post_type == 'cafe') {
	$context['cafe'] = prepareCafeFields();
	
	$context['next'] = getNextPostLooped();
  $context['previous'] = getPreviousPostLooped();
}elseif ($post->post_type == 'event') {
$context['event'] = prepareEventFields($post->ID);
}
$context['cafes'] = getCustomPosts('cafe', 4 , null, 'date', null, null);
if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
