<?php

session_start();

require_once("bootstrap.php");
include("template/notification.php");

$templateParams["titolo"] = "SoundDrift - Notifiche";
$templateParams["nome"] = "notificationsForm.php";

require("template/base.php");

?>