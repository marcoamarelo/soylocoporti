<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php if (is_single() || is_page() || is_archive()) { wp_title('',true); } else { bloginfo('description'); } ?> &mdash; <?php bloginfo('name'); ?></title>
	<!-- Framework CSS -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/screen.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" type="text/css" media="print" />
  	<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen, projection" />
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--[if lt IE 7]><script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/unitpngfix.js"></script><![endif]-->
	<?php wp_head(); ?>
</head>

<body>

	<div class="container" id="topo">
		<?php include (TEMPLATEPATH . '/menu.php'); ?>

		<div class="span-6">
			<p id="logo"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?> &mdash; <?php bloginfo('description'); ?></a></p>
			<!--  <a href="http://cultura.gov.br/cultura_viva"><img id="selo-midia-livre" src="http://soylocoporti.org.br/files/2009/10/logo_midialivre.png" /></a>  -->
		</div>
		<div class="span-6" id="boasvindas">
			<?php if(is_user_logged_in()) : ?>
				<?php if (function_exists('stray_random_quote')) : ?>
					<?php stray_random_quote(); ?>
				<?php endif; ?>
			<?php else : ?>
				<?php query_posts('page_id=5'); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_excerpt(); ?>
				<?php endwhile; endif; ?>
				<?php wp_reset_query(); ?>
				<a href="<?php echo get_page_link(5) ?>" title="Saiba mais sobre o Soyloco">&rarr; Conheça o Soyloco</a>
			<?php endif; ?>
		</div>
		<div class="span-12 last">
			<div class="span-12 last">
				<?php if(function_exists('get_ajaxlogin')) : get_ajaxlogin(); endif; ?>
			</div>
			<div class="span-12 last" id="busca">
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			</div>
		</div>
	</div><!-- /topo -->



	<div class="container" id="mae">
		<?php if(function_exists('yoast_breadcrumb') && !(is_home())) : $breadcrumbs = yoast_breadcrumb("","",false); ?> <h2 id="migalhas"><?php echo $breadcrumbs; ?></h2> <?php endif; ?>

