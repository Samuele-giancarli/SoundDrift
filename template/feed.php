<!-- Dentro il ciclo foreach per ogni post -->
<div class="post-box">
    <div class="row">
        <!-- Immagine a sinistra -->
        <div class="col-md-3">
            <img src="<?php echo $post["utente"]["avatar"]; ?>" alt="Avatar" class="img-fluid rounded-circle" />
        </div>
        <!-- Contenuto del post a destra -->
        <div class="col-md-9">
            <div class="post-header">
                <!-- <p><?php echo $post["utente"]["nome"]; ?> - <?php echo $post["data_post"]; ?></p> -->
            </div>
            <div class="post-content">
                <!-- <p><?php echo $post["contenuto"]; ?></p> -->
                <!-- Altre informazioni o contenuti del post -->
            </div>
            <div class="post-footer">
                <a href="post.php?id=<?php echo $post["id_post"]; ?>">Visualizza dettagli</a>
            </div>
        </div>
    </div>
</div>