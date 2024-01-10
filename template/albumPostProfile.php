<?php var_dump($templateParams["albums"]) ?>
<?php if(empty($templateParams["albums"])): ?>
    Nessun album pubblicato
<?php else: ?>
<?php foreach ($templateParams["albums"] as $album): ?>
    
<?php endforeach; ?>
<?php endif; ?> 