<?php

function jsescape($s) {
    return str_replace("'", "\\'", $s);
}

    $err_mess = null;
    
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
        <input type="file" name="immagine" accept="image/jpeg,image/png,image/webp,image/avif"><br>
        <?php
        if($_SERVER["REQUEST_METHOD"] === "GET") {
            if(isset($_GET["songid"])) {
                $songInfo = $dbh->getSongInfo($_GET["songid"]);
                $authorInfo = $dbh->getUserInfo($songInfo["ID_Utente"]);
                echo "<input type=\"hidden\" name=\"songid\" value=\"".$_GET["songid"]."\">";
                echo "Condivisione canzone: ".htmlentities($songInfo["Titolo"])." - ".htmlentities($authorInfo["Username"])."<br>";
            } elseif(isset($_GET["albumid"])) {
                $albumInfo = $dbh->getAlbumInfo($_GET["albumid"]);
                $authorInfo = $dbh->getUserInfo($albumInfo["ID_Utente"]);
                echo "<input type=\"hidden\" name=\"albumid\" value=\"".$_GET["albumid"]."\">";
                echo "Condivisione album: ".htmlentities($albumInfo["Titolo"])." - ".htmlentities($authorInfo["Username"])."<br>";
            }
        }
        ?>
        <input type="submit" value="Pubblica">
    </form>
<?php

if(!is_null($err_mess)) {
    echo $err_mess;
}
?>
