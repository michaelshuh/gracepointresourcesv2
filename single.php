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
                    <div class="pull-left span3 well">
                        <?php dynamic_sidebar( 'category-sidebar' ); ?>
                        <div class="clear"></div>
                        <?php $attachments = new Attachments( 'attachments'); /* pass the instance name */ ?>

                        <?php if( $attachments->exist() ) : ?>
                            <aside id="attachments" class="widget box">
                                <h3>Attachments</h3>
                                <ul>
                                    <?php while( $attachments->get() ) : ?>
                                    <li>
                                        <a href="<?php echo $attachments->url(); ?>" target="_blank"><span><?php echo $attachments->field('title')?><span></a>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
                            </aside>
                        <?php endif; ?>
                        <?php get_sidebar(); ?>
                    </div>
                </main><!-- #main -->
            </div>
        </div>
	</div><!-- #primary -->

<?php get_footer(); ?>
