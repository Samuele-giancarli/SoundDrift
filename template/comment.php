<?php
$postId = $_GET["id"];  // Sostituire con l'ID del post corrente
$comments = $dbh->getCommentsForPost($postId);

foreach ($comments as $comment) {
    echo '<div class="comment">';
    echo '<p>' . $comment['Testo'] . '</p>';
    echo '</div>';
}
?>
<!-- Modulo per aggiungere un nuovo commento -->
<div id="commentForm">
    <label for="commentText">Inserisci il tuo commento:</label>
    <textarea id="commentText" name="commentText"></textarea>
    <button onclick="addComment()">Invia Commento</button>
</div>

<div id="commentsContainer">

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
                // Aggiorna la visualizzazione dei commenti senza ricaricare la pagina
                let commentsContainer = document.getElementById('commentsContainer');
                commentsContainer.innerHTML = xhr.responseText;

                // Pulisci il campo di testo del commento dopo l'invio
                document.getElementById('commentText').value = '';
            }
        }
        // Invia i dati nella richiesta
        xhr.send('postId=' + encodeURIComponent(postId) + '&commentText=' + encodeURIComponent(commentText));
    }
</script>