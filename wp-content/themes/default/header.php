<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php if (is_single() || is_page() || is_archive()) { wp_title('',true); } else { bloginfo('description'); } ?> &mdash; <?php bloginfo('name'); ?></title>	

	<!-- Framework CSS -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" type="text/css" media="print">
  	<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie.css" type="text/css" media="screen, projection"><![endif]-->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen, projection">

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
		
	<?php wp_head(); ?>
</head>

<body>
	<div class="container" id="cabeca">
		<div class="span-12">
			<p class="frase">Parte do <a href="http://soylocoporti.org.br" title="Por uma América Latina unida">coletivo Soylocoporti</a></p>
		</div>
		<div class="span-7 last">
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		</div>
	</div>
	<div id="topo-wrap"><div id="topo">
		<div id="texto-topo">
			<p id="logo"><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></p>
			<p id="descricao"><span><?php bloginfo('description');?></span></p>
		</div>
	</div></div>
	<div class="container">
		<div class="menu">
			<ul>
				<li><a href="<?php bloginfo('siteurl');?>/" title="A primeira página">Capa</a></li>
				<?php wp_list_pages("title_li="); ?>
			</ul>			
		</div>
		<div class="span-12 colborder">