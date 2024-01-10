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
                
                // per adesso:
                    $idImage = 1;
                //
                
                $dbh->addPost($idUser, $Textual, $idImage);
        } catch (PDOException $e) {
            die("Query fallita: ". $e->getMessage());
        }
    } else { 
?>

    <h2>Pubblica un nuovo post</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <textarea name="testo"></textarea><br>
        Immagine: <br>
        <input type="file" name="immagine"><br><br>
        <input type="submit" value="Pubblica">
    </form>
<?php
    }
?>