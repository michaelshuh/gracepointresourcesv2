<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package gracepointresources
 */

if ( ! function_exists( 'gracepointresources_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function gracepointresources_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'gracepointresources' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gracepointresources' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gracepointresources' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'gracepointresources_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function gracepointresources_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = get_adjacent_post( TRUE, '', TRUE );
	$next     = get_adjacent_post( TRUE, '', FALSE );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav id="nav-single" class="navigation post-navigation" role="navigation">
        <?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> Previous Post', 'Previous post link', 'gracepointresources' ) ); ?>
        <?php next_post_link(     '%link', _x( 'Next Post <span class="meta-nav">&rarr;</span>', 'Next post link',     'gracepointresources' ) ); ?>
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'gracepointresources_post_meta' ) ) :
/**
 * Display the meta data ribbon for each post.
 *
 * @return void
 */
function gracepointresources_post_meta() {
?>
    <div class="well tags">
    	<?php printLikes(get_the_ID()); ?>
        <span class="pull-right span4 offset1"><?php the_tags('Tags: ',' , '); ?></span>
        <span class="pull-right span4 offset1">Categories: <?php echo get_the_category_list(','); ?></span>
        <div class="clear"></div>
    </div>
    <!--<div class="well author-box">
        <div class="media">
            <div class="pull-left">
                <?php echo get_avatar( get_the_author_meta('ID'), 90 ); ?>
            </div>
            <div class="media-body">  
                <span class="txt">
                    <i class="icon icon-edit"></i> About Author: <?php echo get_the_author_meta('display_name'); ?>
                </span>
                <div class="clear"></div>
                <?php echo get_the_author_meta('description'); ?>
            </div>
        </div>
    </div>-->

<?php
}
endif;

if ( ! function_exists( 'gracepointresources_category_display' ) ) :
/**
 * Display the category well box
 *
 * @return void
 */
function gracepointresources_category_display($category) {
?>
    <div class="span3">
        <div class="about well">
            <div class="entry-content">
                <h2 style="display: inline-block;"><a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->name; ?></a></h2>
                    <a href="<?php echo "/category/$category->slug/rss2" ?>">
                        <div class="rss-image"></div>
                    </a>
                <!-- Category Most Popular -->
                <?php 
                    $most_liked = get_most_liked_posts_by_category($category->cat_ID, 5);
                    if ($most_liked):
                        global $post;
                        print '<div class="most_liked">';
                            print "<h3>Most Liked Posts</h3>";
                            print "<ul>";
                            foreach ($most_liked as $post):
                                setup_postdata($post);
                            ?>
                                <li><a href="<?php
                                the_permalink();
                            ?>" rel="bookmark" title="Permanent Link to <?php
                                the_title();
                            ?>">
                                <?php
                                the_title();
                            ?></a> (<?php
                                    print get_post_meta(get_the_id(), "_likes", 1);
                                    echo __(' likes', 'like_this');
                                    ?> )</li>
                                <?php
                                endforeach;
                            print "</ul>";
                        print "</div>";
                    endif;
                ?>
            </div>
        </div>
    </div>
<?php
}
endif;

if ( ! function_exists( 'gracepointresources_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function gracepointresources_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'gracepointresources' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'gracepointresources' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'gracepointresources' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'gracepointresources' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'gracepointresources' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'gracepointresources' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for gracepointresources_comment()

if ( ! function_exists( 'gracepointresources_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function gracepointresources_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

    global $post;
    $author_name = get_post_meta( $post->ID, 'cpa_author', TRUE );
    $author_email = get_post_meta( $post->ID, 'cpa_author_url', TRUE );

    $posted_by = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_html( get_the_author() )
    );

    if (!empty($author_name)) {
        $posted_by = sprintf( '<span class="author vcard"><a class="url fn n" href="mailto:%1$s?Subject=Gracepoint Resources: %2$s">%3$s</a></span>',
            $author_email,
            get_the_title($post->ID),
            $author_name
        );
    }

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> / Posted by %2$s</span>', 'gracepointresources' ),
		sprintf( '%1$s',
			$time_string
		),
	    $posted_by
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function gracepointresources_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so gracepointresources_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so gracepointresources_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'gracepointresources_custom_search_form' ) ) :
/**
 * Prints our own customized search form
 */
function gracepointresources_custom_search_form($category) {
?>
<div class="search-field">
    <form class="form-inline" method="get" id="searchform" action="<?php bloginfo('home'); ?>">
        <div class="row">
            <div class="span3 search-font"> Search for… </div>
        </div>
        <input class="search-bar" name="s" id="s"/>
        <select class=" search-dropdown" id="cat" name="cat">
            <option value="<?php bloginfo('home'); ?>">All</option>
            <option value="<?php echo $category->cat_ID ?>"><?php echo $category->name; ?>  (<?php echo $category->category_count; ?>)</option>
        </select>

        <input class="search-button" type="submit" id="searchsubmit" value="Search"/>
    </form>
    <script type="text/javascript">
        jQuery("#search-context").change(function(changeEvent) {
            var dropdownURL = jQuery("#search-context").val();
            jQuery("#searchform").attr("action", dropdownURL)
        });
    </script>
</div>
<?php
}
endif;

/**
 * Flush out the transients used in gracepointresources_categorized_blog.
 */
function gracepointresources_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}

add_action( 'edit_category', 'gracepointresources_category_transient_flusher' );
add_action( 'save_post',     'gracepointresources_category_transient_flusher' );
