<form role="search" method="get" class="form-inline search-form" action="<?php esc_url( home_url( '/' ) ) ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'wedding' ) ?>" value="<?php get_search_query() ?>" name="s" />
	<span class="search-submit">
		<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'wedding' ) ?>" />
		<i class="icon-search fa fa-search"></i>
	</span>
</form>


