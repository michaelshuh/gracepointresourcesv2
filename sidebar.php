<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package gracepointresources
 */
?>
    <?php $attachments = new Attachments( 'attachments' ); /* pass the instance name */ ?>
    <?php if( $attachments->exist() ) : ?>
        <aside id="attachments" class="widget box">
                <h3>Attachments</h3>
                <ul>
                    <?php while( $attachments->get() ) : ?>
                        <li>
                            <a href="<?php echo $attachments->url(); ?>" target="_blank"><?php echo $attachments->image('thumbnail');?><span class="offset1"><?php echo $attachments->field('title')?><span></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
        </aside>
    <?php endif; ?>
    <?php dynamic_sidebar('post-sidebar');?>
