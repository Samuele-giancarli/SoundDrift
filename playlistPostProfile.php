<?php

require_once("bootstrap.php");

// Base Template
$templateParams["voceNav"] = "playlistPostProfile.php";
$templateParams["playlists"] = $dbh->getPlaylistsOfUser($_GET["id"]);

$profileNavPage = true;

require_once("profile.php");


?>