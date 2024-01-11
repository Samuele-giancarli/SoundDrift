<?php

require_once("bootstrap.php");
include("template/post.php");

// Base Template
$templateParams["voceNav"] = "songPostProfile.php";

$templateParams["songs"] = $dbh->getPostsOfUser($_GET["utenteCorrente"]);

require_once("profile.php");


?>