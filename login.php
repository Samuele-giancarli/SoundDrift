<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Login";
$templateParams["nome"] = "loginForm.php";

require("template/base.php");

?>
