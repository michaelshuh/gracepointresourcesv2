<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package gracepointresources
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
        <aside id="attachments" class="widget box">
            <?php $attachments = new Attachments( 'attachments' ); /* pass the instance name */ ?>
            <?php if( $attachments->exist() ) : ?>
                <h3>Attachments</h3>
                <ul>
                    <?php while( $attachments->get() ) : ?>
                        <li>
                            <a href="<?php $attachments->url();?>" target="_blank"><?php echo $attachments->image('thumbnail');?><span class="offset1"><?php echo $attachments->field('title')?><span></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </aside>
	</div><!-- #secondary -->
