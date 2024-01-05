<?php
session_start();

require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "SoundDrift - Profilo";
$templateParams["nome"] = "profile.php";
$templateParams["utente"] = $dbh->getUser($_SESSION["email"]);

require 'template/base.php';
?>