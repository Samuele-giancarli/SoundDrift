<?php
if (!isset($_GET["id"])){
    die();
}
$idalbum=$_GET["id"];
$info=$dbh->getAlbumInfo($idalbum);
$userInfo=$dbh->getUserInfo($info["ID_Utente"]);
?>

<div>Titolo: <?php echo $info["Titolo"]; ?></div>
<div>Genere: <?php echo $info["Genere"]; ?></div>

<?php 
if (!is_null($info["ID_Immagine"])){
?>
<div>Copertina: <img <?php echo "src=\"download.php?id=".$info["ID_Immagine"]."\""; ?>  id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" /></div>
<?php
}
?>

<div>Brani: </div>