<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Home";
$templateParams["nome"] = "loginForm.php";

require("template/base.php");

?>

<!-- fare header e footer a parte e metterli static in index, poi inclusi nelle singole pagine -->