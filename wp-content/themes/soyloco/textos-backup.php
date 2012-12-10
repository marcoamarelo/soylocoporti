<?php
/*
Template Name: Textos 
*/
?>

<?php get_header(); ?>

<div class="span-17 colborder">	
	
	<?php switch_to_blog(850); ?>
	<?php query_posts('posts_per_page=10&category_name=textos'); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php $guid = get_the_guid(); ?>
		<?php list($blog_id, $post_id) = explode(".", $guid); ?>

		<?php $email = get_the_author_email(); ?>
		<?php $nome_blog = get_blog_option($blog_id, 'blogname'); ?>
		<?php $endereco_blog = get_blog_option($blog_id, 'home'); ?>
		
		<?php //switch_to_blog($blog_id); ?>
		
		<?php $post = get_blog_post($blog_id, $post_id); ?>
		
		<div class="texto clearfix">
			<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo get_avatar( $email, 96 ); ?></a>
			<div class="texto-detalhes">
				<p><?php relative_post_the_date(); ?> &mdash; <a href="<?php echo $endereco_blog; ?>" title="Visite <?php echo $nome_blog; ?>"><?php echo $nome_blog; ?></a></p>
				<h1><a href="<?php echo $post->guid; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
				<div class="entry"><?php the_excerpt(); ?></div>
						
				<?php $tags = get_the_tags(); ?>
				<?php if(is_array($tags)) : ?>
					<?php foreach($tags as $tag) : ?>
						<?php if($lista == "") : $lista = $tag->name; ?>
						<?php else: $lista .= ', '.$tag->name; endif; ?>
					<?php endforeach; ?>
					<p class="tags"><?php echo $lista; ?></p>
				<?php endif; ?>
			</div>
			
		</div>
		<?php switch_to_blog(850); ?>
	
	<?php endwhile; ?>
	
	<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php endif; ?>
	
</div>

<?php switch_to_blog(1); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>