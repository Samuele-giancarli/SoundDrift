<?php 
if (isset($_SESSION["ID"])&&$templateParams["feedData"]==null){
    echo "<a style=\"color:black; text-decoration:none\" href=\"ricerca.php?id=".$_SESSION["ID"]."\" > Comincia subito a seguire qualcuno! </a>";
}

foreach ($templateParams["feedData"] as $post):
    renderPost($post, $dbh, $templateParams["ID_Visualizer"]);
endforeach; ?>