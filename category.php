<?php
/**
 * The template for displaying all categories.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package gracepointresources
 */

get_header(); ?>



<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
<div><input type="text" size="18" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
<input type="submit" id="searchsubmit" value="Search" class="btn" />
</div>
</form>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <?php if(is_category()): ?>
    <?php
        $current_categoryID= $cat;
        $current_category = get_category($cat);
        if ($current_category->parent == 0) {
            $child_categories = array();
            foreach (get_categories("hide_empty=0&parent=$current_categoryID") as $child_category) {
                array_push($child_categories, $child_category);
            }
            foreach ($child_categories as $category) { 
        ?>
                <div class="span3">
                    <div class="about well">
                        <div class="entry-content">
                            <h2><?php echo $category->name; ?></h2>
                            <p><?php echo $category->description; ?></p>
                        </div>
                        <a href="<?php echo get_category_link($category->cat_ID); ?>" class="btn">Link</a>
                    </div>  
                </div>
        <?php } ?>
    <?php } else {?>
        <!-- this is a lower category -->
        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'none' ); ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() ) :
                comments_template();
            endif;
            ?>

        <?php endwhile; // end of the loop. ?>
    <?php } ?>
    <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
