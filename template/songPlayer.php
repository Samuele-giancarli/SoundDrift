<script>
function duration() {
    let audio = document.getElementById("song");
    let durataElement = document.getElementById("durata");
    let durata = audio.duration | 0;
    let ore = (durata / 3600) | 0;
    durata -= ore * 3600;
    let minuti = (durata / 60) | 0;
    let secondi = durata % 60;
    if (ore!=0){
    durataElement.innerText = "Durata: " + ore + "h" + minuti + "m" + secondi + "s";
    }else{
    durataElement.innerText = "Durata: " + minuti + "m" + secondi + "s";
    }
}

function play(){
    let audio = document.getElementById("song");
    audio.play();
}
</script>

<?php

if (!isset($_GET["id"])){
    die();
}

$idcanzone=$_GET["id"];
$info=$dbh->getSongInfo($idcanzone);

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

<?php
$audioInfo = $dbh->getResourceInfo($info["ID_Audio"]);
?>
<div>Brano: <audio id="song">
<source
<?php
echo "src=\"download.php?id=".$audioInfo["ID"]."\" ";
echo "type=\"".$audioInfo["MimeType"]."\"";
?>
>
</source>
</audio></div>

<?php 
if (!is_null($info["ID_Album"])){
    $albumInfo=$dbh->getAlbumInfo($info["ID_Album"]);
?>
<div>Album di appartenenza: <?php echo $albumInfo["Titolo"]; ?></div>
<?php
}
?>

<div id="durata"></div>

<button type="button" onclick="play();">Play</button>
<script>
let audio = document.getElementById("song");
audio.oncanplaythrough = duration;
</script>