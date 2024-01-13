<?php
    session_start();
    require_once("bootstrap.php");
    if(!isset($_GET["id"]) || !isset($_SESSION["ID"]))
    {
        http_response_code(400);
        die();
    }

    $idPost = $_GET["id"];
    $idUser = $_SESSION["ID"];
    $postInfo=$dbh->getPostInfo($idPost);
    $idAuthor=$postInfo["ID_Utente"];
    if ($dbh->isLikedby($idPost,$idUser)){
        $dbh->updateUnlike($idPost,$idUser);
    }else{
        $dbh->UpdateLike($idPost,$idUser);
        $dbh->addNotification($idAuthor,$idUser,"ha messo like al tuo ",$idPost);
    }
?>