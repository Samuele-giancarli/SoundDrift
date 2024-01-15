<?php
    function renderNotification($notifica,$dbh){
        $id = $notifica["ID"];
        $testo = $notifica["Testo"];
        $id_mandante = $notifica["ID_Mandante"];
        $date=$notifica["DateTime"];
        $id_post = $notifica["ID_Post"];
        $userInfo=$dbh->getUserInfo($id_mandante);
        $username=$userInfo["Username"];

        /*?> <p> <?php echo $id ?> </p> <?php ;
        ?> <p> <?php echo $testo ?> </p> <?php ;
        ?> <p> <?php echo $id_mandante ?> </p> <?php ;
        ?> <p> <?php echo $id_post ?> </p> <?php ;*/

        ?>

            <div class="container mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p><?php echo "<a class=\"link-primary\" style=\"color:blue; text-decoration:none\" href=\"profile.php?id=".$id_mandante."\">".htmlentities($username)." </a>".htmlentities($testo);
                                if (!is_null($id_post)){
                                echo "<a style=\"color:blue; text-decoration:none\" href=\"comment.php?id=".$id_post."\">post</a>";
                                }?>
                                </p>
                            </div>
                            <div> <small class="text-muted" id="notificadate" style="align:right"><?php echo $date;?></small></div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php
    }
?>