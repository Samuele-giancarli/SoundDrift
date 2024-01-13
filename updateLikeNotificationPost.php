<?php
    session_start();
    require_once("bootstrap.php");
    if(!isset($_GET["id"]) || !isset($_SESSION["ID"]))
    {
        http_response_code(400);
        die();
    }

    $id_mandante = $_GET["id_man"];
    $idPost = $_GET["id"];
    $dbh->updateNotificationPost($idPost,$id_mandante);
?>