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
                            <a href="<?php echo $attachments->url(); ?>" target="_blank"><span><?php echo $attachments->field('title')?><span></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <?php
                    require "inc/create_zip_file.php";
                    $attachments = new Attachments( 'attachments' );
                    $files_to_zip = array();
                    while( $attachments->get() ) {
                        array_push($files_to_zip, $attachments->url());
                    }

                    $zip = new ZipArchive();

                    # create a temp file & open it
                    $uploads = wp_upload_dir(); 
                    $tmp_location = $uploads['path'];
                    $FileName = sanitize_title(get_the_title($post_id)).".zip";
                    $zipFileName = $tmp_location.'/'.$FileName;        
                    $zip->open($zipFileName, ZipArchive::CREATE);

                    # loop through each file
                    foreach($files_to_zip as $file){
                        # download file
                        $download_file = file_get_contents($file);
                        #add it to the zip
                        $zip->addFromString(basename($file),$download_file);
                    }

                    # close zip
                    $zip->close();
?>
                    <a href="<?php echo get_template_directory_uri()."/inc/download.php?File=".$FileName;?>">Download Files as Zip</a>
        </aside>
    <?php endif; ?>
    <?php dynamic_sidebar('post-sidebar');?>
