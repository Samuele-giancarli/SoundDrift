<?php

$show_form = true;
$err_mess = null;

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
        $stmt = $dbh->db->prepare("INSERT INTO playlist(Titolo,ID_Utente,ID_Immagine) VALUES(?,?,?)");
        $stmt->bind_param("sii", $titolo, $idutente, $idimmagine);
        try {
            if($stmt->execute()) {
                $err_mess="<a href=\"libreria.php\" style=\"color:black\">La playlist ".htmlentities($titolo)." è stata creata: vai alla libreria</a><br>";
                $err_mess=$err_mess."<a href=\"playlist.php\" style=\"color:black\">Oppure crea una nuova playlist.</a>";
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
<form method="POST" action="playlist.php" enctype="multipart/form-data">
    <input type="text" name="titolo" placeholder="Titolo della playlist"/>
    <br>
    Immagine: <input type="file" name="immagine" accept="image/jpeg,image/png,image/webp,image/avif"/>
    <br>
    <input type="submit" value="Invia"/>
</form>
<?php
}
if(!is_null($err_mess)) {
    echo $err_mess;
}
if ($show_form){
    
    echo "</ul>";
    echo "Tutte le playlist: <br>";
?>
<ul>
<?php
$stmt = $dbh->db->prepare("SELECT * FROM playlist WHERE ID_Utente=?");
$idutente = $_SESSION["ID"];
$stmt->bind_param("i", $idutente);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
    echo "<li><a style=\"color:black\" href=\"playlistPlayer.php?id=".$row["ID"]."\">".htmlentities($row["Titolo"])."</a></li>";
}
?>
</ul>
<?php
}
?>