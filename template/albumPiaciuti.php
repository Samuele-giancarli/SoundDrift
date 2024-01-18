
<p class="titolo">Questi sono gli album che hai salvato:</p>

<?php


$idutente=$_SESSION["ID"];

$rows= $dbh -> getLikedAlbums($idutente);
if (!is_null(count($rows))){

    ?>
    <ol class="list-group">
        <?php
    foreach ($rows as $album){
        $albumInfo=$dbh->getAlbumInfo($album["ID_Album"]);
        $idautore=$albumInfo["ID_Utente"];
        $idimmagine=$albumInfo["ID_Immagine"];
        $authorInfo=$dbh->getUserInfo($idautore);
        if (!is_null($idimmagine)){
            echo "<li class=\"list-group-item\"> <a title=\"album\" class=\"link-primary\" href=\"albumPlayer.php?id=".$albumInfo["ID"]."\">".$albumInfo["Titolo"]."</a>".
            " - "."<a title=\"username\" style=\"color:black\" href=\"profile.php?id=".$authorInfo["ID"]."\">".$authorInfo["Username"]."</a>"
            ."<img class=\"img-thumbnail\" id=\"profile-pic\" src=\"download.php?id=".$idimmagine."\" style=\"width: 75px; height: 75px\"></li>";
             }else{
            $idimmagine="default-cover.png";
            echo "<li class=\"list-group-item\"> <a title=\"albumInfo\" class=\"link-primary\" href=\"albumPlayer.php?id=".$albumInfo["ID"]."\">".$albumInfo["Titolo"]."</a>".
            " - "."<a title=\"authorinfo\" style=\"color:black\" href=\"profile.php?id=".$authorInfo["ID"]."\">".$authorInfo["Username"]."</a>"
            ."<img alt=\"albumCover\" class=\"img-thumbnail\" id=\"profile-pic\" src=\"download.php?id=".$idimmagine."\" style=\"width: 75px; height: 75px\"></li>";
        }
}
}
?>
</ol>