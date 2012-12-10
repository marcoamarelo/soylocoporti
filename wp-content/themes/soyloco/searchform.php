<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<label class="hidden" for="s">Busca</label>
<div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
<input type="submit" id="searchsubmit" class="button" value="Buscar" />
</div>
</form>
