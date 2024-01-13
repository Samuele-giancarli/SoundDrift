<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Playlist";
$templateParams["nome"] = "addToPlaylist.php";

require("template/base.php");

?>