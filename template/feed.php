<!-- <div class="post-box" color=black>
    <?php
        //prendo dalla tabella utente riga 0 il suo username
        //echo $templateParams["post"][0]["Username"];
        //echo $templateParams["utente"][1]["Username"];
        //echo $templateParams["utente"][3]["Username"];

        //DEVO CREARE LA QUERY GETPOST o GETPOSTLIST SU DATABASE:PHP        
    ?>
</div> -->

<?php foreach ($templateParams["feedData"] as $post): ?>
    <div class="post">
        <p><?php echo $post['Testo']; ?></p>
    </div>
<?php endforeach; ?>