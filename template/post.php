<?php
    function renderPost($postInfo, $dbh, $ID_Visualizer) {

?>

<style>
    /*
    .btn:active, .btn.active {
        outline: none !important;
        box-shadow: none !important;
    }

    .btn:focus {
        outline: none;
        box-shadow: none;
    }*/
</style>

<script>
    function likeOn(postId, init){
        let button = document.getElementById("likebutton" + postId);
        let likes = document.getElementById("likenumber" + postId);
        button.style.backgroundColor = "#ff0000";
        button.style.borderColor = "#ff0000";

        button.innerHTML = '<i class="bi bi-heart-fill"></i>';
        
        button.dataset.isOn = "true";
        let n = parseInt(likes.innerText.split(" ")[0]) + 1;
        if(!init)
            likes.innerText = n + " likes";
        console.log("likeOn");
    }

    function likeOff(postId, init){
        let button = document.getElementById("likebutton" + postId);
        let likes = document.getElementById("likenumber" + postId);

        button.style = "btn-dark; margin-right: 5px;"

        button.dataset.isOn = "false";
        button.innerHTML = '<i class="bi bi-heart"></i>';
        let n = parseInt(likes.innerText.split(" ")[0]) - 1;
        if(!init)
            likes.innerText = n + " likes";
        console.log("likeOff");
    }

    function updateLikeVisual(postId, init, visualizerId){

        console.log("started Update")
        let button = document.getElementById("likebutton" + postId);
        
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "updateLike.php?id="+postId, false);
        xhr.send();
        if(button.dataset.isOn === "true"){
            likeOff(postId, init);
        } else {
            likeOn(postId, init);
        }
    }
</script>

<?php


        $userid = $postInfo["ID_Utente"]; //userid è l'id dellutente pubblicatore
        $username = $dbh->getUserInfo($userid)["Username"]; //username è l'username dell'utente pubblicatore
        $image = $postInfo["ID_Immagine"];
        $postId = $postInfo["ID"];
        $likeNumber = $dbh->countLikes($postId);
        $imagePath="download.php?id=".$image;
        $text = $postInfo["Testo"];
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
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha condiviso un brano <?php
                        } else if (!is_null($albumInfo)){
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha condiviso un album<?php
                        } else {
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha aggiunto un post <?php
                        }
                    ?>
                </h5>

                <?php 
                    if(is_null($albumInfo)) {
                        ?>
                        <?php if ($image != null) { ?>
                            <img src="<?php echo $imagePath; ?>" id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
                        <?php }
                            $alignment = null;
                            if (strlen($text) < 150) {
                                $alignment = "text-center";
                            } else {
                                $alignment = "text-left";
                            }
                        ?>
                        <p class="card-text <?php echo $alignment; ?>" style="text-align:left;">
                            <br>
                            <?php echo htmlentities($text); ?>
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

                        <div style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                        <?php foreach ($dbh -> getSongsFromAlbum($idalbum) as $song) {?>                     
                                <div class="song row">
                                        <!-- Song Name (Takes 9 columns) -->
                                    <div class="col-9">
                                        <h4><?php echo $song["Titolo"]; ?></h4>
                                        <!-- Add more song details as needed -->
                                    </div>

                                    <!-- Play Button (Takes 3 columns) -->
                                    <div class="col-3 text-end">
                                    </div>
                                </div>

                                <br>
                            <?php } ?>
                        </div>

              <?php } ?>
                <!-- questo qua sotto sono i pulsanti del post generico-->

                <div class="d-flex justify-content-between align-items-center">
               
                    <div class="btn-group" style="display: flex; align-items: center;">
                        <?php
                        if (isset($_SESSION["ID"])){
                        ?>
                            <button type="button" style="margin-right: 5px;" class="btn btn-dark rounded" onclick="updateLikeVisual(<?php echo $postId; ?>, false, <?php echo $visualizerId?>)" id="likebutton<?php echo $postId; ?>" data-isOn="false">
                                <i class="bi bi-heart"></i>
                            </button>
                            <a class="btn btn-dark rounded" style="margin-right: 5px;" href="comment.php?id=<?php echo $postId ?>">
                                <i class="bi bi-chat-left-dots"></i>
                            </a>
                            <?php
                        }
                        ?>
                        <?php /* echo (!is_null($songInfo) ? '<a class="btn btn-info" style="color: white;" href="songPlayer.php?id='.$songInfo["ID"].'">Vai al brano ('.htmlentities($songInfo["Titolo"]).')</a>' : ''); */?>
                        <?php /* echo (!is_null($albumInfo) ? '<a class="btn btn-info" style="color: white;" href="albumPlayer.php?id='.$albumInfo["ID"].'">Vai all\'album ('.htmlentities($albumInfo["Titolo"]).')</a>' : ''); */?>
                        
                        <?php echo (!is_null($songInfo) ? '<a class="btn btn-dark rounded" style="color: white;" href="songPlayer.php?id='.$songInfo["ID"].'">Vai al brano </a>' : '');?>
                        <?php echo (!is_null($albumInfo) ? '<a class="btn btn-dark rounded" style="color: white;" href="albumPlayer.php?id='.$albumInfo["ID"].'">Vai all\'album </a>' : '');?>

                        <small class="text-muted" style="margin-left: 5px; font-weight: bold;" id="likenumber<?php echo $postId; ?>"><?php echo $likeNumber; ?> likes </small>
                    </div>
                    <div> <small class="text-muted" id="postdate" style="align:right; font-weight: bold;"><?php echo $postInfo["Data"];?></small></div>

                    <?php if($isLiked){echo "<script>likeOn($postId, true);</script>";}?>

                </div>
            </div>
        </div>
    </div>
</div>



<?php } ?>