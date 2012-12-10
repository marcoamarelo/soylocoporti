<?php get_header(); ?>
<?php $ricerca == $_GET['s']; ?>

	<div class="span-18">
		<div class="post">
		<?
		$ricerca = wp_specialchars($s, 1);
		gt_search_all_blogs($ricerca); ?>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
