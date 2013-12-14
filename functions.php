<?php
/**
 * gracepointresources functions and definitions
 *
 * @package gracepointresources
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'gracepointresources_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gracepointresources_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on gracepointresources, use a find and replace
	 * to change 'gracepointresources' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'gracepointresources', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'gracepointresources' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gracepointresources_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // gracepointresources_setup
add_action( 'after_setup_theme', 'gracepointresources_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function gracepointresources_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Post Sidebar', 'gracepointresources' ),
		'id'            => 'post-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget box %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Category Sidebar', 'gracepointresources' ),
		'id'            => 'category-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget box %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'gracepointresources_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gracepointresources_scripts() {
  wp_enqueue_style('gracepointresources-bootstrap', get_template_directory_uri().'/bootstrap/css/bootstrap.css');
  wp_enqueue_style('gracepointresources-bootstrap', get_template_directory_uri().'/bootstrap/css/bootstrap.icon-large.min.css');
  wp_enqueue_style('gracepointresources-bootstrap-responsive',get_template_directory_uri().'/bootstrap/css/bootstrap-responsive.css');
  wp_enqueue_script('gracepointresources-bootstrap',get_template_directory_uri().'/bootstrap/js/bootstrap.min.js',array('jquery'));
	wp_enqueue_style( 'gracepointresources-style', get_stylesheet_uri() );

	wp_enqueue_script( 'gracepointresources-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'gracepointresources-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'gracepointresources-site', get_template_directory_uri() . '/js/site.js', array('jquery'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gracepointresources_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
