<?php
session_start();
require_once("bootstrap.php");
if (!isset($_SESSION["ID"])){
    die();
}

$idutente=$_SESSION["ID"];
$idalbum=$_GET["id"];
$dbh ->likeAlbum($idutente, $idalbum);
?>