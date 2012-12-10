<?php
/*
Template Name: Textos da Rede
*/
?>

<?php get_header(); ?>

<div class="span-17 colborder">	
	
	<?php switch_to_blog(876); ?>
	<?php query_posts('posts_per_page=10&category_name=textos'); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php $guid = get_the_guid(); ?>
		<?php list($blog_id, $post_id) = explode(".", $guid); ?>
		
		<?php $email = get_the_author_email(); ?>
		<?php $nome_blog = get_blog_option($blog_id, 'blogname'); ?>
		<?php $endereco_blog = get_blog_option($blog_id, 'home'); ?>
	
		<div class="texto clearfix">
			<!-- <?php echo $email; ?> -->
			<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo bp_core_get_avatar( get_user_by_email($email)->ID,2,false,96,96 ); ?></a>
			<div class="texto-detalhes">
				<p><?php relative_post_the_date('d/m/y', '', '', true); ?> &mdash; <a href="<?php echo $endereco_blog; ?>" title="Visite <?php echo $nome_blog; ?>"><?php echo $nome_blog; ?></a></p>
				<h1><a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
				<div class="entry">
					<?php the_excerpt(); ?> 
					<?php switch_to_blog($post->blog_id); ?>
					<?php $tags = get_the_tags($post->ID); ?>
					<?php if(is_array($tags)) : ?>
						<?php $i = 0; ?>
						<?php foreach($tags as $tag) : ?>
							<?php if($i == 0) : $lista = '<a href='.TAGS_DIRECTORY.$tag->slug.'>'.$tag->name.'</a>'; ?>
							<?php else: $lista .= ', <a href='.TAGS_DIRECTORY.$tag->slug.'>'.$tag->name.'</a>'; endif; ?>
							<?php $i++; ?>
						<?php endforeach; ?>
						<p class="tags"><em>Tags</em> <?php echo $lista; ?></p>	
					<?php endif; ?>
				</div>	
			</div>
			
		</div>
		<?php endwhile; ?>

	<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Entradas antigas') ?></div>
			<div class="alignright"><?php previous_posts_link('Entradas novas &raquo;') ?></div>
		</div>
	<?php endif; ?>
	
</div>

<?php switch_to_blog(1); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>