<?php 
if (isset($_SESSION["ID"]) && $templateParams["feedData"] == null){
    echo '<div class="d-flex justify-content-center align-items-center";">';
    echo '<a class="btn btn-dark" href="ricerca.php?id='.$_SESSION["ID"].'">Comincia subito a seguire qualcuno!</a>';
    echo '</div>';
}

foreach ($templateParams["feedData"] as $post):
    renderPost($post, $dbh, $templateParams["ID_Visualizer"]);
endforeach;
?>
