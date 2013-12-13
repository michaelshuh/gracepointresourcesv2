<?php
/**
 * @package gracepointresources
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
            <div class="entry-meta breadcrumb well">
                <?php gracepointresources_posted_on(); ?>
                <nav id="nav-single" class="navigation post-navigation" role="navigation">
                    <a class="btn btn-info pull-right btn-more" href="<?php the_permalink();?>">read more <i class="icon icon-chevron-right icon-white"></i></a>
                </nav>
            </div><!-- .entry-meta -->
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php edit_post_link( __( 'Edit', 'gracepointresources' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
