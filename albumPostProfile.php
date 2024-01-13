<?php

require_once("bootstrap.php");
include("template/albumForResearch.php");

// Base Template
$templateParams["voceNav"] = "albumPostProfile.php";
$templateParams["feedData"] = $dbh->getAlbumsOfUser($_GET["id"]);

$profileNavPage = true;

require_once("profile.php");


?>