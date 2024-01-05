<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Login";
$templateParams["nome"] = "loginForm.php";

require("template/base.php");

?>

<!-- fare header e footer a parte e metterli static in index, poi inclusi nelle singole pagine -->