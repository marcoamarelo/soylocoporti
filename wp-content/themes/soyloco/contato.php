<?php
/*
Template Name: Contato 
*/
?>

<?php get_header(); ?>

	<div class="span-17 colborder">
	
		<?php
			if (function_exists("formulariocontato_getform")) {
				echo formulariocontato_getform();
			}

		?>		
		
		<iframe width="670" height="414" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.br/maps?f=q&amp;hl=pt-BR&amp;geocode=&amp;q=R.+Itupava+1229,+Alto+da+Rua+Quinze,+Curitiba,+80040-000,+Brazil&amp;sll=-25.418179,-49.248565&amp;sspn=0.004302,0.009656&amp;ie=UTF8&amp;s=AARTsJrVNePViOtbvGkh8_mp22YSCH4bvg&amp;ll=-25.413509,-49.243984&amp;spn=0.032095,0.057507&amp;z=14&amp;iwloc=addr&amp;output=embed"></iframe><br /><a href="http://maps.google.com.br/maps?f=q&amp;hl=pt-BR&amp;geocode=&amp;q=R.+Itupava+1229,+Alto+da+Rua+Quinze,+Curitiba,+80040-000,+Brazil&amp;sll=-25.418179,-49.248565&amp;sspn=0.004302,0.009656&amp;ie=UTF8&amp;ll=-25.413509,-49.243984&amp;spn=0.032095,0.057507&amp;z=14&amp;iwloc=addr&amp;source=embed">Exibir mapa ampliado</a>
		
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>


