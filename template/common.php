<?php

function store_file($db,$file){
    $null = null;
    $filename=$file["name"];
    $mimetype=$file["type"];
    $filesize=$file["size"];
    $fp = fopen($file["tmp_name"], "rb");
    $content = fread($fp, $filesize);
    fclose($fp);
    $stmt = $db->prepare("INSERT INTO risorsa(FileName,MimeType,Contenuto) VALUES(?,?,?)");
    $stmt->bind_param("ssb", $filename, $mimetype, $null);
    $stmt->send_long_data(2, $content);
    try {
        if(!$stmt->execute()) {
            return null;
        }
    } catch(mysqli_sql_exception $e) {
        return null;
    }
    return $db->insert_id;
}

?>