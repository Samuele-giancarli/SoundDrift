<?php

if(!isset($_GET["id"])) {
    die();
}

$id = $_GET["id"];
$row = $dbh->getImage($id);

if(is_null($row)) {
    die("nessuna immagine corrispondente a questo id");
}

header("Content-Type: ".$row["MimeType"]);
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: inline; filename=\"".$row["FileName"]."\"");
echo $row["Contenuto"];

?>