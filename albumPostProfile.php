<?php

require_once("bootstrap.php");

// Base Template
$templateParams["voceNav"] = "albumPostProfile.php";
$templateParams["albums"] = $dbh->getAlbumsOfUser($_GET["utenteCorrente"]);

require_once("profile.php");


?>