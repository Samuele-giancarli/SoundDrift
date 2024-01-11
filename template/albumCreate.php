<?php

$show_form = true;
$err_mess = null;

if(!isset($_SESSION["ID"])) {
    $err_mess="Per creare un album, devi essere loggato!";
    $show_form=false;
} elseif(isset ($_POST["titolo"])) {
    $idutente=$_SESSION["ID"];
    $titolo=$_POST["titolo"];
    $genere=$_POST["genere"];
    $immagine=$_FILES["immagine"];
    if (strlen($titolo)<=0||strlen($titolo)>=256){
        $err_mess="Il titolo non ha lunghezza valida.";
    }elseif(strlen($genere)<=0||strlen($genere)>=256){
        $err_mess="Il genere non ha lunghezza valida.";
    }else{
        $idimmagine=null;
        if ($immagine["error"]==0){
            $idimmagine = $dbh->storeResource($immagine);
            if (is_null($idimmagine)){
                echo "Errore generico";
                die();
            }
        }
        $stmt = $dbh->db->prepare("INSERT INTO album(Titolo,Genere,ID_Utente,Data,ID_Immagine) VALUES(?,?,?,CURDATE(),?)");
        $stmt->bind_param("ssii", $titolo, $genere, $idutente,$idimmagine);
        try {
            if($stmt->execute()) {
                $err_mess="<a href=\"songUpload.php\" style=\"color:black\">L'album ".htmlentities($titolo)." è stato creato: aggiungi subito delle canzoni!</a><br>";
                $err_mess=$err_mess."<a href=\"albumCreate.php\" style=\"color:black\">Oppure crea un nuovo album.</a>";
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
<form method="POST" action="albumCreate.php" enctype="multipart/form-data">
    <input type="text" name="titolo" placeholder="Titolo dell'album"/>
    <br>
    <input type="text" name="genere" placeholder="Genere dell'album"/>
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
    echo "Album da finalizzare: <br> <ul>";
    $stmt = $dbh->db->prepare("SELECT ID, Titolo FROM album WHERE Finalizzato=0 AND ID_Utente=? AND (SELECT COUNT(ID) FROM canzone WHERE album.ID=ID_Album) > 0");
    $idcreatore=$_SESSION["ID"];
    $stmt->bind_param("i", $idcreatore);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()){
        echo "<li>".htmlentities($row["Titolo"])." <button onclick=\"location.href='finalise.php?id=".$row["ID"]."'\" type=\"button\">Finalizza</button></li>";
    }
    
    echo "</ul>";
    echo "Tutti gli album: <br>";
?>
<ul>
<?php
$stmt = $dbh->db->prepare("SELECT * FROM album WHERE ID_Utente=?");
$idutente = $_SESSION["ID"];
$stmt->bind_param("i", $idutente);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
    echo "<li><a style=\"color:black\" href=\"albumPlayer.php?id=".$row["ID"]."\">".htmlentities($row["Titolo"])."</a></li>";
}
?>
</ul>
<?php
}
?>