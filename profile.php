<?php
session_start();
require_once 'bootstrap.php';
require_once("resourceManager.php");

if(!isset($profileNavPage)) {
    include("template/post.php");
    $templateParams["voceNav"] = "allPostProfile.php";
    $templateParams["feedData"] = $dbh->getPostsOfUser($_GET["id"]);
}

if (isset($_SESSION["ID"])) {
    $templateParams["ID_Visualizer"] = $_SESSION["ID"];
} else {
    $templateParams["ID_Visualizer"] = null;
}

//Base Template
$templateParams["titolo"] = "SoundDrift - Profilo";
$templateParams["nome"] = "profile.php";
$templateParams["utente"] = $dbh->getUserInfo($_GET["id"]);


require 'template/base.php';
?>