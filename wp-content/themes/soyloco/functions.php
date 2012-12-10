<?php define ('TAGS_DIRECTORY', get_bloginfo('url').'/tag/'); ?>
<?php

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));

add_action('wp_enqueue_scripts', 'soyloco_enqueue_scripts');
function soyloco_enqueue_scripts() {
    wp_enqueue_script('jquery');
}

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

function get_sitewide_posts ($n = 10) {
	global $wpdb;

	if ($n > 0)
		$blogs = $wpdb->get_col("
            SELECT blog_id
            FROM $wpdb->blogs
            WHERE 1
                AND public = '1'
                AND archived = '0'
                AND mature = '0'
                AND spam = '0'
                AND deleted = '0'
			ORDER BY last_updated DESC");

    print_r($blogs);
	if (!$blogs)
        return;

	$counter = 0;
    $posts = array();
    foreach ($blogs as $b) {

        $options_table = $wpdb->base_prefix.$blog."_options";
        $posts_table = $wpdb->base_prefix.$blog."_posts";

        $options = $wpdb->get_results("
            SELECT option_value
            FROM $options_table
            WHERE option_name IN ('siteurl','blogname')
            ORDER BY option_name DESC");

        if ($n > 0)
            $post = $wpdb->get_results("
                SELECT ID, post_title
                FROM $posts_table
                WHERE 1
                    AND post_status = 'publish'
                    AND ID > 1
                    AND post_type = 'post'
                    AND post_date >= DATE_SUB(CURRENT_DATE(), INTERVAL $n DAY)
                ORDER BY id DESC
                LIMIT 0,1");
        else
            $post = $wpdb->get_results("
                SELECT ID, post_title
                FROM $posts_table
                WHERE 1
                    AND post_status = 'publish'
                    AND ID > 1
                    AND post_type = 'post'
                ORDER BY id DESC
                LIMIT 0,1");

        if($post) {
            $posts[] = $post;
            $counter++;
        }

        if ($counter >= $n)
            break;
    }
    return $posts;
}

class pjw_page_excerpt
{
		function pjw_page_excerpt()
		{
			if ( function_exists('add_meta_box') ){
				add_meta_box( 'postexcerpt', __('Excerpt'), array(&$this, 'meta_box'), 'page'  );
			} else {
				add_action('dbx_page_advanced', array(&$this,'post_excerpt'));
			}
		}

		function meta_box()
		{
			global $post;
			?>
			<textarea rows="1" cols="40" name="excerpt" tabindex="6" id="excerpt"><?php echo $post->post_excerpt ?></textarea>
			<p><?php _e('Excerpts are optional hand-crafted summaries of your content. You can <a href="http://codex.wordpress.org/Template_Tags/the_excerpt" target="_blank">use them in your template</a>'); ?></p>
			<?php
		}

		function post_excerpt()
		{
			global $post;
			?>
			<div class="dbx-box-wrapper">
			<fieldset id="postexcerpt" class="dbx-box">
			<div class="dbx-handle-wrapper">
			<h3 class="dbx-handle"><?php _e('Optional Excerpt') ?></h3>
			</div>
			<div class="dbx-content-wrapper">
			<div class="dbx-content"><textarea rows="1" cols="40" name="excerpt" tabindex="6" id="excerpt"><?php echo $post->post_excerpt ?></textarea></div>
			</div>
			</fieldset>
			</div>
			<?php
		}
}

/* Initialise outselves lambda stylee */
add_action('admin_menu', create_function('','global $pjw_page_excerpt; $pjw_page_excerpt = new pjw_page_excerpt;'));

add_theme_support( 'post-thumbnails' );

?>
