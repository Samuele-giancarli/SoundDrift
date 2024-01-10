<?php
    $err_mess = null;
    
    // Verifica se l'utente è già loggato
    if (!isset($_SESSION["ID"])) {
        $err_mess = "Devi effettuare l'accesso per pubblicare un post.";
    } elseif($_SERVER["REQUEST_METHOD"] === "POST") {          
        $idUser = $_SESSION["ID"];
        $textual = $_POST["testo"];
        $idImage = null;
        $img = $_FILES["immagine"];
        if (($img["error"]!=0)&&($textual=="")) {
            $err_mess="Il post non può essere vuoto.";
        } else {
            try {
                $idImage = uploadSource($dbh, $img);
                $dbh->addPost($idUser, $textual, $idImage);
                $err_mess= "Post avvenuto con successo.";
            } catch (PDOException $e) {
                $err_mess="Query fallita: "; $e->getMessage();
            }
        }
    }
?>

<h2>Pubblica un nuovo post</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <textarea name="testo"></textarea><br>
        Immagine: <br>
        <input type="file" name="immagine" accept="image/jpeg,image/png,image/webp,image/avif"><br><br>
        <input type="submit" value="Pubblica">
    </form>
<?php

if(!is_null($err_mess)) {
    echo $err_mess;
}
?>
