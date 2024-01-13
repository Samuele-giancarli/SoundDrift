<?php
session_start();
require_once("bootstrap.php");
if (!isset($_SESSION["ID"])){
    die();
}

$idcanzone=$_GET["idsong"];
$idplaylist=$_GET["idplaylist"];
$queryused=$_GET["queryused"];
$dbh ->addSongToPlaylist($idcanzone, $idplaylist);
header("Location: addToPlaylist.php?id=".$idplaylist."&query=".$queryused);
?>