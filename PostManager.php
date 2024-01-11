
<?php

require_once("bootstrap.php");

class PostManager{
    
    static $dbh;

    public static function postManagerConnect($DBH){
        self::$dbh = $DBH;
    }
    public static function addSong($title,$genre,$idUser,$idImage,$idAudio,$idAlbum) {
        self::$dbh->addSong($title,$genre,$idUser,$idImage,$idAudio,$idAlbum);
        self::$dbh->addPost($idUser,$title,$idImage);
    }
}

?>