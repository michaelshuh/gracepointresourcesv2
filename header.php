<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package gracepointresources
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

    <div class="navbar-wrapper">
    <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
        <div class="container" id="topmenu">

            <div class="navbar">
                <div class="navbar-inner">
    <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('sitename'); ?></a>
    <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                </div><!-- /.navbar-inner -->
            </div><!-- /.navbar -->
        </div> <!-- /.container -->
        <?php if(is_archive()): ?>
            <div class="container">
                <div class="arc-header">
                    <h1 class="entry-title pull-right">
                        <?php if(is_category()) : ?>
                        <?php echo single_cat_title( '', false ); ?>
                        <?php endif; ?>
                    </h1>
                </div>
            </div>
        <?php endif; ?>
        <?php shailan_dropdown_menu(); ?>
    </div><!-- /.navbar-wrapper -->

	<div id="content" class="site-content">
