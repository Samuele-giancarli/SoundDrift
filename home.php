<?php

session_start();

require_once("bootstrap.php");
include("template/post.php");

$templateParams["titolo"] = "SoundDrift - Home";
$templateParams["nome"] = "feed.php";

if (isset($_SESSION["ID"])) {
    $templateParams["feedData"] = $dbh->getFeed($_SESSION["ID"]);
    $templateParams["ID_Visualizer"] = $_SESSION["ID"];
} else {
    $templateParams["feedData"] = $dbh->getMostLiked();
    $templateParams["ID_Visualizer"] = null;
}


require("template/base.php");

?>

<!-- fare header e footer a parte e metterli static in index, poi inclusi nelle singole pagine -->