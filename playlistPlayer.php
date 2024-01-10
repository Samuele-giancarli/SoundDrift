<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Ascolta";
$templateParams["nome"] = "playlistPlayer.php";

require("template/base.php");

?>