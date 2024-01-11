<?php
if (!isset($_GET["id"])){
    die();
}
$idalbum=$_GET["id"];
$info=$dbh->getAlbumInfo($idalbum);
$userInfo=$dbh->getUserInfo($info["ID_Utente"]);
?>

<div>Titolo: <?php echo $info["Titolo"]; ?></div>
<div>Autore: <?php echo "<a style=\"color:black\" href=\"profile.php?id=".$userInfo["ID"]."\">".htmlentities($userInfo["Username"])."</a>"; ?></div>
<div>Genere: <?php echo $info["Genere"]; ?></div>

<?php 
if (!is_null($info["ID_Immagine"])){
?>
<div>Copertina: <img <?php echo "src=\"download.php?id=".$info["ID_Immagine"]."\""; ?>  id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" /></div>
<?php
}
?>

<div>Brani: </div>

<ol>
<?php
foreach ($dbh -> getSongsFromAlbum($idalbum) as $song){
    echo "<li><a style=\"color: black;\" href=\"songPlayer.php?id=".$song["ID"]."\">".htmlentities($song["Titolo"])."</a>";
    echo " <button type=\"button\" onclick=\"";
    echo "window.parent.playNow({";
    echo "'title': '".htmlentities($song["Titolo"])."',";
    $userInfo = $dbh->getUserInfo($song["ID_Utente"]);
    echo "'author': '".htmlentities($userInfo["Username"])."',";
    echo "'url': 'download.php?id=".$song["ID_Audio"]."'";
    echo "});";
    echo "\">Riproduci</button></li>";
}
?>
</ol>