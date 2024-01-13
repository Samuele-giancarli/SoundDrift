<!-- Modulo per aggiungere un nuovo commento -->
<?php
$postId = $_GET["id"]; 
$postInfo=$dbh->getPostInfo($postId);
renderPost($postInfo,$dbh,$_SESSION["ID"]);
?>

<div class="row justify-content-center" id="commentForm">
    <label for="commentText">Inserisci il tuo commento:</label>
    <textarea id="commentText" name="commentText"></textarea>
    <button onclick="addComment()">Invia Commento</button>
</div>

<div id="commentsContainer">
    <?php
    // Mostra i commenti esistenti
 // Sostituire con l'ID del post corrente
    $comments = $dbh->getCommentsForPost($postId);
    if (!is_null($comments)){
    foreach ($comments as $comment) {
        renderComment($comment, $dbh);
    }
}
    ?>
</div>

<script>
    function addComment() {
        let commentText = document.getElementById('commentText').value;
        let postId = <?php echo $postId; ?>;

        // Crea una nuova istanza di XMLHttpRequest
        let xhr = new XMLHttpRequest();

        // Configura la richiesta
        xhr.open('POST', './template/add_comment.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Gestisci la risposta dalla richiesta
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let commentsContainer = document.getElementById('commentsContainer');
                commentsContainer.innerHTML += xhr.response;
                // Pulisci il campo di testo del commento dopo l'invio
                document.getElementById('commentText').value = '';
            }
        };

        // Invia i dati nella richiesta
        xhr.send('postId=' + encodeURIComponent(postId) + '&commentText=' + encodeURIComponent(commentText));
    }
</script>