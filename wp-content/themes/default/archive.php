<?php get_header(); ?>	

		<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h3>Arquivo</h3>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3>Arquivo do assunto &#8216;<?php single_tag_title(); ?>&#8217;</h3>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3>Arquivo de <?php the_time('F jS, Y'); ?></h3>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3>Arquivo do mês <?php the_time('F \d\e Y'); ?></h3>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3>Arquivo do ano <?php the_time('Y'); ?></h3>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3>Arquivo do autor</h3>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3>Arquivo</h3>
 	  <?php } ?>		

		<?php while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
					<div class="post-header">
						<small><?php the_time('l, j \d\e F \d\e Y') ?></small>
						<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<?php the_tags('', ', ', ''); ?>
					</div>
					<div class="entry">
						<?php the_content('Leia o texto completo &raquo;'); ?>
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
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
