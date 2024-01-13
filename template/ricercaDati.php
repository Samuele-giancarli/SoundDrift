<?php
    include "../bootstrap.php";
    
    session_start();

    if(isset($_GET["q"])){
    // Ricevi il valore di ricerca dall'URL
        $searchInput = $_GET['q'];

        // Esegui la query di ricerca nel database
        $arrayPostsResult = $dbh -> searchPostsbyTitle($searchInput);
        $arrayUsersResult = $dbh -> searchUsersbyName($searchInput);
        if(!is_null($arrayPostsResult)){
            include "post.php";
            
            // Mostra i risultati
            foreach($arrayPostsResult as $post){
                renderPost($post, $dbh, $_SESSION["ID"]);
            }
        }


        if(!is_null($arrayUsersResult)){
            include "userForResearch.php";
            
            foreach($arrayUsersResult as $user){
                renderUser($user);
            }
        }

    }
?>