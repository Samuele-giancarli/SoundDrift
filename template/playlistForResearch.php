
<?php

    function renderPlaylist($playlistInfo,$dbh) {
        $playlistid = $playlistInfo["ID"]; 
        $playlisttitle = $playlistInfo["Titolo"];
        $authorid=$playlistInfo["ID_Utente"];
        $authorname= $dbh->getUserInfo($authorid)["Username"];
        $image = $playlistInfo["ID_Immagine"];
        $imagePath="download.php?id=".$image;
?>

<div class="row justify-content-center text-center">
    <div class="col-md-6 text-center"> 
        <div class="card rounded-3 text-center">
            <div class="card-body">
                <p class="h5 card-title">
                    <a href="playlistPlayer.php?id=<?php echo $playlistid ?>" style="color: black"><?php echo $playlisttitle." (Playlist)" ?></a>
    </p>

                <p class="card-text" style="text-align:center;">
                    <?php if ($image != null) { ?>
                        <img alt="playlistCover" src="<?php echo $imagePath; ?>"class="img-thumbnail" style="width: 150px; height: 150px;">
                    <?php } ?>
                    <br>
                </p>
                <p class="h5 card-title">
                    <a href="profile.php?id=<?php echo $authorid ?>" style="color: black"><?php echo $authorname ?></a>
                    </p>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>