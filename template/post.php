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

        $isLiked = $dbh->isLikedBy($postId,$userid);

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
                    <br>
                    <?php if($isLiked){
                        echo "piaciuto da te";
                    } else {
                        echo "non piaciuto da te";
                    }?>
                </p>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">

                        <button type="button" class="btn btn-primary" onclick="swtch(this)">Like</button>
                        <button type="button" class="btn btn-secondary">Condividi</button>

                    <?php
                    if (!is_null($songInfo)){
                        echo "<a class=\"btn btn-info\" style=\"color: white;\" href=\"songPlayer.php?id=".$songInfo["ID"]."\">Vai al brano</a>";
                    }
                    if(!is_null($albumInfo)){
                        echo "<a class=\"btn btn-info\" style=\"color: white;\" href=\"albumPlayer.php?id=".$albumInfo["ID"]."\">Vai all'allbum</a>";
                    }
                    ?>
                    </div>
                    <small class="text-muted"><?php echo $likeNumber ?> likes </small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /*
    function toggleLike($button,$dbh){
        
    }*/
?>

<script>
    var oldStyle;
    var isOn = false;
    
    function likeOn(button){
        oldStyle = button.style;
        button.style.backgroundColor = "#ff0000";
        button.style.borderColor = "#ff0000";

        console.log("likeOn");
    }

    function likeOff(button){
        button.style = oldStyle;

        console.log("likeOff");
    }

    function swtch(button){
        console.log("onSWITCH");
        if(isOn){
            console.log("onON");
            likeOff(button);
            isOn = false;
        } else {
            console.log("onOFF");
            likeOn(button);
            isOn = true
        }
    }
    
    /*lo script servirà solo per la logica estetica mentre la gestione del db con php
    prima cosa da fare è la funzione in php
    */
    /*function likeOn(button){
        console.log("toggleLike called");
        //rifinire animazione
        button.style.backgroundColor = "#ff0000";
        button.style.borderColor = "#ff0000";
        //


    }

    /*function likeOff(button){
        return false;
        return true;
    }*/
</script>

<?php } ?>