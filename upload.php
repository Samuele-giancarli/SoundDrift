<?php

session_start();
require_once("bootstrap.php");
require_once("resourceManager.php");

$templateParams["titolo"] = "SoundDrift - Upload";
$templateParams["nome"] = "uploadForm.php";

require("template/base.php");

?>