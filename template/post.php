<style>
    .liked {
        background-color: #ff0000;
        border-color: #ff0000;
    }
</style>

<script>
    var oldStyle;
    var isOn = false;

    function likeOn(postId){
        var button = document.getElementById(postId);
        oldStyle = button.style;
        button.style.backgroundColor = "#ff0000";
        button.style.borderColor = "#ff0000";

        isOn = true;

        console.log("likeOn");
    }

    function likeOff(postId){
        var button = document.getElementById(postId);
        button.style = oldStyle;

        isOn = false;

        console.log("likeOff");
    }

    function updateLike(postId){

        console.log("started Update")

        var button = document.getElementById(postId);
        if(isOn){
            likeOff(postId);
        } else {
            likeOn(postId)
        }
    }

    /*function swtch(postId){
        var button = document.getElementById(postId);
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
    }*/
    
</script>

<?php
    function generaLike($idPost) {
        $testo = "Like";
        // Genera il pulsante con il testo e l'ID specificati
        return '<button type="button" class="btn btn-primary" onclick="updateLike('.$idPost.')" id="' . $idPost . '" type="button">'. $idPost .'</button>';
    }
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

        $visualizerId = $ID_Visualizer;

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

                <p class="card-text" style="text-align:center;">
                    <?php if ($image != null) { ?>
                        <img src="<?php echo $imagePath; ?>" id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
                    <?php } ?>
                    <br>
                    <?php echo htmlentities($postInfo["Testo"]); ?>
                    <br>
                </p>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">

                        <?php echo generaLike($postId);?>

                        <?php if($isLiked){
                            /*echo "<script>swtch(document.getElementById("?> $postId <?php ");</script>";*/
                            echo "<script>likeOn($postId);</script>";
                        } else {
                            //echo "non piaciuto da te";
                        }?>

                        <button type="button" class="btn btn-secondary">Condividi</button>

                    <?php
                    if (!is_null($songInfo)){
                        echo "<a class=\"btn btn-info\" style=\"color: white;\" href=\"songPlayer.php?id=".$songInfo["ID"]."\">Vai al brano</a>";
                    }
                    if(!is_null($albumInfo)){
                        echo "<a class=\"btn btn-info\" style=\"color: white;\" href=\"albumPlayer.php?id=".$albumInfo["ID"]."\">Vai all'album</a>";
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



<?php } ?>