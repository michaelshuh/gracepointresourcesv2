<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package gracepointresources
 */
?>

<section class="no-results not-found container">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'gracepointresources' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'gracepointresources' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>
			<?php get_search_form(); ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gracepointresources' ); ?></p>


		<?php else : ?>
			<?php get_search_form(); ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'gracepointresources' ); ?></p>


		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->


