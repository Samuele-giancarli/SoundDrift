<?php
    require_once("bootstrap.php");
    if(!isset($_POST["idPost"]) || !isset($_POST["idUser"]))
    {
        http_response_code(400);
        die();
    }
    $idPost = $_POST['idPost'];
    $idUser = $_POST['idUser'];

    echo $idPost;
    echo $idUser;

    $dbh->updateLike($idPost,$idUser);
    echo "dbh updateAto";
?>