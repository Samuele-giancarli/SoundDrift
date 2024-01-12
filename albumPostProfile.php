<?php

require_once("bootstrap.php");
include("template/post.php");

// Base Template
$templateParams["voceNav"] = "albumPostProfile.php";
$templateParams["feedData"] = $dbh->getPostsOfUser($_GET["id"]);

$profileNavPage = true;

require_once("profile.php");


?>