<?php
/**
 * The template for displaying search forms in gracepointresources
 *
 * @package gracepointresources
 */
?>

<div class="search-field">
	<form class="form-inline" method="get" id="searchform" action="<?php bloginfo('home'); ?>">
	  <div class="row">
	      <div class="span3 search-font"> What </div>
	      <div class="span3 offset5 search-font"> Category </div>
	  </div>

	  <input class="search-bar" value="<?php the_search_query(); ?>" name="s" id="s" />
	  <?php
	      wp_dropdown_categories(array('show_option_all' => 'All'
	      	, 'child_of' => get_query_var('cat')
	      	, 'hierarchical' => 1
	      	, 'depth' => 1
	      	, 'hide_empty' => 0
	      	, 'show_count' => 1
	      	));
	  ?>
	  <input class="search-button" type="submit" id="searchsubmit" value="Search"/>
	</form>
</div>
