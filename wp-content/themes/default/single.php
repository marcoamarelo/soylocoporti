<?php get_header(); ?>
 	
 		<?php if (have_posts()) : while (have_posts()) : the_post(); $video = get_post_meta($post->ID, 'video', $single=true); ?>		

		<div class="post clearfix" id="post-<?php the_ID(); ?>">
			<div class="post-header">
				<small><?php the_time('l, j \d\e F \d\e Y') ?></small>
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<?php the_tags('', ', ', ''); ?>
			</div>
			<?php if(function_exists(videocontainer_getcontainersingle)) : videocontainer_getcontainersingle("video","360","240"); endif; ?>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
				<?php if(function_exists('wp_email')) { email_link(); } ?>  
				<?php if(function_exists('into_delicious')) { into_delicious(); } ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>
		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?> 	

<?php get_sidebar(); ?>
<?php get_footer(); ?>