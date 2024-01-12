<?php
    include "../bootstrap.php";
    include "post.php";

    $response = array();
    if(isset($_GET["q"])){
    // Ricevi il valore di ricerca dall'URL
        $searchInput = $_GET['q'];

        // Esegui la query di ricerca nel database
        $arrayResult = $dbh -> searchPostsbyTitle($searchInput);

        // Mostra i risultati
        foreach($arrayResult as $song){
            
            renderPost($song, $dbh);
            
            //$response[] = array("IDSong" => $song["ID"], "Titolo" => $song["Titolo"]);
        }
        
        //echo (json_encode($response));
    }
?>