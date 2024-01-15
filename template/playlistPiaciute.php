<legend>Queste sono le playlist che hai salvato:</legend>

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
        ."<img class=\"img-thumbnail\" id=\"profile-pic\" src=\"download.php?id=".$idimmagine."\" style=\"width: 75px; height: 75px\"></li>";
         }else{
        $idimmagine="default-cover.png";
        echo "<li class=\"list-group-item\"> <a class=\"link-primary\" href=\"playlistPlayer.php?id=".$playlistInfo["ID"]."\">".$playlistInfo["Titolo"]."</a>".
        " - "."<a style=\"color:black\" href=\"profile.php?id=".$authorInfo["ID"]."\">".$authorInfo["Username"]."</a>"
        ."<img class=\"img-thumbnail\" id=\"profile-pic\" src=\"download.php?id=".$idimmagine."\" style=\"width: 75px; height: 75px\"></li>";
    }
}
}
?>
</ol>
