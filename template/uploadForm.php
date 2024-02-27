<?php

function jsescape($s) {
    return str_replace("'", "\\'", $s);
}

    $err_mess = null;
    $success=null;
    
    // Verifica se l'utente è già loggato
    if (!isset($_SESSION["ID"])) {
        $err_mess = "Devi effettuare l'accesso per pubblicare un post.";
    } elseif($_SERVER["REQUEST_METHOD"] === "POST") {          
        $idUser = $_SESSION["ID"];
        $textual = $_POST["testo"];
        $idImage = null;
        $img = $_FILES["immagine"];
        $idSong = $_POST["songid"] ?? null;
        $idAlbum = $_POST["albumid"] ?? null;
        if (($img["error"]!=0)&&($textual=="")) {
            $err_mess="Il post non può essere vuoto.";
        } else {
            try {
                $idImage = uploadSource($dbh, $img);
                $dbh->addPost($idUser, $textual, $idImage, $idSong, $idAlbum);
                $success= "Post avvenuto con successo.";
            } catch (PDOException $e) {
                $err_mess="Query fallita: "; $e->getMessage();
            }
        }
    }
?>

    <form action="upload.php" method="post" enctype="multipart/form-data" class="mt-4">
        <fieldset>
    <legend>Pubblica un nuovo post</legend>
        <div class="form-outline">
            <label for="testo" class="form-label">Scrivi qui: </label>
            <textarea title="testo del post" name="testo" class="form-control" id="testo" placeholder="Qualcosa da raccontare?" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="immagine" class="form-label">Immagine:</label>
            <input title="immagine" type="file" class="form-control" name="immagine" id="immagine" accept="image/jpeg,image/png,image/webp,image/avif">
        </div>

        <?php
        if($_SERVER["REQUEST_METHOD"] === "GET") {
            if(isset($_GET["songid"])) {
                $songInfo = $dbh->getSongInfo($_GET["songid"]);
                $authorInfo = $dbh->getUserInfo($songInfo["ID_Utente"]);
                echo "<input type=\"hidden\" name=\"songid\" value=\"".$_GET["songid"]."\">";
                ?>
            <div class="mb-3">
            <p class="mt-4">Stai condividendo: <?php echo htmlentities($songInfo["Titolo"])." - ".htmlentities($authorInfo["Username"]) ?></p>
        </div>
        <?php
            } elseif(isset($_GET["albumid"])) {
                $albumInfo = $dbh->getAlbumInfo($_GET["albumid"]);
                $authorInfo = $dbh->getUserInfo($albumInfo["ID_Utente"]);
                echo "<input type=\"hidden\" name=\"albumid\" value=\"".$_GET["albumid"]."\">";
                ?>
                <p class="mt-4">Stai condividendo: <?php echo htmlentities($albumInfo["Titolo"])." - ".htmlentities($authorInfo["Username"]) ?></p>
           <?php
            }
        }
        ?>
             <button title="invia" type="submit" class="btn btn-dark">Pubblica</button>
    </fieldset>
    </form>
<?php

if (!is_null($err_mess)) { ?>
    <div class="alert alert-danger mt-4">
        <?php echo $err_mess; ?>
    </div>
<?php } elseif (!is_null($success)){ ?>
    <div class="alert alert-primary mt-4">
    <?php echo $success; ?>
    </div>
<?php }  ?>
