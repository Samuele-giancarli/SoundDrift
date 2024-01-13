<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Settings";
$templateParams["nome"] = "settings.php";

require("template/base.php");

?>
