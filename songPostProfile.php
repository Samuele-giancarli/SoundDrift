<?php


require_once("bootstrap.php");

// Base Template
$templateParams["voceNav"] = "songPostProfile.php";

$templateParams["songs"] = $dbh->getSongsOfUser($_GET["utenteCorrente"]);

require_once("profile.php");


?>