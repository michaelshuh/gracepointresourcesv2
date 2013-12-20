<?php
/**
 * @package gracepointresources
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="entry-meta breadcrumb well">
            <?php if(function_exists('pf_show_link')){echo pf_show_link();} ?>
            <?php
            $attachments = new Attachments( 'attachments' );
            if ($attachments->exist() ) {
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
            <a class="download-files" href="<?php echo get_template_directory_uri()."/inc/download.php?File=".$FileName;?>">Download All Attachments</a>
            <?php } ?>
            <?php echo cpa_the_author(); ?>
        </div>

        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'gracepointresources' ),
                'after'  => '</div>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <div class="entry-meta breadcrumb well">
            <?php gracepointresources_posted_on(); ?>
            <?php gracepointresources_post_nav(); ?>
        </div><!-- .entry-meta -->

    <footer class="entry-meta">
        <?php gracepointresources_post_meta(); ?>

        <?php edit_post_link( __( '[Edit]', 'gracepointresources' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article><!-- #post-## -->
