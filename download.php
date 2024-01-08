<?php

if(!isset($_GET["id"])) {
    die();
}

$id = $_GET["id"];
$db = new mysqli("127.0.0.1", "root", "", "sounddrift", 3306);
$stmt = $db->prepare("SELECT * FROM risorsa WHERE ID=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$db->close();
if(is_null($row)) {
    die();
}

header("Content-Type: ".$row["MimeType"]);
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: inline; filename=\"".$row["FileName"]."\"");
echo $row["Contenuto"];

?>