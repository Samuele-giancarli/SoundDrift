<?php

require_once("bootstrap.php");

if(!isset($_GET["id"])) {
    die();
}

if(!isset($_FILES["file"])) {
    die();
}

$uploadedFile = $_FILES["file"];
$filename = $uploadedFile["name"];
$filetype = $uploadedFile["type"];

echo $filename;
echo $filetype;

// Salva l'immagine nella tabella risorsa
$resourceID = $dbh->storeResource($uploadedFile);
?>