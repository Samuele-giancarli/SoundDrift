<style>
    .liked {
        background-color: #ff0000;
        border-color: #ff0000;
    }
</style>

<script>
    var oldStyle;

    function likeOn(postId){
        var button = document.getElementById(postId);
        oldStyle = button.style;
        button.style.backgroundColor = "#ff0000";
        button.style.borderColor = "#ff0000";

        button.dataset.isOn = "true";

        console.log("likeOn");
    }

    function likeOff(postId){
        var button = document.getElementById(postId);
        button.style = oldStyle;

        button.dataset.isOn = "false";

        console.log("likeOff");
    }

    function updateLikeVisual(postId){

        console.log("started Update")

        var button = document.getElementById(postId);
        if(button.dataset.isOn === "true"){
            likeOff(postId);
        } else {
            likeOn(postId)
        }
    }
    
</script>

<?php
    /*function generaBarraFunzionalita($idPost,$songInfo, $albumInfo) {
        $testo = "Like";
        // Genera il pulsante con il testo e l'ID specificati
        return '<form method="post" action="updateLike.php">
                    <div class="btn-group">
                    <button type="button" class="btn btn-primary" onclick="updateLike('.$idPost.')" id="' . $idPost . '"  data-isOn="false" type="button">'. $idPost .'</button>
                    <button type="button" class="btn btn-secondary">Condividi</button>'.
                    (!is_null($songInfo) ? '<a class="btn btn-info" style="color: white;" href="songPlayer.php?id='.$songInfo["ID"].'">Vai al brano</a>' : '').
                    (!is_null($albumInfo) ? '<a class="btn btn-info" style="color: white;" href="albumPlayer.php?id='.$albumInfo["ID"].'">Vai all\'album</a>' : '').
                    '<small class="text-muted"><?php echo $likeNumber ?> likes </small>
                    </div>
                </form>';
    }*/
?>

<?php
    function renderPost($postInfo, $dbh, $ID_Visualizer) {
        $userid = $postInfo["ID_Utente"]; //userid è l'id dellutente pubblicatore
        $username = $dbh->getUserInfo($userid)["Username"]; //username è l'username dell'utente pubblicatore
        $image = $postInfo["ID_Immagine"];
        $postId = $postInfo["ID"];
        $likeNumber = $dbh->countLikes($postId);
        $imagePath="download.php?id=".$image;
        //fino a qui sono tutte informazzioni sul post e il poster

        $isAlbum = $dbh->isPostAlbum($postId);
        $isSong = $dbh->isPostSong($postId);
        $songInfo=null;
        $albumInfo=null;

        $visualizerId = $ID_Visualizer; //questo è l'id dell'eventuale visualizzatore

        $isLiked = $dbh->isLikedBy($postId,$visualizerId);

        if (!is_null($postInfo["ID_Canzone"])){
        $songInfo= $dbh->getSongInfo($postInfo["ID_Canzone"]);
        }

        if (!is_null($postInfo["ID_Album"])){
        $albumInfo=$dbh->getAlbumInfo($postInfo["ID_Album"]);
        }

        $istext = false;
        if($isAlbum && $isSong) {
            die();
        } elseif(!$isAlbum && !$isSong) {
            $istext=true;
        }
    

?>

<div class="row justify-content-center text-center">
    <div class="col-md-6 text-center"> 
        <div class="card rounded-3 text-center">
            <div class="card-body">

                <h5 class="card-title">
                    <?php
                        if (!is_null($songInfo)){
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un brano <?php
                        } else if (!is_null($albumInfo)){
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un album<?php
                        } else {
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un post <?php
                        }
                    ?>
                </h5>

                <!-- h5 e tutto quello che c'è sopra sono il post generico-->






        <?php 
            if(is_null($albumInfo)) {
                ?>
                <p class="card-text" style="text-align:center;">
                    <?php if ($image != null) { ?>
                        <img src="<?php echo $imagePath; ?>" id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
                    <?php } ?>
                    <br>
                    <?php echo htmlentities($postInfo["Testo"]); ?>
                    <br>
                </p>
                <?php
            } else { 
                
                $albumInfo;
                $idalbum = $albumInfo["ID"];
                $AlbumGen = $albumInfo["Genere"];
                $imagePath;
                $albumTit = $albumInfo["Titolo"];
                /*ID - ID_Utente - Data - Titolo - Genere - Finalizzato - ID_Immagine*/
            
                ?>
            <div style="max-height: 150px; overflow-y: auto; overflow-x: hidden;">
               <?php foreach ($dbh -> getSongsFromAlbum($idalbum) as $song) {?>
                     <!--

                        qua andrà la visualizzazione delle canzoni singole

                    -->

                    
                    <div class="song row">
                            <!-- Song Name (Takes 9 columns) -->
                        <div class="col-9">
                            <h3><?php echo $song["Titolo"]; ?></h3>
                            <!-- Add more song details as needed -->
                        </div>

                        <!-- Play Button (Takes 3 columns) -->
                        <div class="col-3 text-end">
                            <button class="btn btn-primary">
                                <i class="bi bi-play-fill"></i> Play
                            </button>
                        </div>
                    </div>

                    <br>
                <?php } ?>
            </div>

                

                 <!--

                        qua andrà la visualizzazione dell'album

                -->     

      <?php } ?>


















                <!-- questo qua sotto sono i pulsanti del post generico-->

                <div class="d-flex justify-content-between align-items-center">
               
                    <form method="post" action="updateLike.php" enctype="multipart/form-data">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary" onclick="updateLikeVisual(<?php echo $postId; ?>)" id="<?php echo $postId; ?>" data-isOn="false" type="button"><?php echo $postId; ?></button>
                            <button type="button" class="btn btn-secondary">Condividi</button>
                            <?php echo (!is_null($songInfo) ? '<a class="btn btn-info" style="color: white;" href="songPlayer.php?id='.$songInfo["ID"].'">Vai al brano</a>' : ''); ?>
                            <?php echo (!is_null($albumInfo) ? '<a class="btn btn-info" style="color: white;" href="albumPlayer.php?id='.$albumInfo["ID"].'">Vai all\'album</a>' : ''); ?>
                            <small class="text-muted"><?php echo $likeNumber; ?> likes </small>
                        </div>
                        <input type="hidden" name="idPost" value="<?php echo $postId; ?>">
                        <input type="hidden" name="idUser" value="<?php echo $visualizerId; ?>">
                    </form>

                    <?php if($isLiked){echo "<script>likeOn($postId);</script>";}?>

                </div>
            </div>
        </div>
    </div>
</div>



<?php } ?>