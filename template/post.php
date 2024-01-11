<?php
    function renderPost($postInfo, $dbh) {
        $userid = $postInfo["ID_Utente"];
        $image = $postInfo["ID_Immagine"];
        $username = $dbh->getUserInfo($userid)["Username"];
        $postId = $postInfo["ID"];
        $likeNumber = $dbh->countLikes($postId);
        $imagePath="download.php?id=".$image;
        $isAlbum = $dbh->isPostAlbum($postId);
        $isSong = $dbh->isPostSong($postId);
        $songInfo=null;
        $albumInfo=null;

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
                        ?> <a href="profile.php?utenteCorrente=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un brano <?php
                    } else if (!is_null($albumInfo)){
                        ?> <a href="profile.php?utenteCorrente=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un album<?php
                    } else {
                        ?> <a href="profile.php?utenteCorrente=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un post <?php
                    }
                    ?>
                </h5>

                <p class="card-text" style="text-align:center;">
                    <?php if ($image != null) { ?>
                        <img src="<?php echo $imagePath; ?>" id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
                    <?php } ?>
                    <br>
                    <?php echo htmlentities($postInfo["Testo"]); ?>
                </p>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">

                        <button type="button" class="btn btn-primary" onclick="toggleLike(this)">Like</button>
                        <button type="button" class="btn btn-secondary">Condividi</button>

                    <?php
                    if (!is_null($songInfo)){
                        echo "<a class=\"btn btn-info\" style=\"color: white;\" href=\"songPlayer.php?id=".$songInfo["ID"]."\">Vai al brano</a>";
                    }
                    if(!is_null($albumInfo)){
                        echo "<a class=\"btn btn-info\" style=\"color: white;\" href=\"songPlayer.php?id=".$albumInfo["ID"]."\">Vai all'album</style=></a>";
                    }
                    ?>
                    </div>
                    <small class="text-muted"><?php echo $likeNumber ?> likes </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleLike(button){
        console.log("toggleLike called");
        button.style.backgroundColor = "#ff0000";
        button.style.borderColor = "#ff0000"
    }
</script>

<?php } ?>