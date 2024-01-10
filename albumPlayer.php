<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Ascolta";
$templateParams["nome"] = "albumPlayer.php";

require("template/base.php");

?>