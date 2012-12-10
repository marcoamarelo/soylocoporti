<?php

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
