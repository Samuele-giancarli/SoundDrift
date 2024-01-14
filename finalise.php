<?php
session_start();
require_once("bootstrap.php");
if (!isset($_SESSION["ID"])){
    die();
}

$stmt = $dbh->db->prepare("UPDATE album SET Finalizzato=1 WHERE ID_Utente=? AND ID=?");
$idutente=$_SESSION["ID"];
$idalbum=$_GET["id"];
$albumInfo=$dbh->getAlbumInfo($idalbum);
$titolo=$albumInfo["Titolo"];
$genere=$albumInfo["Genere"];
$idimmagine=$albumInfo["ID_Immagine"];
$stmt->bind_param("ii", $idutente, $idalbum);
$stmt->execute();
$dbh->addPost($idutente, "", $idimmagine, null, $idalbum);
header("Location: albumCreate.php");
?>