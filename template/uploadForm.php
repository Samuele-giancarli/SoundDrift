<?php
    $show_form = false;
    $err_mess = null;
    
    // Verifica se l'utente è già loggato
    if (!isset($_SESSION["ID"])) {
        $err_mess = "Devi effettuare l'accesso per pubblicare un post.";
        echo $err_mess;
    } else if($_SERVER["REQUEST_METHOD"] === "POST") {
        try {            
            $idUser = $_SESSION["ID"];
            $Textual = $_POST["testo"];
            $idImage = null;
            $img = $_FILES["immagine"];

            $idImage = uploadSource($dbh, $img);
            $dbh->addPost($idUser, $Textual, $idImage);

            echo "post avvenuto con successo";
        } catch (PDOException $e) {
            die("Query fallita: ". $e->getMessage());
        }
    } else { 
?>

    <h2>Pubblica un nuovo post</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <textarea name="testo"></textarea><br>
        Immagine: <br>
        <input type="file" name="immagine" accept="image/jpeg,image/png,image/webp,image/avif"><br><br>
        <input type="submit" value="Pubblica">
    </form>
<?php
    }
?>