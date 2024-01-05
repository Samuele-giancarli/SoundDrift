<?php
    $show_form = false;
    $err_mess = null;
    
    // Verifica se l'utente è già loggato
    if (!isset($_SESSION["email"])) {
        $err_mess = "Devi effettuare l'accesso per pubblicare un post.";
        echo $err_mess;
    } else if($_SERVER["REQUEST_METHOD"] === "POST") {
        try {
            $db = new mysqli("127.0.0.1", "root", "", "sounddrift", 3306);
            
            $Email = $_SESSION["email"];
            $DatePost = date("Y-m-d H:i:s");
            $Img = $_FILES["immagine"];
            $Textual = $_POST["testo"];

            $query = "INSERT INTO testuale (Email, Data, Immagine, Testo) VALUES
            (?, ?, ?, ?);";

            /* queste sono le informazioni che posso trarre da un'immagine
                $nome_file = $Img['name'];
                $tipo_file = $Img['type'];
                $percorso_temporaneo = $Img['tmp_name'];
                $errore = $Img['error'];
                $dimensione_file = $Img['size'];
            */

            $stmt = $db->prepare($query);
            $stmt->bind_param("ssss", $Email, $DatePost, $Img["name"], $Textual);
            
            if (!$stmt->execute()) {
                echo "Errore durante l'esecuzione della query: " . $stmt->error;
            } else {
                echo "Inserimento riuscito!";
            }

            if ($stmt->affected_rows > 0) {
                header("Location: index.php");
                echo $stmt->affected_rows;
            } else {
                echo "Errore durante l'inserimento dei dati nel database.";
            }

            $stmt->close();
            $db->close();
        } catch (PDOException $e) {
            die("Query fallita: ". $e->getMessage());
        }
    } else { 
?>

    <h2>Pubblica un nuovo post</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <textarea name="testo"></textarea><br>
        Immagine: <br>
        <input type="file" name="immagine"><br><br>
        <input type="submit" value="Pubblica">
    </form>
<?php
    }
?>