<?php
/*
Template Name: Tag_results
*/
?>

<?php get_header(); ?>

<div class="span-17 colborder">	

<h6>Arquivos do assunto "<?php current_tag();?>"</h6>

<?php if (tag_results()): ?>
<?php global $post; ?> 
	<?php foreach (tag_results() as $post): ?>
	<?php setup_postdata($post); ?>
	
	<?php $email = get_blog_option($post->blog_id, 'admin_email'); ?>
	<?php $nome_blog = get_blog_option($post->blog_id, 'blogname'); ?>
	<?php $endereco_blog = get_blog_option($post->blog_id, 'home'); ?>
	<?php $permalink = get_blog_permalink($post->blog_id, $post->ID) ?>
	
	<div class="texto clearfix">
		<a href="<?php echo $permalink; ?>" title="<?php echo the_title(); ?>"><?php echo bp_core_get_avatar( get_user_by_email($email)->ID,2,false,96,96 ); ?></a>
		<div class="texto-detalhes">
			<p><?php relative_post_the_date('', '', '', true); ?> &mdash; <a href="<?php echo $endereco_blog; ?>" title="Visite <?php echo $nome_blog; ?>"><?php echo $nome_blog; ?></a></p>
			<h1><a href="<?php echo $permalink; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<div class="entry">
				<?php the_excerpt(); ?> <?php //the_category(' '); ?>
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
		
		<?php restore_current_blog(); ?>
	</div>


  <?php endforeach; ?>
  
  <?php else : ?>
    <h2 class="center">Não encontrado</h2>
    <p class="center">Desculpe, mas o que você está procurando não existe.</p>
    <?php //include (TEMPLATEPATH . "/searchform.php"); ?>
 <?php endif; ?>

</div>


<!--include sidebar-->
<?php get_sidebar(); ?>

<!--include footer-->
<?php get_footer(); ?>
