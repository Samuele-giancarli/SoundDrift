<?php

session_start();

require_once("bootstrap.php");

$templateParams["titolo"] = "SoundDrift - Home";
$templateParams["nome"] = "feed.php";

$templateParams["post"] = $dbh->getUser($_SESSION["ID"]);

$templateParams["feedData"] = $dbh->getFeed($_SESSION["ID"]);

require("template/base.php");


?>

<!-- fare header e footer a parte e metterli static in index, poi inclusi nelle singole pagine -->