
<?php

    function renderAlbum($albumInfo,$dbh) {
        $albumid = $albumInfo["ID"]; 
        $albumtitle = $albumInfo["Titolo"];
        $authorid=$albumInfo["ID_Utente"];
        $data=$albumInfo["Data"];
        $authorname= $dbh->getUserInfo($authorid)["Username"];
        $image = $albumInfo["ID_Immagine"];
        $imagePath="download.php?id=".$image;
?>

<div class="row justify-content-center text-center">
    <div class="col-md-6 text-center"> 
        <div class="card rounded-3 text-center">
            <div class="card-body">
                <p class="h5 card-title">
                    <a title="nome dell'album" href="albumPlayer.php?id=<?php echo $albumid ?>" style="color: black"><?php echo $albumtitle." (Album)" ?></a>
                     </p>

                <p class="card-text" style="text-align:center;">
                    <?php if ($image != null) { ?>
                        <img alt="coverAlbum" src="<?php echo $imagePath; ?>" class="img-thumbnail" style="width: 150px; height: 150px;">
                    <?php } ?>
                    <br>
                </p>
                <p class="h5 card-title">
                    <a title="autore" href="profile.php?id=<?php echo $authorid ?>" style="color: black"><?php echo $authorname ?></a>
                </p>
            </div>
            <div> <small title="data" class="text-muted" style="font-weight: bold;"><?php echo $data;?></small></div>
        </div>
    </div>
</div>
<?php
    }
?>
