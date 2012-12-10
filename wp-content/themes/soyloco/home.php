<?php get_header(); ?>


    <?php if(function_exists('twitter_messages')) : ?>
        <div id="twitter">
			<p><a href="http://twitter.com/soylocoporti" title="Twitter!"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.gif" id="tweet" /></a><?php twitter_messages('soylocoporti'); ?></p>
        </div>
    <?php endif; ?>

    <?php /*
	<div id="banner">
		<span id="texto-divulgacao" ><strong>Divulgação</strong></span> <a href="http://festivaldecultura.art.br"><img src="http://www.dceufpr.org.br/sitio/banner_fest_900x100.gif" /></a>
	</div>

    <p style="text-align:center;">
        <span style="font-size:20px;">O site do Soylocoporti está gripado!</span><br/>
        <span style="font-size:14px;">
            Tivemos de resolver alguns problemas de segurança, e aos poucos iremos retomar o comportamento do site.<br/>
            Por enquanto você pode dar uma olhada nos <a href="<?php bloginfo("url"); ?>/todosblogs/">blogs do pessoal</a>, que já estão funcionando.<br/>
            Agradecemos a sua compreensão.
        </span>
    </p>
    */ ?>

	<?php
        global $post;
        $posts = $wpmu_sitefeed->get_data('posts');
        $base_blog_stylesheet_uri = get_stylesheet_directory_uri();
        $imgopts = array(
            'link_to_post' => false,
            'image_scan' => true,
            'echo' => false,
            'size' => 'soyloco-home'
        );
        $i = 1;
        $coluna = 1;
        $numeros = array();
    ?>

	<?php if (is_array($posts)) foreach ($posts as $post) : ?>

        <?php
		 	if ($post->blogid == 1 || $post->blogid == 4)
                continue;

            setup_postdata($post);
            if ($coluna != 4)
                $span = 'coluna span-6';
            else
                $span = 'coluna span-6 last';

            $domain = get_blog_details($post->blogid, 'domain');
            do {
				$numero = mt_rand(1,71);
			} while (in_array($numero, $numeros));
            if (strlen($numero) == 1)
                $numero = "0{$numero}";
			$numeros[$i] = $numero;

            switch_to_blog($post->blogid);
            $url = get_bloginfo('url');
            $blog_nome = get_bloginfo('name');
            $permalink = get_blog_permalink($post->blogid, $post->ID);

            $imagem = false;
            if (function_exists('get_the_image'))
                $imagem = get_the_image($imgopts);

            if (!$imagem)
                $imagem = '<img src="' . $base_blog_stylesheet_uri . '/images/capa/' . $numero . '.jpg" />';

		?>

		<?php if (($i-1) % 2 == 0) : ?>
			<div class="<?php echo $span; ?>">
		<?php endif; ?>

            <div class="arquivo<?php echo $destaque; ?>">
				<a class="blogname" href="<?php echo $url ?>" title="Visite <?php echo $post->blogname; ?>"><?php echo $blog_nome; ?></a>
				<div class="image-wrapper">
					<?php echo $imagem; ?>
				</div>

				<h1><a href="<?php echo $permalink; ?>" title="&quot;<?php the_title(); ?>&quot; tem <?php echo $post->comments_number; ?> comentários"><?php the_title(); ?> <?php echo '{'.$post->comments_number.'}'; ?></a></h1>
			</div>

		<?php if ($i % 2 == 0) : ?>
			<?php if($coluna == 4) : break; else : $coluna++; endif;?>
		    </div><!-- /coluna -->
		<?php endif; ?>

		<?php $i++; ?>

	<?php endforeach; ?>
</div><!-- /coluna -->
<?php switch_to_blog(1); ?>

<script type="text/javascript">
    jQuery('.image-wrapper').each(function(){
        w = jQuery(this).width();
        h = 300;
        img = jQuery(this).find('img');
        if (img.width() != w || img.height() > h)
            img.css('width', w + 'px');
        if (img.height() > h)
            jQuery(this).css('height', h + 'px');
    });
</script>

<?php get_footer(); ?>
