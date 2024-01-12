<?php
    $response = array();
    if(isset($_GET["q"])){
    // Ricevi il valore di ricerca dall'URL
        $searchInput = $_GET['q'];
        $db = new mysqli("127.0.0.1", "root", "", "sounddrift", 3307);
        if ($db->connect_error) {
            die("Connessione fallita: " . $db->connect_error);
        }

        // Esegui la query di ricerca nel database
        $sql = "SELECT * FROM canzone WHERE Titolo LIKE '%$searchInput%'";
        $result = $db->query($sql);

        // Mostra i risultati
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = array("Titolo" => $row["Titolo"]);
            }
        } else {
            $response[] = "Nessun risultato trovato.";
        }
        $db->close();
        
        echo (json_encode($response));
    }
?>