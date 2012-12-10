<?php get_header(); ?>
 	
 		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="post-header">
				<h3><?php the_title(); ?></h3>
			</div>
			<div class="entry">
				<?php the_content(); ?>
			</div>
		</div>	
        
		<?php endwhile; endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>