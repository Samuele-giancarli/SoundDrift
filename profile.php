<?php
session_start();
require_once 'bootstrap.php';
require_once("resourceManager.php");

//Base Template
$templateParams["titolo"] = "SoundDrift - Profilo";
$templateParams["nome"] = "profile.php";
$templateParams["utente"] = $dbh->getUserInfo($_GET["utenteCorrente"]);
$templateParams["num_seguiti"] = $dbh->getFollowingOfUser($_GET["utenteCorrente"]);
$templateParams["num_seguaci"] = $dbh->getFollowerOfUser($_GET["utenteCorrente"]);


require 'template/base.php';
?>