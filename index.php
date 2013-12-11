<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package gracepointresources
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main container" role="main">
        <?php 
            $parent_categories = array();
            foreach(get_categories('hide_empty=0') as $category) {
                if ( $category->parent > 0) {
                    continue;
                } else {
                    array_push( $parent_categories, $category );
                }
            }
        ?>

        <div class="row">
            <form class="form-inline" method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
                <select class="span2" id="search-context" name="search-context">
                    <option value="<?php bloginfo('home'); ?>">All</option>
                    <?php
                    foreach ($parent_categories as $category) { ?>
                        <option value="<?php echo get_category_link($category->cat_ID) ?>"><?php echo $category->name; ?></option>
                    <?php } ?>
                </select>


                <input type="text" size="18" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" class="span8" />
                <input type="submit" id="searchsubmit" value="Search" class="btn" />
            </form>
        </div>
        <script type="text/javascript">
            jQuery("#search-context").change(function(changeEvent) {
                var dropdownURL = jQuery("#search-context").val();
                jQuery("#searchform").attr("action", dropdownURL)
            });
        </script>


		<?php if ( is_front_page() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php /*while ( have_posts() ) : the_post(); */ ?>
            <?php
                foreach ($parent_categories as $category) { ?>
                    <div class="span2">
                        <div class="about well">
                            <a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->name; ?></a>
                            <div class="entry-content">
                                <h2><?php echo $category->name; ?></h2>
                                <p><?php echo $category->description; ?></p>
                                <!-- Category Image -->
                                <img src="<?php category_image_src(array("term_id" => $category->cat_ID),true); ?>" />
                            </div>
                            <a href="<?php echo get_category_link($category->cat_ID); ?>" class="btn"><?php echo $category->description;?></a>
                        </div>
                    </div>
            <?php } ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					//get_template_part( 'content', get_post_format() );
				?>

			<?php // endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
