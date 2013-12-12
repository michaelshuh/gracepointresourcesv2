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


<div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main">
    <?php if(is_category()): ?>
    <?php
        $current_categoryID = $cat;
        $current_category = get_category($current_categoryID);
    ?>
    <?php if ($current_category->parent == 0): ?>
    <?php
            $child_categories = array();
            foreach (get_categories("hide_empty=0&parent=$current_categoryID") as $child_category) {
                array_push($child_categories, $child_category);
            }
    ?>
        <div class="row">
            <form class="form-inline" method="get" id="searchform" action="<?php get_category_link($current_categoryID); ?>/">
                <select id="search-context" name="search-context" class="span2">
                    <option value="<?php get_category_link($current_categoryID); ?>"><?php echo $current_category->name; ?></option>
                    <?php
                    foreach ($child_categories as $category) { ?>
                        <option value="<?php echo get_category_link($category->cat_ID) ?>"><?php echo $category->name; ?></option>
                    <?php } ?>
                </select>


                <input type="text" size="18" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" class="span8" />
                <input type="submit" id="searchsubmit" value="Search" class="btn" />
            </form>
        </div>
        <!-- Script for search -->
        <script type="text/javascript">
            jQuery("#search-context").change(function(changeEvent) {
                var dropdownURL = jQuery("#search-context").val();
                jQuery("#searchform").attr("action", dropdownURL)
            });
        </script>

        <?php gracepointresources_category_rss_link($current_category) ?>

        <?php foreach ($child_categories as $category) { ?>
                <div class="span3">
                    <div class="about well">
                        <div class="entry-content">
                            <h2><?php echo $category->name; ?></h2>
                            <p><?php echo $category->description; ?></p>
                            <!-- Category Image -->
                            <img src="<?php category_image_src(array("term_id" => $category->cat_ID),true); ?>" />
                        </div>
                        <a href="<?php echo get_category_link($category->cat_ID); ?>" class="btn">Link</a>
                    </div>  
                </div>
        <?php } ?>
    <?php else : //else lower category?>
        <!-- this is a lower category -->
            <div class="span7 pull-left">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', get_post_format()); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; // end of the loop. ?>
            </div>
            <div class="pull-left span4">
                <?php dynamic_sidebar( 'category-sidebar' ); ?> 
            </div>
        <?php endif;  ?>
    <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
