<?php
/*
Template Name: Teste Recent Posts
*/
?>

<?php get_header(); ?>
	
	<?php ahp_recent_posts(8, 60); ?>
	
	
	
	<?php query_posts('pagename=avisos'); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if(get_the_content() != '') : ?>
			<div id="avisos">
				<?php the_content(); ?>
			</div>				
		<?php endif; ?>
	<?php endwhile; endif; ?>
	
	
	<?php global $post; ?>
	<?php $posts = $wpmu_sitefeed->get_data('posts'); ?>
	<?php $i = 1; ?>
	<?php $coluna = 1; ?>
	<?php $numeros = array(); ?>
	<?php foreach ($posts as $post) : ?>
	<?php setup_postdata($post); ?>
		<?php if($post->blogid == 1) : ?>
			<?php continue; ?>
		<?php endif; ?>
	
		<?php if ($coluna != 4) : $span = 'coluna span-6'; ?>
		<?php else : $span = 'coluna span-6 last'; endif; ?>

		<?php if(($i-1) % 2 == 0) : ?>
			<div class="<?php echo $span; ?>">
		<?php endif; ?>
			
			<?php $domain = get_blog_details($post->blogid, 'domain'); ?>
			<?php if($domain->domain == 'blog.soylocoporti.org.br') : $destaque = ' blog-oficial'; else: $destaque = ''; endif; ?>
			<div class="arquivo <?php echo $destaque; ?>">
				<?php //recebendo a url do blog ao passar a id dele ?>
				<?php $url = get_blog_option($post->blogid, 'siteurl'); ?>
				<?php $blog_nome = get_blog_option($post->blogid, 'blogname'); ?>
				<?php $permalink = get_blog_permalink($post->blogid, $post->ID); ?>
				
				<?php do { ?>
					<?php $numero = mt_rand(1,71); ?>
				<?php } while (in_array($numero, $numeros));?>
				<?php if (strlen($numero) == 1) : $numero = "0$numero"; endif; ?>
				<?php $numeros[$i] = $numero; ?>
				
				<div class="image-wrapper">
					<a href="<?=$url ?>" title="Visite <?php echo $post->blogname; ?>"><?php echo $blog_nome; ?></a>
				<?php
						switch_to_blog($post->blogid);
						$imagem = get_the_image();
						// Volta pro Blog original
						switch_to_blog(1);
						if ($imagem == "<!-- No images were added to this post. -->") {
				?>
					<img src="<?php bloginfo('template_url'); ?>/images/capa/<?php echo $numero; ?>.jpg" alt="<?php the_title(); ?>" />
				<?php
					} else {
						echo $imagem;
					}				
				?>
					
				</div>
				
				<h1><a href="<?php echo $permalink; ?>" title="&quot;<?php the_title(); ?>&quot; tem <?php echo $post->comments_number; ?> comentários"><?php the_title(); ?> <?php echo '{'.$post->comments_number.'}'; ?></a></h1>
			</div>

		<?php if($i % 2 == 0) : ?>
			<?php if($coluna == 4) : break; else : $coluna++; endif;?>
			</div><!-- /coluna -->
		<?php endif; ?>

		<?php $i++; ?>
		

	<?php endforeach; ?>
</div><!-- /coluna -->

<?php get_footer(); ?>