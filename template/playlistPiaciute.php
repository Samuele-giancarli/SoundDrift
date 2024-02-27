<p title="playlist salvate" class="titolo">Queste sono le playlist che hai salvato:</p>

<ol class="list-group">
<?php
$idutente=$_SESSION["ID"];
$rows= $dbh -> getLikedPlaylists($idutente);
if (!is_null(count($rows))){
    foreach ($rows as $playlist){
        $playlistInfo=$dbh->getPlaylistInfo($playlist["ID_Playlist"]);
        $idautore=$playlistInfo["ID_Utente"];
        $idimmagine=$playlistInfo["ID_Immagine"];
        $authorInfo=$dbh->getUserInfo($idautore);
        if (!is_null($idimmagine)){
        echo "<li class=\"list-group-item\"> <a class=\"link-primary\" href=\"playlistPlayer.php?id=".$playlistInfo["ID"]."\">".$playlistInfo["Titolo"]."</a>".
        " - "."<a style=\"color:black\" href=\"profile.php?id=".$authorInfo["ID"]."\">".$authorInfo["Username"]."</a>"
        ."<img class=\"img-thumbnail\" src=\"download.php?id=".$idimmagine."\" style=\"width: 75px; height: 75px\"></li>";
         }else{
        echo "<li class=\"list-group-item\"> <a class=\"link-primary\" href=\"playlistPlayer.php?id=".$playlistInfo["ID"]."\">".$playlistInfo["Titolo"]."</a>".
        " - "."<a style=\"color:black\" href=\"profile.php?id=".$authorInfo["ID"]."\">".$authorInfo["Username"]."</a>"
        ."<img class=\"img-thumbnail\" src=\"images/App_images/default-cover.png\" style=\"width: 75px; height: 75px\"></li>";
    }
}
}
?>
</ol>
