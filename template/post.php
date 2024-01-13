<style>
    .liked {
        background-color: #ff0000;
        border-color: #ff0000;
    }
</style>

<script>
    let oldStyle;

    function likeOn(postId, init){
        let button = document.getElementById("likebutton" + postId);
        let likes = document.getElementById("likenumber" + postId);
        oldStyle = button.style;
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
        button.style = oldStyle;
        button.dataset.isOn = "false";
        button.innerHTML = '<i class="bi bi-heart"></i>';
        let n = parseInt(likes.innerText.split(" ")[0]) - 1;
        if(!init)
            likes.innerText = n + " likes";
        console.log("likeOff");
    }

    function updateLikeVisual(postId, init){

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
            <div style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
               <?php foreach ($dbh -> getSongsFromAlbum($idalbum) as $song) {?>
                     <!--

                        qua andrà la visualizzazione delle canzoni singole

                    -->

                    
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

                

                 <!--

                        qua andrà la visualizzazione dell'album

                -->     

      <?php } ?>


















                <!-- questo qua sotto sono i pulsanti del post generico-->

                <div class="d-flex justify-content-between align-items-center">
               
                    <div class="btn-group">
                        <?php
                        if (isset($_SESSION["ID"])){
                            ?>
                        <button type="button" class="btn btn-primary" onclick="updateLikeVisual(<?php echo $postId; ?>, false)" id="likebutton<?php echo $postId; ?>" data-isOn="false"><i class="bi bi-heart"></i></button>
                        <a class="btn btn-info" style="color: white" href="comment.php?id=<?php echo $postId ?>"> Commenti </a>
                        <?php
                        }
                        ?>
                        <?php echo (!is_null($songInfo) ? '<a class="btn btn-info" style="color: white;" href="songPlayer.php?id='.$songInfo["ID"].'">Vai al brano</a>' : ''); ?>
                        <?php echo (!is_null($albumInfo) ? '<a class="btn btn-info" style="color: white;" href="albumPlayer.php?id='.$albumInfo["ID"].'">Vai all\'album</a>' : ''); ?>
                        
                        <small class="text-muted" id="likenumber<?php echo $postId; ?>"><?php echo $likeNumber; ?> likes</small>
                    </div>

                    <?php if($isLiked){echo "<script>likeOn($postId, true);</script>";}?>

                </div>
            </div>
        </div>
    </div>
</div>



<?php } ?>