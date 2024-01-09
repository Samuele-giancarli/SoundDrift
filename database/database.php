<?php

class DatabaseHelper{
    public $db;
    
    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    public function getUser($ID){
        $stmt = $this->db->prepare("SELECT * FROM utente WHERE ID = ?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

    /*public function getImageUser($email){
        $stmt = $this->db->prepare("SELECT immagine FROM utente WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    */

    //è un getNumber
    public function getFollowingOfUser($ID){
        $query = "SELECT COUNT(*) as num_following FROM follow WHERE ID_Seguace = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }
        
    //è un getNumber
    public function getFollowerOfUser($ID){
        $query = "SELECT COUNT(*) as num_followers FROM follow WHERE ID_Seguito = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }

    //ritorna la lista di following dello user attuale
    public function getListOfFollowing($ID){
        $query = "SELECT ID_Seguito FROM follow WHERE ID_Seguace = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $followingList = array(); // Inizializza un array per contenere la lista di following

        while ($row = $result->fetch_assoc()) {
            $followingList[] = $row['ID_Seguito'];
        }

        return $followingList;
    }

    public function getFeed($ID) {
        $followingList = $this->getListOfFollowing($ID);
    
        if (empty($followingList)) {
            return array();
        }
    
        $followingIDs = implode(",", $followingList);
    
        $query = "SELECT * FROM post WHERE ID_Utente IN ($followingIDs) ORDER BY Data DESC";
        $result = $this->db->query($query);
    
        $feed = array();
    
        while ($row = $result->fetch_assoc()) {
            $feed[] = $row;
        }
    
        return $feed;
    }

    public function getResource($ID) {
        $stmt = $this->db->prepare("SELECT * FROM risorsa WHERE ID=?");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }
    
    public function storeResource($file){
        $null = null;
        $filename = $file["name"];
        $mimetype = $file["type"];
        $filesize = $file["size"];
        $fp = fopen($file["tmp_name"], "rb");
        $content = fread($fp, $filesize);
        fclose($fp);
        $stmt = $this->db->prepare("INSERT INTO risorsa(FileName,MimeType,Contenuto) VALUES(?,?,?)");
        $stmt->bind_param("ssb", $filename, $mimetype, $null);
        $stmt->send_long_data(2, $content);
        try {
            if(!$stmt->execute()) {
                return null;
            }
        } catch(mysqli_sql_exception $e) {
            return null;
        }
        return $this->db->insert_id;
    }

    public function getSongCountByUser($userID) {
        $stmt = $this->db->prepare("SELECT COUNT(ID) AS conteggio FROM canzone WHERE ID_Utente=?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["conteggio"];
    }

    /*public function getFeed($ID){
        $query = "SELECT * FROM post, utente Username";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }*/
}
?>