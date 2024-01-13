<?php 
    include "../bootstrap.php";
    session_start();
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $postId = $_POST['postId'];
        $idUser = $_SESSION['ID'];
        $username = $dbh->getUserInfo($idUser)["Username"];
        $commentText = $_POST['commentText'];

        $dbh->insertCommentInPost($idUser, $postId, $commentText);
        $response = array(
            'username' => $username,
            'commentText' => $commentText
        );

        // Convertire l'array associativo in una stringa JSON
        echo json_encode($response);
        exit();  // Assicurati di terminare l'esecuzione dello script dopo l'invio della risposta JSON
    }
?>