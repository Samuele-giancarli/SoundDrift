<?php
session_start();
if (!isset($_SESSION["ID"])){
    die();
}
$db = new mysqli("127.0.0.1", "root", "", "sounddrift", 3306);
$stmt = $db->prepare("UPDATE album SET Finalizzato=1 WHERE ID_Utente=? AND ID=?");
$idutente=$_SESSION["ID"];
$idalbum=$_GET["id"];
$stmt->bind_param("ii", $idutente, $idalbum);
$stmt->execute();
$db->close();
header("Location: albumCreate.php");
?>