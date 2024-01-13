
<?php 


foreach ($templateParams["feedData"] as $song){
    $idsong=$song["ID"];
    renderSong($song, $dbh);
    }
?>