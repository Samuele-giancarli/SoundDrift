<?php
    include "../bootstrap.php";

    $response = array();
    if(isset($_GET["q"])){
    // Ricevi il valore di ricerca dall'URL
        $searchInput = $_GET['q'];

        // Esegui la query di ricerca nel database
        $arrayResult = $dbh -> searchSongsbyTitle($searchInput);

        // Mostra i risultati
        foreach($arrayResult as $song){
            $response[] = array("IDSong" => $song["ID"], "Titolo" => $song["Titolo"]);
        }
        
        echo (json_encode($response));
    }
?>