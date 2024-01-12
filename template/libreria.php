<?php
if (!isset($_SESSION["ID"])){
    die();
}
?>
  <a href="playlist.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-music-note-list" style="font-size: 20px">Vai alle playlist</i>
  </a>

  <p>Queste sono le tue playlist salvate!</p>

<?php


$idutente=$_SESSION["ID"];

$rows= $dbh -> getLikedPlaylists($idutente);
if (!is_null(count($rows))){
    foreach ($rows as $playlist){
        $playlistInfo=$dbh->getPlaylistInfo($playlist["ID_Playlist"]);
        $idautore=$playlistInfo["ID_Utente"];
        $idimmagine=$playlistInfo["ID_Immagine"];
        $authorInfo=$dbh->getUserInfo($idautore);
        echo "<a style=\"color:black\" href=\"playlistPlayer.php?id=".$playlistInfo["ID"]."\">".$playlistInfo["Titolo"]."</a>".
        " - "."<a style=\"color:black\" href=\"profile.php?id=".$authorInfo["ID"]."\">".$authorInfo["Username"]."</a>". 
        "<img class=\"img-thumbnail\" id=\"profile-pic\" src=\"download.php?id=".$idimmagine."\" style=\"width: 150px; height: 150px\">";
        echo "<br>";
    }
}
?>

<p>Questi sono gli album che ti piacciono!</p>

<?php


$idutente=$_SESSION["ID"];

$rows= $dbh -> getLikedAlbums($idutente);
if (!is_null(count($rows))){
    foreach ($rows as $album){
        $albumInfo=$dbh->getAlbumInfo($album["ID_Album"]);
        $idautore=$albumInfo["ID_Utente"];
        $idimmagine=$albumInfo["ID_Immagine"];
        $authorInfo=$dbh->getUserInfo($idautore);
        echo "<a style=\"color:black\" href=\"albumPlayer.php?id=".$albumInfo["ID"]."\">".$albumInfo["Titolo"]."</a>".
        " - "."<a style=\"color:black\" href=\"profile.php?id=".$authorInfo["ID"]."\">".$authorInfo["Username"]."</a>". 
        "<img class=\"img-thumbnail\" id=\"profile-pic\" src=\"download.php?id=".$idimmagine."\" style=\"width: 150px; height: 150px\">";
        echo "<br>";
    }
}
?>
