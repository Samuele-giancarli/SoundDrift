
<?php

    function renderComment($commento,$dbh) {
        $idcommento = $commento["ID"];
        $data=$dbh->getCommentInfo($idcommento)["DateTime"];
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
                <a title="autore" href="profile.php?id=<?php echo $id_mandante; ?>" style="color: black; text-decoration:none"><?php echo $authorname; ?></a>
                </h5>
                <p class="card-title">
                   <?php echo htmlentities($testo); ?>
                </p>
            </div>
             <div style="text-align:right"> <small title="data" class="text-muted"><?php echo $data;?></small></div>
        </div>
    </div>
</div>
<?php
    }
?>