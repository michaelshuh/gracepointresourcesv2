<?php
/**
 * The Template for displaying all single posts.
 *
 * @package gracepointresources
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <div class="container">
                <div class="row-fluid">
                    <div class="span8">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'content', 'single' ); ?>

                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>

                    <?php endwhile; // end of the loop. ?>

                    </div>
                    <div class="pull-left span3 well"><?php get_sidebar(); ?></div>
                </main><!-- #main -->
            </div>
        </div>
	</div><!-- #primary -->

<?php get_footer(); ?>
