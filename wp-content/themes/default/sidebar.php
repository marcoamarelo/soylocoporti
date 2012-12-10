</div>
		<div class="span-6 last">
			<ul id="sidebar">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
				<li id="recentes">
					<h2>Recentes</h2>
					<?php query_posts('showposts=5'); ?>				
						<?php while (have_posts()) : the_post(); ?>
						<div class="recente">
							<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
						</div>
					<?php endwhile;?>
				</li>
				<li id="tags">
					<h2>Assuntos populares</h2>
					<?php wp_tag_cloud('unit=em&smallest=1&largest=2'); ?>
				</li>
				<li id="links">
					<h2>Links</h2>
					<ul>
						<?php wp_list_bookmarks('categorize=0&title_li='); ?>
					</ul>
				</li>
				<?php endif; ?>		
			</ul>
		</div>