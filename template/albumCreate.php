
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
        $db = new mysqli("127.0.0.1", "root", "", "sounddrift", 3306);
        $idimmagine=null;
        if ($immagine["error"]==0){
            $null = null;
            $imgname=$immagine["name"];
            $mimetype=$immagine["type"];
            $imgsize=$immagine["size"];
            $fp = fopen($immagine["tmp_name"], "rb");
            $content = fread($fp, $imgsize);
            fclose($fp);
            $stmt = $db->prepare("INSERT INTO risorsa(FileName,MimeType,Contenuto) VALUES(?,?,?)");
            $stmt->bind_param("ssb", $imgname, $mimetype, $null);
            $stmt->send_long_data(2, $content);
            try {
                if(!$stmt->execute()) {
                    echo "Errore sconosciuto";
                    die();
                }
            } catch(mysqli_sql_exception $e) {
                echo "Errore generico (ex. dimensione eccessiva)";
                die();
            }
            $idimmagine=$db->insert_id;
        }
        $stmt = $db->prepare("INSERT INTO album(Titolo,Genere,ID_Utente,Data,ID_Immagine) VALUES(?,?,?,CURDATE(),?)");
        $stmt->bind_param("ssii", $titolo, $genere, $idutente,$idimmagine);
        try {
            if($stmt->execute()) {
                $err_mess="<a href=\"songUpload.php\" style=\"color:black\">L'album ".htmlentities($titolo)." è stato creato: aggiungi subito delle canzoni!</a>";
                $show_form=false;
            } else {
                $err_mess="Errore sconosciuto";
            }
        } catch(mysqli_sql_exception $e) {
            $err_mess="Errore generico";
        }
        $db->close();
    }
}
?>

<?php
if ($show_form) {
?>
<form method="POST" action="albumCreate.php" enctype="multipart/form-data">
    <input type="text" name="titolo" placeholder="Titolo dell'album"/>
    <input type="text" name="genere" placeholder="Genere dell'album"/>
    <input type="file" name="immagine" accept="image/jpeg,image/png,image/webp,image/avif"/>
    <input type="submit" value="Invia"/>
</form>
<?php
}
if(!is_null($err_mess)) {
    echo $err_mess;
}
?>