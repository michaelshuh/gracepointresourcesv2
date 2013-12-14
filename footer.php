<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package gracepointresources
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="footer" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class='citation'>
                    <a href="http://www.glyphicons.com">Glyphicons</a>
                </div>
                <div class="site-info">
                    <?php printf( __( 'Copyright &copy: %1$s', 'gracepointresources' ), get_bloginfo('sitename')); ?>
                </div><!-- .site-info-->
            </div><!-- .row-->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
