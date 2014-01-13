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
            foreach(get_categories('hide_empty=0&exclude=1') as $category) {
                if ( $category->parent > 0) {
                    continue;
                } else {
                    array_push( $parent_categories, $category );
                }
            }
        ?>
    
        <?php get_search_form() ?>


		<?php if ( is_front_page() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php /*while ( have_posts() ) : the_post(); */ ?>
            <div class="pull-left-new span10 row">
                <?php
                    foreach ($parent_categories as $category) { 
                        gracepointresources_category_display($category);
                    }
                ?>
            </div>

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
            <div id="homepage-sidebar" class="pull-left-new well">
                <?php dynamic_sidebar( 'homepage-sidebar' ); ?>
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
