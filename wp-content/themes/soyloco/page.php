<?php get_header(); ?>

	<?php if (is_page('pagina-de-produtos')): ?>
		<div class="span-24 colborder">
	<?php else: ?>
		<div class="span-17 colborder">
	<?php endif; ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">				
				<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
		
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				</div>
			</div>
		<?php endwhile; endif; ?>
		
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>