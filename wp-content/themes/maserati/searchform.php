<form role="search" method="get" class="search-form" action="/noticias/">
	<?php /*<label><span class="screen-reader-text"><?php echo _x('Search for:', 'label') ?></span></label> */ ?>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Buscar noticia', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
	<i class="icon-search"></i>

	<input type="submit" class="search-submit d-none" value="<?php echo esc_attr_x('Buscar', 'submit button') ?>" />
	<input type="hidden" name="post_type" value="post" id="post_type" />
</form>