
<?php 
foreach ($templateParams["feedData"] as $album){
    $idalbum=$album["ID"];
    renderAlbum($album, $dbh);
    }
?>