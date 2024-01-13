
<?php

    function renderAlbum($albumInfo,$dbh) {
        $albumid = $albumInfo["ID"]; 
        $albumtitle = $albumInfo["Titolo"];
        $authorid=$albumInfo["ID_Utente"];
        $authorname= $dbh->getUserInfo($authorid)["Username"];
        $image = $albumInfo["ID_Immagine"];
        $imagePath="download.php?id=".$image;
?>

<div class="row justify-content-center text-center">
    <div class="col-md-6 text-center"> 
        <div class="card rounded-3 text-center">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="albumPlayer.php?id=<?php echo $albumid ?>" style="color: black"><?php echo $albumtitle." (Album)" ?></a>
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
        </div>
    </div>
</div>
<?php
    }
?>