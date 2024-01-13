
<?php 
    include "../bootstrap.php";
    session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postId = $_POST['postId'];
    $idUser = $_SESSION['ID'];
    $commentText = $_POST['commentText'];

    $dbh->insertCommentInPost($idUser, $postId, $commentText);

    // Puoi anche restituire un messaggio di successo o altro se necessario
    echo 'Commento aggiunto con successo!';
}
?>