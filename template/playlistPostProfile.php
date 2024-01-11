<?php var_dump($templateParams["playlists"]) ?>
<?php if(empty($templateParams["playlists"])): ?>
    Nessuna playlist pubblicata
<?php else: ?>
<?php foreach ($templateParams["playlists"] as $playlist): ?>
    
<?php endforeach; ?>
<?php endif; ?> 