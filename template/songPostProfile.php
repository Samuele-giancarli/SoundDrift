
<?php 
require_once("post.php");

foreach ($templateParams["feedData"] as $post){
    $idpost=$post["ID"];
    if ($dbh->isPostSong($idpost)){
    renderPost($post, $dbh);
    }
}
?>