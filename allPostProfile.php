<?php

require_once("bootstrap.php");
include("template/post.php");

// Base Template
$templateParams["voceNav"] = "allPostProfile.php";
$templateParams["feedData"] = $dbh->getPostsOfUser($_GET["id"]);

require_once("profile.php");
?>