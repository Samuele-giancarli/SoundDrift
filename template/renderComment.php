
<?php

    function renderComment($commento,$dbh) {
        $idcommento = $commento["ID"];
        $testo = $commento["Testo"];
        $id_mandante = $commento["ID_Utente"];
        $id_post = $commento["ID_Post"];
        $authorname= $dbh->getUserInfo($id_mandante)["Username"];
?>

<div class="row justify-content-center text-left">
    <div class="col-md-6 text-left"> 
        <div class="card rounded-3 text-left">
            <div class="card-body">
                <h5 class="card-title">
                <a href="profile.php?id=<?php echo $id_mandante; ?>" style="color: black; text-decoration:none"><?php echo $authorname; ?></a>
                </h5>
                <p class="card-title">
                   <?php echo htmlentities($testo); ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>