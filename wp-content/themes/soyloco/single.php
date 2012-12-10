<?php get_header(); ?>

	<div class="span-17 colborder">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="post-header">
					<small><?php the_time('j \d\e F \d\e Y') ?> &mdash; <?php the_author(); ?></small>
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="entry">
					<?php the_content(); ?>
				</div>
			</div>
			
		<?php endwhile; else: ?>		
		<p>Nada.</p>
		<?php endif; ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
