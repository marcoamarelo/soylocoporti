<?php if(in_category('atas') || in_category('contas')) : ?>
<?php auth_redirect(); ?>
<?php endif; ?>

<?php get_header(); ?>

	<div class="span-17 colborder">
		<?php if (is_archive()) { $posts = query_posts($query_string . '&orderby=date&showposts=1'); } ?>
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); $do_not_duplicate = $post->ID; ?>
					<div id="post-<?php the_ID(); ?>" class="post destaque">
						<div class="post-header">
							<small><?php the_time('j \d\e F \d\e Y') ?> &mdash; por <strong><?php the_author(); ?></strong></small>
							<h1><?php the_title(); ?></h1>
						</div>
						<div class="entry">
							<?php the_content(); ?>
						</div><!-- /entry -->
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<p><strong>Nada.</strong></p>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			<?php endif; ?>
		<?php if (is_archive()) { $posts = query_posts($query_string . '&orderby=date&offset=1&showposts=-1'); } ?>
			<?php if(have_posts()) : ?>
				<h6>Anteriores</h6>
				<?php while(have_posts()) : the_post(); if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>
					<div class="post-arquivo">
						<div class="post-header">
							<small><?php the_time('j \d\e F \d\e Y') ?></small>
							<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Link permanente para <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						</div>
					</div>
				<?php endwhile; ?>
		<?php else: endif; ?>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>