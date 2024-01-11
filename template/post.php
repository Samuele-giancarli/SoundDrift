<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<?php
    function renderPost($postInfo, $dbh) {
        $userid = $postInfo["ID_Utente"];
        $image = $postInfo["ID_Immagine"];
        $Text = $postInfo["Testo"];
        $username = $dbh->getUserInfo($userid)["Username"];
        $imagePath="download.php?id=".$image;
        $likes = null;
        ?>

        <div class="row justify-content-center text-center">
            <div class="col-md-6 text-center"> 
                <div class="card rounded-3 text-center">
                    <div class="card-body">
                        <h5 class="card-title"> <a href="profile.php?utenteCorrente= <?php echo $userid ?>" style="color: black"> <?php echo $username ?> </a> </h5>
                        <p class = "card-text"> 
                            <?php if($image!= null) { ?>
                                <img src = <?php echo $imagePath; ?>  id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" />
                            <?php } ?>
                            <br>
                            <?php echo $Text?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Like</button>
                                <button type="button" class="btn btn-secondary">Condividi</button>
                            </div>
                            <small class="text-muted">10 likes</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
?>