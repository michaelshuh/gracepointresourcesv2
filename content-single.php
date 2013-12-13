<?php
/**
 * @package gracepointresources
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="entry-meta breadcrumb">
            <?php gracepointresources_posted_on(); ?>
            <?php gracepointresources_post_nav(); ?>
        </div><!-- .entry-meta -->
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'gracepointresources' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-meta">
        <?php gracepointresources_post_meta(); ?>

        <?php edit_post_link( __( '[Edit]', 'gracepointresources' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post-## -->
