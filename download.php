<?php

include "bootstrap.php";

if(!isset($_GET["id"])) {
    die();
}

$id = $_GET["id"];
$row = $dbh->getResource($id);
if(is_null($row)) {
    die();
}

header("Content-Type: ".$row["MimeType"]);
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: inline; filename=\"".$row["FileName"]."\"");
echo $row["Contenuto"];

?>