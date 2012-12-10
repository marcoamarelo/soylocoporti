<?php
if ( function_exists('register_sidebar') )
    register_sidebar();

$content_width = 455;

function get_page_link_by_slug($page_slug) {
	global $wpdb;
	global $current_blog;
	$page_id = 0;
	$results = $wpdb->get_results("SELECT ID FROM {$wpdb->prefix}{$current_blog->ID}posts WHERE post_type = 'page' AND post_name = '$page_slug'");
	if($results) :
		foreach($results as $result) :
			$page_id = $result->ID;
		endforeach;
	endif;

	return get_page_link($page_id);
}

function get_category_link_by_slug($category_slug) {
	global $wpdb;
	global $current_blog;
	$category_id = 0;
	$oi = "SELECT a.term_id FROM {$wpdb->prefix}{$current_blog->ID}terms AS a, {$wpdb->prefix}{$current_blog->ID}term_taxonomy AS b WHERE a.term_id = b.term_id AND taxonomy = 'category' AND slug = '$category_slug'";
	$results = $wpdb->get_results("SELECT a.term_id FROM {$wpdb->prefix}{$current_blog->ID}terms AS a, {$wpdb->prefix}{$current_blog->ID}term_taxonomy AS b WHERE a.term_id = b.term_id AND taxonomy = 'category' AND slug = '$category_slug'");
	if($results) :
		foreach($results as $result) :
			$category_id = $result->term_id;
		endforeach;
	endif;
	
	return get_category_link($category_id);
}

?>
<?php

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/images/topo.gif'); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 750);
define('HEADER_IMAGE_HEIGHT', 200);
define( 'NO_HEADER_TEXT', true );

function blogs_admin_header_style() {
?>

<style type="text/css">
	#headimg { height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; width: <?php echo HEADER_IMAGE_WIDTH; ?>px; }
</style>

<?php } function header_style() { ?>

<style type="text/css">
	#topo { background: url(<?php header_image() ?>) no-repeat; }
</style>

<?php } add_custom_image_header('header_style', 'blogs_admin_header_style'); ?>
