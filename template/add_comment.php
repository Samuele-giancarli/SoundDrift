<?php 
    include "../bootstrap.php";
    session_start();
    require_once("renderComment.php");
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postId = $_POST['postId'];
        $postInfo=$dbh->getPostInfo($postId);
        $idAuthor=$postInfo["ID_Utente"];
        $idUser = $_SESSION['ID'];
        $username = $dbh->getUserInfo($idUser)["Username"];
        $commentText = $_POST['commentText'];

        $commentId = $dbh->insertCommentInPost($idUser, $postId, $commentText);
        $commentInfo = $dbh->getCommentInfo($commentId);

        $dbh->addNotification($idAuthor,$idUser,"ha commentato il tuo ",$postId);
        renderComment($commentInfo, $dbh);
        
    }
?>