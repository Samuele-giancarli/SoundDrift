
<?php
$dbh->setNotificationsRead($_SESSION["ID"]);

    function renderNotification($notifica,$dbh){
        $id = $notifica["ID"];
        $testo = $notifica["Testo"];
        $id_mandante = $notifica["ID_Mandante"];
        $date=$notifica["DateTime"];
        $id_post = $notifica["ID_Post"];
        $userInfo=$dbh->getUserInfo($id_mandante);
        $username=$userInfo["Username"];

        ?>

            <div class="container mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p><?php echo "<a title=\"profilo\" class=\"link-primary\" style=\"color:blue; text-decoration:none\" href=\"profile.php?id=".$id_mandante."\">".htmlentities($username)." </a>".htmlentities($testo);
                                if (!is_null($id_post)){
                                echo "<a style=\"color:blue; text-decoration:none\" href=\"comment.php?id=".$id_post."\">post</a>";
                                }?>
                                </p>
                            </div>
                            <div> <small title="data" class="text-muted" style="text-align:right"><?php echo $date;?></small></div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php
    }
?>