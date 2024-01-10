<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Playlist";
$templateParams["nome"] = "playlist.php";

require("template/base.php");

?>