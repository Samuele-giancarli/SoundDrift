<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Ricerca";
$templateParams["nome"] = "ricerca.php";

require("template/base.php");

?>