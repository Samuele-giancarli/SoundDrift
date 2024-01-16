<?php
$show_form = true;
$err_mess = null;
$success=null;

if (!isset($_SESSION["ID"])) {
    $err_mess = "Per creare un album, devi essere loggato!";
    $show_form = false;
} elseif (isset($_POST["titolo"])) {
    $idutente = $_SESSION["ID"];
    $titolo = $_POST["titolo"];
    $genere = $_POST["genere"];
    $immagine = $_FILES["immagine"];

    if (strlen($titolo) <= 0 || strlen($titolo) >= 256) {
        $err_mess = "Il titolo non ha lunghezza valida.";
    } elseif (strlen($genere) <= 0 || strlen($genere) >= 256) {
        $err_mess = "Il genere non ha lunghezza valida.";
    } else {
        $idimmagine = null;

        if ($immagine["error"] == 0) {
            $idimmagine = $dbh->storeResource($immagine);

            if (is_null($idimmagine)) {
                echo "Errore generico";
                die();
            }
        }

        $idalbum = $dbh->addAlbum($titolo, $genere, $idutente, $idimmagine);

        try {
            if (!is_null($idalbum)) {
                $success = "<a href=\"songUpload.php\" class=\"text-dark\">L'album " . htmlentities($titolo) . " è stato creato: aggiungi subito delle canzoni!</a><br>";
                $success= $success."<a href=\"albumCreate.php\" class=\"text-dark\">Oppure crea un nuovo album.</a>";
                $show_form = false;
            } else {
                $err_mess = "Errore sconosciuto";
            }
        } catch (mysqli_sql_exception $e) {
            $err_mess = "Errore generico";
        }
    }
}
?>

<?php if ($show_form) : ?>
    <form method="POST" action="albumCreate.php" enctype="multipart/form-data" class="mt-4">
    <legend>Crea un album</legend>
        <div class="mb-3">
            <label for="titolo" class="form-label">Titolo dell'album:</label>
            <input type="text" name="titolo" id="titolo" class="form-control" placeholder="Titolo dell'album" required>
        </div>
        <div class="mb-3">
            <label for="genere" class="form-label">Genere dell'album:</label>
            <input type="text" name="genere" id="genere" class="form-control" placeholder="Genere dell'album" required>
        </div>
        <div class="mb-3">
            <label for="immagine" class="form-label">Immagine:</label>
            <input type="file" name="immagine" id="immagine" class="form-control" accept="image/jpeg,image/png,image/webp,image/avif">
        </div>
        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
<?php endif; ?>

<?php if (!is_null($err_mess)) { ?>
    <div class="alert alert-danger mt-4">
        <?php echo $err_mess; ?>
    </div>
<?php } elseif (!is_null($success)){ ?>
    <div class="alert alert-primary mt-4">
    <?php echo $success; ?>
    </div>
<?php }  ?>

<?php if ($show_form) : ?>
    <div class="mt-4">
        <p>Album da finalizzare:</p>
        <ul class="list-group">
            <?php
            $stmt = $dbh->db->prepare("SELECT ID, Titolo FROM album WHERE Finalizzato=0 AND ID_Utente=? AND (SELECT COUNT(ID) FROM canzone WHERE album.ID=ID_Album) > 0");
            $idcreatore = $_SESSION["ID"];
            $stmt->bind_param("i", $idcreatore);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) :
            ?>
                <li class="list-group-item">
                <?php echo "<a class=\"link-primary\" href=\"albumPlayer.php?id=" . $row["ID"] . "\">" . htmlentities($row["Titolo"]) . "</a>";?>
                <button id="finalizza" class="btn btn-secondary btn-sm" onclick="location.href='finalise.php?id=<?php echo $row['ID']; ?>'">Finalizza</button>
                </li>

            <?php endwhile; 
            //sposta il bottone "finalizza a dx"
            ?>
        </ul>
    </div>

    <div class="mt-4">
        <p>Tutti gli album:</p>
        <ul class="list-group">
            <?php
            $stmt = $dbh->db->prepare("SELECT * FROM album WHERE ID_Utente=?");
            $idutente = $_SESSION["ID"];
            $stmt->bind_param("i", $idutente);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) :
            ?>
                <li class="list-group-item">
                <?php echo "<a class=\"link-info\" href=\"albumPlayer.php?id=" . $row["ID"] . "\">" . htmlentities($row["Titolo"]) . "</a>";?> 
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>
