<?php get_header(); ?>

			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="post clearfix" id="post-<?php the_ID(); ?>">
					<div class="post-header">
						<small><?php the_time('l, j \d\e F \d\e Y') ?></small>
						<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<?php the_tags('', ', ', ''); ?>
					</div>
					<div class="entry clearfix">
						<?php the_content('Leia o texto completo &raquo;'); ?>
						<?php if(function_exists('wp_email')) { email_link(); } ?>  
					</div>
					<p class="comenta"><?php comments_popup_link('Nenhum comentário &#187;', '1 comentário &#187;', '% comentários &#187;'); ?></p>
				</div>
			<?php endwhile; ?>
			<div class="navega clearfix">
				<div class="antigos"><?php next_posts_link('&laquo; Mais antigos') ?></div>
				<div class="recentes"><?php previous_posts_link('Mais recentes &raquo;') ?></div>
			</div>
			<?php else : ?>
				<h2 class="center">Not Found</h2>
				<p>Sorry, but you are looking for something that isn't here.</p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			<?php endif; ?>
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>

