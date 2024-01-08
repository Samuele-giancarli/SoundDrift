<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Nuovo Album";
$templateParams["nome"] = "albumCreate.php";

require("template/base.php");

?>