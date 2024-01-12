<?php
if (!isset($_SESSION["ID"])){
    die();
}
$idutente=$_SESSION["ID"];
?>
<a href="braniPiaciuti.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-heart" style="font-size: 20px">Vai ai brani che ti piacciono</i>
  </a>
<br>
<a href="albumPiaciuti.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-disc" style="font-size: 20px">Vai agli album salvati</i>
  </a>
<br>
<a href="playlistPiaciute.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-cassette" style="font-size: 20px">Vai alle playlist salvate</i>
  </a>
<br>
<a href="playlist.php" class="btn btn-dark" style="text-decoration:none">
    <i class="bi bi-music-note-list" style="font-size: 20px">Vai alle tue playlist</i>
  </a>

