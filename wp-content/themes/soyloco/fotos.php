<?php
/*
Template Name: Fotos
*/
?>

<?php get_header(); ?>

	<?php global $post; ?>
	<?php $posts = $wpmu_sitefeed->get_data('images'); ?>
	<?php $i = 1; ?>
	<?php $coluna = 1; ?>
	<?php foreach ($posts as $post) : ?>
		<?php setup_postdata($post); ?>
		<?php $blog_url = get_blog_option($post->blogid, 'siteurl'); ?>
		<?php $blog_nome = get_blog_option($post->blogid, 'blogname'); ?>
		<?php $permalink = get_blog_permalink($post->blogid, $post->ID); ?>
		<?php $admin_email = get_blog_option($post->blogid, 'admin_email'); ?>
		
		<?php if ($coluna != 4) : $span = 'coluna span-6'; ?>
		<?php else : $span = 'coluna span-6 last'; endif; ?>

		<?php if(($i-1) % 4 == 0) : ?>
			<div class="<?php echo $span; ?>">
		<?php endif; ?>
		
		<div class="arquivo">
			<?php switch_to_blog($post->blogid); ?>
				<div class="image-wrapper">
					<a href="<?php echo $blog_url; ?>" title="Visite <?php echo $blog_nome; ?>"><?php echo $blog_nome; ?></a>
					<?php echo wp_get_attachment_image($post->ID,'medium'); ?>
				</div>
				<h1><a href="<?php echo $post->guid; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<?php restore_current_blog(); ?>
		</div>
		
		<?php if($i % 4 == 0) : ?>
			<?php if($coluna == 4) : break; else : $coluna++; endif;?>
			</div><!-- /coluna -->
		<?php endif; ?>

		<?php $i++; ?>
	<?php endforeach; ?>	
	</div><!-- /coluna -->

<?php get_footer(); ?>