<?php
/*
Template Name: Videos 
*/
?>

<?php get_header(); ?>

	<div class="span-17 colborder">
	<?php 			
			include_once(ABSPATH.WPINC.'/rss.php');
			$videos_youtube = fetch_rss('http://gdata.youtube.com/feeds/base/users/soyporti/uploads?v=2&hl=pt-br&orderby=updated',5);
			
			$video_detaque_url = str_replace(array("?","="),"/",$videos_youtube->items[0]['link']);						
	?>

		<h6>Último vídeo</h6>
    	<div id="video-destaque">
			<object width="625" height="494">
			<param name="movie" value="<?php echo $video_detaque_url ?>&hl=pt-br&fs=1"></param>
			<param name="allowFullScreen" value="true"></param>
			<param name="allowscriptaccess" value="always"></param>
			<embed src="<?php echo $video_detaque_url ?>&hl=pt-br&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="625" height="494"></embed>
			</object>
			<h3><?php 	echo $videos_youtube->items[0]['title']; ?></h3>
		</div>
		<h6>Mais vídeos</h6>
		<div id="mais-videos" class="clearfix">
			<?php for ($i=1;$i<5;$i++) { ?>
			<div class="video clearfix">
				<?php 
						$id_video = split("video:",$videos_youtube->items[$i]['id']);				
				?>
					<a href="<?php echo $videos_youtube->items[$i]['link'] ?>"> <img src="http://img.youtube.com/vi/<?php echo $id_video[1] ?>/2.jpg" alt="<?php $videos_youtube->items[$i]['title']?>" width="130px" height="97px" /></a>
					<p><a href="<?php echo $videos_youtube->items[$i]['link'] ?>"> <?php echo $videos_youtube->items[$i]['title']; ?> </a></p>
			</div>
			<?php } ?>
		</div>
		<p id="vermais-videos">Veja outros vídeos no nosso <a href="http://youtube.com/soyporti" title="Soyloco no YouTube">canal no YouTube</a>.</p>

		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>