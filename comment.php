<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Commenti";
$templateParams["nome"] = "comment.php";

require("template/base.php");

?>