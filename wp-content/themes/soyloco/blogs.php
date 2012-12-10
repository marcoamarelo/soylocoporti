<?php
/*
Template Name: Blogs
*/
?>

<?php get_header(); ?>

<div class="span-17 colborder">
	<?php global $post; ?>
	<?php $count = get_blog_count(); ?>
	<?php $blogs = get_last_updated('', 0, $count); ?>
	<?php foreach ($blogs as $blog) : ?>
		<?php setup_postdata($post); ?>
		<?php if($blog['blog_id'] != 1): ?>
		<?php $nome = get_blog_option($blog['blog_id'], 'blogname'); ?>
		<?php $descricao = get_blog_option($blog['blog_id'], 'blogdescription'); ?>
		<?php $admin_email = get_blog_option($blog['blog_id'], 'admin_email'); ?>
		<?php $url = get_blog_option($blog['blog_id'], 'siteurl'); ?>

			<div class="blog clearfix">
				<a style="float:left;" href="<?php echo $url; ?>" title="<?php echo $nome; ?>"><?php echo get_avatar( $admin_email); ?></a>
					<h3><a href="<?php echo $url; ?>" title="<?php echo $nome; ?>"><?php echo $nome; ?></a></h3>
				<p><?php echo $descricao; ?></p>
				
				
				<?php $post->ID = $wpdb->get_var('SELECT MAX(ID) FROM wp_'.$blog['blog_id'].'_posts WHERE post_type = "post" AND post_status = "publish"'); ?>
				<?php $permalink = get_blog_permalink($blog['blog_id'], $post->ID); ?>
				<?php $post = get_blog_post($blog['blog_id'], $post->ID); ?>
				
				<p class="blog-ultimo"><em>Último post:</em> <a href="<?php echo $permalink; ?>"><?php echo $post->post_title; ?></a> <?php the_date(); ?></p>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
