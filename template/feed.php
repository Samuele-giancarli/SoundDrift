<?php foreach ($templateParams["feedData"] as $post):
    renderPost($post, $dbh, $templateParams["ID_Visualizer"]);
endforeach; ?>