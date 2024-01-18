<?php
    function renderPost($postInfo, $dbh, $ID_Visualizer) {

?>

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
        $title=null; 

        $userImage = $dbh->getUserInfo($userid)["ID_Immagine"];
        $userImagePath="download.php?id=".$userImage;
        
        //fino a qui sono tutte informazzioni sul post e il poster

        $isAlbum = $dbh->isPostAlbum($postId);
        $isSong = $dbh->isPostSong($postId);
        $songInfo=null;
        $albumInfo=null;

        $visualizerId = $ID_Visualizer; //questo è l'id dell'eventuale visualizzatore

        $isLiked = $dbh->isLikedBy($postId,$visualizerId);

        if (!is_null($postInfo["ID_Canzone"])){
            $songInfo= $dbh->getSongInfo($postInfo["ID_Canzone"]);
            $title = $songInfo["Titolo"];
        }

        if (!is_null($postInfo["ID_Album"])){
            $albumInfo=$dbh->getAlbumInfo($postInfo["ID_Album"]);
            $title = $albumInfo["Titolo"];
            $idalbum = $albumInfo["ID"];
        }
?>

<div class="row justify-content-center text-center">
    <div class="col-md-6 text-center"> 
        <div class="card rounded-3 text-center">
            <div class="card-body">

                <h5 class="card-title">
                    <?php
                        if ($userImage!= null){ ?>
                            <img src="<?php echo $userImagePath; ?>" class="rounded-circle" style="width: 50px; height: 50px;" alt="Profile picture">
                        <?php } ?>
                    <?php
                        if (!is_null($songInfo)){
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha condiviso un brano <?php
                        } else if (!is_null($albumInfo)){
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha condiviso un album<?php
                        } else {
                            ?> <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username ?></a> ha condiviso un post <?php
                        }
                    ?>
                </h5>

                <?php if ($image != null) { ?>
                    <img src="<?php echo $imagePath; ?>" class="img-thumbnail" style="width: 150px; height: 150px;" alt="Post picture">
                <?php } ?>

                <?php
                    $alignment = null;
                    if (strlen($text) < 150) {
                        $alignment = "text-center";
                    } else {
                        $alignment = "text-left";
                    }
                ?>
                <p class="card-text <?php echo $alignment; ?>" style="text-align:left">
                <?php if ($isSong || $isAlbum){?>
                    <br>
                    <?php echo "<strong>".htmlentities($title)."</strong>"; ?>
                    <br>
                <?php } ?>
                    <?php echo htmlentities($text); ?>
                    <br>
                </p>

                <?php 
                    if(!is_null($albumInfo)) {?>
                    <div style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                        <?php foreach ($dbh->getSongsFromAlbum($idalbum) as $song) {
                            $image = $song["ID_Immagine"];
                            $imagePath = "download.php?id=" . $image;
                        ?>
                            <div style="display: flex; align-items: center;">
                                <img src="<?php echo $imagePath; ?>" class="img-thumbnail" style="width: 100px; height: 100px; margin-right: 10px;" alt="Song picture">

                                <p style="margin: 0;"><?php echo $song["Titolo"]; ?></p>
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
                        
                        <?php echo (!is_null($songInfo) ? '<a class="btn btn-dark rounded" style="color: white;" href="songPlayer.php?id='.$songInfo["ID"].'"><i class="bi bi-music-note-beamed"></i> brano </a>' : '');?>
                        <?php echo (!is_null($albumInfo) ? '<a class="btn btn-dark rounded" style="color: white;" href="albumPlayer.php?id='.$albumInfo["ID"].'"><i class="bi bi-music-note-list"></i> album </a>' : '');?>

                        <small class="text-muted" style="margin-left: 5px; font-weight: bold;" id="likenumber<?php echo $postId; ?>"><?php echo $likeNumber; ?> likes </small>
                    </div>
                    <span class="hide-on-mobile"> <small class="text-muted" style="text-align:right; font-weight: bold;"><?php echo $postInfo["Data"];?></small></span>

                    <?php if($isLiked){echo "<script>likeOn($postId, true);</script>";}?>

                </div>
            </div>
        </div>
    </div>
</div>



<?php } ?>