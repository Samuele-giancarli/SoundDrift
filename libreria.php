<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Libreria";
$templateParams["nome"] = "libreria.php";

require("template/base.php");

?>