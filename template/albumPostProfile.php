
<?php 
require_once("post.php");

foreach ($templateParams["feedData"] as $post){
    $idpost=$post["ID"];
    if ($dbh->isPostAlbum($idpost)){
    renderPost($post, $dbh);
    }
}
?>