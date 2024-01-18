<?php

$show_form = true;
$err_mess = null;
$success=null;

if(!isset($_SESSION["ID"])) {
    $err_mess="Per creare una playlist, devi essere loggato!";
    $show_form=false;
} elseif(isset ($_POST["titolo"])) {
    $idutente=$_SESSION["ID"];
    $titolo=$_POST["titolo"];
    $immagine=$_FILES["immagine"];
    if (strlen($titolo)<=0||strlen($titolo)>=256){
        $err_mess="Il titolo non ha lunghezza valida.";
    }else{
        $idimmagine=null;
        if ($immagine["error"]==0){
            $idimmagine = $dbh->storeResource($immagine);
            if (is_null($idimmagine)){
                echo "Errore generico";
                die();
            }
        }

        try {
            $idPlaylist = $dbh->addPlaylist($titolo, $idutente, $idimmagine);
        if (!is_null($idPlaylist)) { 
                $dbh ->likePlaylist($idutente, $idPlaylist);
                $success="<a href=\"libreria.php\" style=\"color:black\">La playlist ".htmlentities($titolo)." è stata creata: vai alla libreria</a><br>";
                $success=$success."<a href=\"playlist.php\" style=\"color:black\">Oppure crea una nuova playlist.</a>";
                $show_form=false;
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
<form method="POST" action="playlist.php" enctype="multipart/form-data" class="mt-4">
    <fieldset>
    <legend>Crea una playlist</legend>
        <div class="mb-3">
            <label for="titolo" class="form-label">Nome della playlist:</label>
            <input type="text" id="titolo" name="titolo" class="form-control" placeholder="Nome della playlist" required>
</div>
        <div class="mb-3">
            <label for="immagine" class="form-label">Immagine:</label>
            <input type="file" name="immagine" id="immagine" class="form-control" accept="image/jpeg,image/png,image/webp,image/avif">
        </div>
        <button type="submit" class="btn btn-dark">Invia</button>
    </fieldset>
</form>
<?php

}

if (!is_null($err_mess)) { ?>
    <div class="alert alert-danger mt-4">
        <?php echo $err_mess; ?>
    </div>
<?php } elseif (!is_null($success)){ ?>
    <div class="alert alert-primary mt-4">
    <?php echo $success; ?>
    </div>
<?php } 

if ($show_form){
    ?>
    <p class="mt-4">Tutte le playlist:</p>
    <ul class="list-group">
<?php
$stmt = $dbh->db->prepare("SELECT * FROM playlist WHERE ID_Utente=?");
$idutente = $_SESSION["ID"];
$stmt->bind_param("i", $idutente);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
    echo "<li class=\"list-group-item\"><a class=\"link-primary\" href=\"playlistPlayer.php?id=" . $row["ID"] . "\">" . htmlentities($row["Titolo"]) . "</a></li>";
}
?>
</ul>
<?php
}
?>