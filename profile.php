<?php
session_start();
require_once 'bootstrap.php';
require_once("resourceManager.php");

if(!isset($profileNavPage)) {
    include("template/post.php");
    $templateParams["voceNav"] = "allPostProfile.php";
    $templateParams["feedData"] = $dbh->getPostsOfUser($_GET["id"]);
}

//Base Template
$templateParams["titolo"] = "SoundDrift - Profilo";
$templateParams["nome"] = "profile.php";
$templateParams["utente"] = $dbh->getUserInfo($_GET["id"]);
$templateParams["num_seguiti"] = $dbh->getFollowingOfUser($_GET["id"]);
$templateParams["num_seguaci"] = $dbh->getFollowerOfUser($_GET["id"]);


require 'template/base.php';
?>