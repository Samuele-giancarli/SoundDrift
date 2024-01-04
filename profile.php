<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "SoundDrift - Profilo";
$templateParams["nome"] = "profile.php";
$templateParams["utente"] = $dbh->getUserInSession();

require 'template/base.php';
?>