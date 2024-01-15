<?php
if (!isset($_SESSION["ID"])){
    die();
}
$idutente=$_SESSION["ID"];
?>
<legend>Questa è la tua libreria:</legend>

<div class="mb-3">
<a href="braniPiaciuti.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-heart" style="font-size: 20px"> Vai ai brani che ti piacciono</i>
  </a>
</div>

<div class="mb-3">
<a href="albumPiaciuti.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-disc" style="font-size: 20px"> Vai agli album salvati</i>
  </a>
</div>

<div class="mb-3">
<a href="playlistPiaciute.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-cassette" style="font-size: 20px"> Vai alle playlist salvate</i>
  </a>
</div>

<div class="mb-3">
<a href="playlist.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-music-note-list" style="font-size: 20px"> Crea una playlist</i>
  </a>
</div>

