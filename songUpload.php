<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Nuova Canzone";
$templateParams["nome"] = "songUpload.php";

require("template/base.php");

?>