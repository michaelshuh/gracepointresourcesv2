<?php
if(isset($_REQUEST['File']) && !empty($_REQUEST['File'])){
    define('WP_USE_THEMES', false);
    require('../../../../wp-load.php');    
    $uploads = wp_upload_dir(); 
    $tmp_location = $uploads['path']."/".$_REQUEST['File'];
    header('Content-disposition: attachment; filename=download.zip');
    header('Content-Description: File Transfer');
    header('Content-type: application/zip');
    readfile($tmp_location);
}
?>
