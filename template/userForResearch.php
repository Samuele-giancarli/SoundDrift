<?php
    function renderUser($userInfo,$dbh) {
        $userid = $userInfo["ID"]; 
        $username = $userInfo["Username"];
        $image = $userInfo["ID_Immagine"];
        $imagePath="download.php?id=".$image;
?>

<div class="row justify-content-center text-center">
    <div class="col-md-6 text-center"> 
        <div class="card rounded-3 text-center">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="profile.php?id=<?php echo $userid ?>" style="color: black"><?php echo $username. " (Utente)" ?></a>
                </h5>

                <p class="card-text" style="text-align:center;">
                    <?php if ($image != null) { ?>
                        <img src="<?php echo $imagePath; ?>" id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
                    <?php } ?>
                    <br>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>