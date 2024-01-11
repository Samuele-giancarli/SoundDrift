<?php var_dump($templateParams["songs"]) ?>
<?php if(empty($templateParams["songs"])): ?>
    Nessuna canzone pubblicata
<?php else: ?>
<?php foreach ($templateParams["songs"] as $song): ?>
    
<?php endforeach; ?>
<?php endif; ?> 