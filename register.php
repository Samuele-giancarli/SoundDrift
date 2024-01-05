<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Home";
$templateParams["nome"] = "registerForm.php";

require("template/base.php");

?>