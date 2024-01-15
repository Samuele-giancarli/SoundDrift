<?php

$show_form = true;
$err_mess = null;

if(!isset($_SESSION["ID"])) {
    $err_mess="Per caricare tuoi brani, devi essere loggato!";
    $show_form=false;
}elseif(isset($_POST["titolo"])){
    $idutente=$_SESSION["ID"];
    $titolo=$_POST["titolo"];
    $genere=$_POST["genere"];
    $immagine=$_FILES["immagine"];
    $audio=$_FILES["audio"];
    $idalbum=$_POST["album"];
    if($idalbum == "null") {
        $idalbum = null;
    }
    if (isset($_POST["albuminfo"]) && is_null($idalbum)){
        $err_mess="Selezione album non valida";
    }elseif (strlen($titolo)<=0||strlen($titolo)>=256){
        $err_mess="Il titolo non ha lunghezza valida";
    }elseif(strlen(($genere)<=0||strlen($genere)>=256)&&!isset($_POST["albuminfo"])){
        $err_mess="Il genere non ha lunghezza valida";
    }elseif($audio["error"]!=0){
        $err_mess="Non hai inserito il file audio";
    }else{
        $idimmagine=null;
        $idaudio = $dbh->storeResource($audio);
        if (is_null($idaudio)){
            echo "Errore generico";
            die();
        }
        if (isset($_POST["albuminfo"])) {
            $albumInfo = $dbh->getAlbumInfo($idalbum);
            $genere= $albumInfo["Genere"];
            $idimmagine= $albumInfo["ID_Immagine"];
        } elseif ($immagine["error"]==0){
            $idimmagine = $dbh->storeResource($immagine);
            if (is_null($idimmagine)){
                echo "Errore generico";
                die();
            }
        }
        try {
            if($dbh->addSong($titolo, $genere, $idutente, $idimmagine, $idaudio, $idalbum)) {
                $err_mess=">La canzone ".htmlentities($titolo)." è stata caricata: aggiungi subito altre canzoni!</a><br>";
                $show_form=true;
            } else {
                $err_mess="Errore sconosciuto";
            }
        } catch(mysqli_sql_exception $e) {
            $err_mess="Errore generico";
        }
    }
}
?>

<?php
if ($show_form) {
?>

<div class="container mt-5">
    <form id="songupload" method="POST" action="songUpload.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titolo" class="form-label">Titolo della canzone:</label>
            <input type="text" class="form-control" name="titolo" placeholder="Titolo della canzone" required>
        </div>
        <div class="mb-3">
            <label for="genere" class="form-label">Genere della canzone:</label>
            <input type="text" class="form-control" name="genere" placeholder="Genere della canzone" required>
        </div>
        <div class="mb-3">
            <label for="immagine" class="form-label">Immagine:</label>
            <input type="file" class="form-control" name="immagine" accept="image/jpeg,image/png,image/webp,image/avif">
        </div>
        <div class="mb-3">
            <label for="audio" class="form-label">File audio:</label>
            <input type="file" class="form-control" name="audio" accept="audio/mpeg,audio/flac" required>
        </div>
        <div class="mb-3">
            <label for="album" class="form-label">Album di appartenenza:</label>
            <select class="form-control" name="album">
                <option value="null">no album</option>
                <?php
                $stmt = $dbh->db->prepare("SELECT * FROM album WHERE Finalizzato=0 AND ID_Utente=?");
                $idcreatore = $_SESSION["ID"];
                $stmt->bind_param("i", $idcreatore);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row["ID"] . ">" . htmlentities($row["Titolo"]) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="albuminfo" name="albuminfo">
            <label class="form-check-label" for="albuminfo">Copiare le informazioni dell'album?</label>
        </div>
        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
</div>

<?php } ?>

<p class="mt-4">Tutte le canzoni:</p>
<ul class="list-group">
    <?php
    $stmt = $dbh->db->prepare("SELECT * FROM canzone WHERE ID_Utente=?");
    $idutente = $_SESSION["ID"];
    $stmt->bind_param("i", $idutente);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<li class=\"list-group-item\"><a class=\"link-info\" href=\"songPlayer.php?id=" . $row["ID"] . "\">" . htmlentities($row["Titolo"]) . "</a></li>";
    }
    ?>
</ul>