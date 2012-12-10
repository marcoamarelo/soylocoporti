<?php
/*
Template Name: Teste Recent Posts
*/
?>

<?php get_header(); ?>

<div class="span-17 colborder">
	<?php wpmu_recent_posts(); ?>
	
	<h1>ah_recent_posts_mu()</h1>
	<?php ah_recent_posts_mu(10, 60, true, '<li>', '</li>'); ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>