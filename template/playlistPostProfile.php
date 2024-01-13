
<?php 


foreach ($templateParams["feedData"] as $playlist){
    $idplaylist=$playlist["ID"];
    renderPlaylist($playlist, $dbh);
    }
?>