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
                <div class="site-info">
                    <?php printf( __( 'Copyright &copy: %1$s', 'gracepointresources' ), get_bloginfo('sitename')); ?>
                </div><!-- .site-info-->
            </div><!-- .row-->
            <div class="row">
                <div class="feedback">
                    <a href="mailto:michael.shuh@gpmail.org?Subject=Feedback for GracepointResources">Send Feedback</a>
                </div>
            </div>
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
