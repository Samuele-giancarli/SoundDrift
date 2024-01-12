<?php
session_start();
require_once("bootstrap.php");
if (!isset($_SESSION["ID"])){
    die();
}

$idutente=$_SESSION["ID"];
$idplaylist=$_GET["id"];
$dbh ->likePlaylist($idutente, $idplaylist);
?>