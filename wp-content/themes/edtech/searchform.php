<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"  class="form-control search" id="inputSuccess4 search" aria-describedby="inputSuccess4Status" placeholder="search" required />
		<span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
	</div>
</form>