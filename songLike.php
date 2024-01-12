<?php
session_start();
require_once("bootstrap.php");
if (!isset($_SESSION["ID"])){
    die();
}

$idutente=$_SESSION["ID"];
$idcanzone=$_GET["id"];
$dbh ->likeSong($idutente, $idcanzone);
?>