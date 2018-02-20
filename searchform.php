<?php
/**
 * Template for displaying search forms
 *
 * @package WordPress
 * @subpackage Buscemi
 * @version 1.0
 */
$searchPlaceholder = get_field('field_5a8c7e37b05c5', 'options');
$searchButton      = get_field('field_5a8c7e3db05c6', 'options');
$searchPrompt      = get_field('field_5a8c7e45b05c7', 'options');

?>

<?php $unique_id = esc_attr(uniqid('search-form-'));?>

<form role="search" method="get" class="search-form relative" action="<?php echo esc_url(home_url('/')); ?>">
	<a href="" class="trigger--search"><span>+</span></a>
	<h3 class=""><?php echo $searchPrompt; ?></h3>
	<div class="fields">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo $searchPlaceholder; ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo $searchPlaceholder; ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit screen-reader-text-mob ha-button "><?php echo $searchButton; ?></button>
</div>
</form>
