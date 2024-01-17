
<?php

    function renderSong($songInfo,$dbh) {
        $songid = $songInfo["ID"]; 
        $songtitle = $songInfo["Titolo"];
        $authorid=$songInfo["ID_Utente"];
        $date=$songInfo["Data"];
        $authorname= $dbh->getUserInfo($authorid)["Username"];
        $image = $songInfo["ID_Immagine"];
        $imagePath="download.php?id=".$image;
?>

<div class="row justify-content-center text-center">
    <div class="col-md-6 text-center"> 
        <div class="card rounded-3 text-center">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="songPlayer.php?id=<?php echo $songid ?>" style="color: black"><?php echo $songtitle." (Brano)"?></a>
                </h5>

                <p class="card-text" style="text-align:center;">
                    <?php if ($image != null) { ?>
                        <img src="<?php echo $imagePath; ?>" id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
                    <?php } ?>
                    <br>
                </p>
                <h5 class="card-title">
                    <a href="profile.php?id=<?php echo $authorid ?>" style="color: black"><?php echo $authorname ?></a>
                </h5>
            </div>
            <div> <small class="text-muted" id="songdate" style="font-weight: bold;"><?php echo $date;?></small></div>
        </div>
    </div>
</div>
<?php
    }
?>