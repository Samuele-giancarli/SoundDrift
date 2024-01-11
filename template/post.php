<?php
    function renderPost($postInfo, $dbh) {
        $userid = $postInfo["ID_Utente"];
        $image = $postInfo["ID_Immagine"];
        //se manca immagine: inserisci img default dalla cartella images
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
        if($isAlbum && $isSong)
        {
            echo "un post non può essere sia una canzone che un album";
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
                        ?>
                    <a href="profile.php?utenteCorrente=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un brano
                        <?php
                }else if (!is_null($albumInfo)){
                    ?>
                    <a href="profile.php?utenteCorrente=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un album
                    <?php
                }else{
                    ?>
                    <a href="profile.php?utenteCorrente=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un post
                    <?php
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
                        echo "<button type=\"button\" class=\"btn btn-info\"><a style=\"color: white;\" href=\"songPlayer.php?id=".$songInfo["ID"]."\">Link al brano</a></button>";
                    }
                    if(!is_null($albumInfo)){
                        echo "<button type=\"button\" class=\"btn btn-info\"><a style=\"color: white;\" href=\"albumPlayer.php?id=".$albumInfo["ID"]."\">Link all'album</a></button>";
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
        button.style.backgroundColor = "ff0000";
        button.style.borderColor = "ff0000"
    }
</script>

<?php } ?>