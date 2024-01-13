<?php

require_once("bootstrap.php");
include("template/playlistForResearch.php");

// Base Template
$templateParams["voceNav"] = "playlistPostProfile.php";
$templateParams["feedData"] = $dbh->getPlaylistsOfUser($_GET["id"]);

$profileNavPage = true;

require_once("profile.php");


?>