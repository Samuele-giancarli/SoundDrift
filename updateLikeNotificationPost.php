<?php
    session_start();
    require_once("bootstrap.php");
    if(!isset($_GET["id"]) || !isset($_SESSION["ID"]))
    {
        http_response_code(400);
        die();
    }

    $idPost = $_GET["id"];
    $dbh->addNotificationPost($idPost);
?>