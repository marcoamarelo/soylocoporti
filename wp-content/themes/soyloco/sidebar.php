<?php ini_alter("error_reporting","E_NONE"); ?>
<div class="span-6 last" id="lateral">

	<?php //se for da área institucional ?>
	<?php if (is_page('sobre') || $post->post_parent == '5' || is_category('atas-de-reunioes') || is_category('prestacao-de-contas'))  : ?>
		<ul>
			<li<?php if ( is_page('sobre') ) { echo ' class="current_page_item"'; } ?>><a href="<?php echo get_page_link_by_slug('sobre') ?>" title="Quem somos">Quem somos</a></li>			
			<?php wp_list_pages('title_li=&child_of=5'); ?>
			<?php if(is_user_logged_in()) : ?>
			<li<?php if ( is_category('prestacao-de-contas') ) { echo ' class="current_page_item"'; } ?>><a href="<?php echo get_category_link_by_slug('prestacao-de-contas'); ?>" title="Prestação de contas">Prestação de contas</a></li>
			<li<?php if ( is_category('atas-de-reunioes') ) { echo ' class="current_page_item"'; } ?>><a href="<?php echo get_category_link_by_slug('atas-de-reunioes'); ?>" title="Atas de reuniões">Atas de reuniões</a></li>
			<?php endif; ?>			
		</ul>
		<?php edit_post_link('Editar', '<p>', '</p>'); ?>
	
	<?php elseif(is_page('videos')) : ?>
		<h6>Favoritos</h6>
		<div class="span-6" id="videos-favoritos">
			<?php ozh_youfave(); ?>
		</div>
		
	<?php //se for a página que mostra os blogs ?>
	<?php elseif(is_page('todosblogs')) : ?>
	
		<?php $count = get_blog_count(); ?>
		<p id="contador"><big><?php echo $count; ?></big><br/>blogs na rede</p>
		
		<h6>Os Mais atualizados</h6>
	
		<?php $blogs_ativos = get_most_active_blogs( $num = 6, $display = false ); ?> 
		<ol id="atualizados">
		<?php foreach ($blogs_ativos as $blog_ativo) : ?>
		<?php if (get_blog_option($blog_ativo['blog_id'], 'siteurl') == "http://soylocoporti.org.br") continue; ?> 
			<?php $blog_nome = get_blog_option($blog_ativo['blog_id'], 'blogname'); ?>
			<?php $blog_url = get_blog_option($blog_ativo['blog_id'], 'siteurl'); ?>
			<?php $admin_email = get_blog_option($blog_ativo['blog_id'], 'admin_email'); ?>
			<li class="clearfix">
				<?php echo bp_core_get_avatar( get_user_by_email($admin_email)->ID,1,false,32,32 ); ?><a href="<?php echo $blog_url; ?>" title="<?php echo $blog_nome; ?> tem <?php echo $blog_ativo['postcount']; ?> posts"><?php echo $blog_nome; ?></a>
				<br />
				<small><?php echo $blog_ativo['postcount']; ?> posts</small>
			</li>
		<?php endforeach; ?>
		</ol>	
	<?php //se for a página de contato ?>
	<?php elseif(is_page('contato')) : ?>
	
		<div class="contato">
			<address>
			Coletivo Soylocoporti
			<br/>Rua Itupava, 1299, cj 312, Hugo Lange
			<br/>Curitiba, <acronym title="Paraná">PR</acronym>, Brasil
			<br/>+55 41-3092-0463
			</address>
		</div>
	<?php elseif($post->post_type == 'wpsc-product') : ?>
		<?php echo wpsc_shopping_cart(); ?>
	<?php endif; ?>
</div><!-- /lateral -->


