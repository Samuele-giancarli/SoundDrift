<?php

class DatabaseHelper{
    public $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

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

    public function getPostsOfUser($id) {
    
    
        $query = "SELECT * FROM post WHERE ID_Utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $feed = array();
    
        while ($row = $result->fetch_assoc()) {
            $feed[] = $row;
        }
    
        return $feed;
    
    }

    public function getMostLiked() {
        $query =
        "SELECT p.*, COUNT(m.ID_Utente) AS num_likes
        FROM post p
        LEFT JOIN mipiace_post m ON p.ID = m.ID_Post
        GROUP BY p.ID
        ORDER BY num_likes DESC, p.Data DESC";
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

    public function getUserInfo($id) {
        $stmt = $this->db->prepare("SELECT * FROM utente WHERE ID=?");
        $stmt->bind_param("i", $id);
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

    public function getUserImageID($userID) {
        $stmt = $this->db->prepare("SELECT ID_Immagine FROM utente WHERE ID=?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["ID_Immagine"];
    }

    public function updateIdImageUser($idImage, $id) {
        $stmt = $this->db->prepare("UPDATE utente SET ID_Immagine = ? WHERE ID = ?");
        $stmt->bind_param("ii", $idImage, $id);
        $stmt->execute();
    }

    public function getSongInfo($id) {
        $stmt = $this->db->prepare("SELECT * FROM canzone WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getAlbumInfo($id) {
        $stmt = $this->db->prepare("SELECT * FROM album WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getResourceInfo($id){
        $stmt = $this->db->prepare("SELECT * FROM risorsa WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }

    //QUERY POST
    public function addImagePost($idImage, $idPost) {
        $query = "INSERT INTO post (ID_Post, ID_Immagine) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idPost, $idImage);
        $stmt->execute();
    }

    public function addImagePlaylist($idImage, $idPlaylist) {
        $query = "INSERT INTO playlist (ID_Playlist, ID_Immagine) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idPlaylist, $idImage);
        $stmt->execute();
    }

    public function addImageAlbum($idImage, $idAlbum) {
        $query = "INSERT INTO album (ID_Album, ID_Immagine) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idAlbum, $idImage);
        $stmt->execute();
    }

    public function addImageSong($idImage, $idSong) {
        $query = "INSERT INTO canzone (ID_Canzone, ID_Immagine) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idSong, $idImage);
        $stmt->execute();
    }

    public function addSong($title,$genre,$idUser,$idImage,$idAudio,$idAlbum){
        $query = "INSERT INTO canzone (Titolo, Genere, ID_Utente, Data, ID_Immagine, ID_Audio, ID_Album) VALUES (?,?,?,?,?,?,?)";
        $date = date("Y-m-d H:i:s");
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssisiii", $title, $genre, $idUser, $date, $idImage, $idAudio, $idAlbum);
        $stmt->execute();
        $idcanzone = $this->db->insert_id;
        $this->addPost($idUser, $title, $idImage, $idcanzone);

        return true;
    }

    public function addPost($idUser, $textual, $idImage, $idcanzone) {
        $query = "INSERT INTO post (Data, ID_Immagine, Testo, ID_Utente, ID_Canzone) VALUES (?, ?, ?, ?, ?);";
        $datePost = date("Y-m-d H:i:s");
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sisii", $datePost, $idImage, $textual, $idUser, $idcanzone);
        $stmt->execute();

        return true;
    }

    public function isUserFollowed($idUserInSession, $idCurrentUser){
        $query = "SELECT COUNT(*) as count FROM follow WHERE ID_Seguace = ? AND ID_Seguito = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idUserInSession, $idCurrentUser);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        return ($count > 0);
    }

    public function getAlbumsOfUser($idCurrentUser){
        $query = "SELECT * FROM album WHERE ID_Utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idCurrentUser);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_all();

        return $row;
    }

    public function getPlaylistsOfUser($idCurrentUser){
        $query = "SELECT * FROM playlist WHERE ID_Utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idCurrentUser);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_all();

        return $row;
    }

    public function getSongsOfUser($idCurrentUser){
        $query = "SELECT * FROM canzone WHERE ID_Utente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idCurrentUser);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_all();

        return $row;
    }

    public function getSongsFromAlbum($idalbum){
        $query="SELECT * FROM canzone WHERE ID_Album=? ORDER BY ID ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $idalbum);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows=array();
        while ($row = $result->fetch_assoc()){
            array_push($rows, $row);
        }
        return $rows;
    }

    public function followUser($idSeguito, $idSeguace){
        $query = "INSERT INTO follow(ID_Seguito, ID_Seguace) VALUES (?,?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idSeguito, $idSeguace);
        $stmt->execute();
    }

    public function unfollowUser($idSeguito, $idSeguace){
        $query = "DELETE FROM follow WHERE ID_Seguito = ? AND ID_Seguace = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $idSeguito, $idSeguace);
        $stmt->execute();
    }
}


?>