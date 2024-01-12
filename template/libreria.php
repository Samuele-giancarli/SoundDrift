<?php
if (!isset($_SESSION["ID"])){
    die();
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