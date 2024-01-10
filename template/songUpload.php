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
    if (strlen($titolo)<=0||strlen($titolo)>=256){
        $err_mess="Il titolo non ha lunghezza valida";
    }elseif(strlen($genere)<=0||strlen($genere)>=256){
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
        if ($immagine["error"]==0){
            $idimmagine = $dbh->storeResource($immagine);
            if (is_null($idimmagine)){
                echo "Errore generico";
                die();
            }
        }
        $stmt = $dbh->db->prepare("INSERT INTO canzone(Titolo,Genere,ID_Utente,Data,ID_Immagine,ID_Audio,ID_Album) VALUES(?,?,?,CURDATE(),?,?,?)");
        $stmt->bind_param("ssiiii", $titolo, $genere, $idutente,$idimmagine,$idaudio,$idalbum);
        try {
            if($stmt->execute()) {
                $err_mess="<a href=\"songUpload.php\" style=\"color:black\">La canzone ".htmlentities($titolo)." è stata caricata: aggiungi subito altre canzoni!</a><br>";
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
<form id="songupload" method="POST" action="songUpload.php" enctype="multipart/form-data">
    <input type="text" name="titolo" placeholder="Titolo della canzone"/>
    <br>
    <input type="text" name="genere" placeholder="Genere della canzone"/>
    <br>
    Immagine: <input type="file" name="immagine" accept="image/jpeg,image/png,image/webp,image/avif"/>
    <br>
    File audio: <input type="file" name="audio" accept="audio/mpeg,audio/flac"/>
    <br>
    Album di appartenenza: <select name="album" form="songupload">
        <option value="null">no album</option>
<?php
$stmt = $dbh->db->prepare("SELECT * FROM album WHERE Finalizzato=0 AND ID_Utente=?");
$idcreatore=$_SESSION["ID"];
$stmt->bind_param("i", $idcreatore);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()){
    echo "<option value=".$row["ID"].">".htmlentities($row["Titolo"])."</option>";
}
?>
    </select>
    <br>
    <input type="submit" value="Invia"/>
</form>
<?php
}
if(!is_null($err_mess)) {
    echo $err_mess;
}
?>

<ul>
<?php
$stmt = $dbh->db->prepare("SELECT * FROM canzone WHERE ID_Utente=?");
$idutente = $_SESSION["ID"];
$stmt->bind_param("i", $idutente);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
    echo "<li><a style=\"color: black;\" href=\"songPlayer.php?id=".$row["ID"]."\">".htmlentities($row["Titolo"])."</a></li>";
}
?>
</ul>