<?php
if (!isset($_SESSION["ID"])){
    die();
}
$idutente=$_SESSION["ID"];
?>
<p title="libreria" class="titolo">Questa è la tua libreria:</p>

<div class="mb-3">
<a title="brani piaciuti" href="braniPiaciuti.php" class="btn btn-dark" style="text-decoration:none">
    <em class="bi bi-heart" style="font-size: 20px"> Vai ai brani che ti piacciono</em>
  </a>
</div>

<div class="mb-3">
<a title="album piaciuti" href="albumPiaciuti.php" class="btn btn-dark" style="text-decoration:none">
    <em class="bi bi-disc" style="font-size: 20px"> Vai agli album salvati</em>
  </a>
</div>

<div class="mb-3">
<a title="playlist piaciute" href="playlistPiaciute.php" class="btn btn-dark" style="text-decoration:none">
    <em class="bi bi-cassette" style="font-size: 20px"> Vai alle playlist salvate</em>
  </a>
</div>

<div class="mb-3">
<a title="crea una playlist" href="playlist.php" class="btn btn-dark" style="text-decoration:none">
    <em class="bi bi-music-note-list" style="font-size: 20px"> Crea una playlist</em>
  </a>
</div>

