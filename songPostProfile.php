<?php

require_once("bootstrap.php");
include("template/songForResearch.php");

// Base Template
$templateParams["voceNav"] = "songPostProfile.php";
$templateParams["feedData"] = $dbh->getSongsOfUser($_GET["id"]);

$profileNavPage = true;

require_once("profile.php");


?>