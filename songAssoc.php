<?php
session_start();
require_once("bootstrap.php");
if (!isset($_SESSION["ID"])){
    die();
}

$idutente=$_SESSION["ID"];
$idplaylist=$_GET["id"];
$idcanzone=$_GET["songid"];
$dbh->addSongToPlaylist($idcanzone, $idplaylist);
header("Location: songPlayer.php?id=".$idcanzone);
?>