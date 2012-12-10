<?php 
	if (!function_exists('get_page_link_by_slug'))
		include_once( PLUGINDIR . "/get-link/get-link-by-slug.php" ); 		
?>
<div class="menu">
	<ul class="clearfix">
		<li class="menu-capa<?php if(is_home()) { echo ' current_page_item'; } ?>"><a href="<?php bloginfo('url'); ?>/" title="A primeira página">Capa</a></li>
		<li class="menu-sobre<?php if(is_page('sobre') || $post->post_parent == '5' || is_category('atas-de-reunioes') || is_category('prestacao-de-contas')) { echo ' current_page_item'; } ?>"><a href="<?php echo get_page_link_by_slug('sobre') ?>" title="Sobre o Soyloco">Sobre</a></li>
		<li class="menu-blogs<?php if(is_page('todosblogs')) { echo ' current_page_item'; } ?>"><a href="<?php echo get_page_link_by_slug('todosblogs') ?>" title="Todos os blogs da rede">Blogs</a></li>
		<li class="menu-textos<?php if(is_page('textos')) { echo ' current_page_item'; } ?>"><a href="<?php echo get_page_link_by_slug('textos') ?>" title="Notícias, artigos, contos, poesias...">Textos</a></li>
		<li class="menu-fotos<?php if(is_page('fotos')) { echo ' current_page_item'; } ?>"><a href="<?php echo get_page_link_by_slug('fotos') ?>" title="Galerias de imagens">Fotos</a></li>
		<li class="menu-videos<?php if(is_page('videos')) { echo ' current_page_item'; } ?>"><a href="<?php echo get_page_link_by_slug('videos') ?>" title="Filmes, documentários, curtas, entrevistas...">Vídeos</a></li>
		<li class="menu-agenda<?php if(is_page('agenda')) { echo ' current_page_item'; } ?>"><a href="<?php echo get_page_link_by_slug('agenda') ?>" title="Eventos importantes">Agenda</a></li>
		<li class="menu-contato<?php if(is_page('contato')) { echo ' current_page_item"'; } ?>"><a href="<?php echo get_page_link_by_slug('contato') ?>" title="Fale com a gente">Contato</a></li>
	</ul>
</div><!-- /menu -->
