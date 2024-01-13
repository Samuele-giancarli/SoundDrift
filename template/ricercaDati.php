<?php
    include "../bootstrap.php";
    
    session_start();

    if(isset($_GET["q"])){
    // Ricevi il valore di ricerca dall'URL
        $searchInput = $_GET['q'];

        // Esegui la query di ricerca nel database
        $arrayPostsResult = $dbh -> searchPostsbyTitle($searchInput);
        $arrayUsersResult = $dbh -> searchUsersbyName($searchInput);
        $arraySongsResult= $dbh -> searchSongsbyTitle($searchInput);
        $arrayAlbumsResult= $dbh -> searchAlbumsbyTitle($searchInput);
        $arrayPlaylistsResult= $dbh -> searchPlaylistsbyTitle($searchInput);
        


        if(!is_null($arrayUsersResult)){
            include "userForResearch.php";
            
            foreach($arrayUsersResult as $user){
                renderUser($user,$dbh);
            }
        }

        if(!is_null($arraySongsResult)){
            include "songForResearch.php";
            
            foreach($arraySongsResult as $song){
                renderSong($song,$dbh);
            }
        }


        if(!is_null($arrayAlbumsResult)){
            include "albumForResearch.php";
            
            foreach($arrayAlbumsResult as $album){
                renderAlbum($album,$dbh);
            }
        }

        if(!is_null($arrayPlaylistsResult)){
            include "playlistForResearch.php";
            
            foreach($arrayPlaylistsResult as $playlist){
                renderPlaylist($playlist,$dbh);
            }
        }

    }
?>