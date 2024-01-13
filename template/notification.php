<?php
    function renderNotification($notifica){
        $id = $notifica["ID"];
        $testo = $notifica["Testo"];
        $id_mandante = $notifica["ID_Mandante"];
        $id_post = $notifica["ID_Post"];

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
                                <strong>ID:</strong> <?php echo $id; ?>
                            </div>
                            <div class="col-sm-3">
                                <strong>Testo:</strong> <?php echo htmlentities($testo); ?>
                            </div>
                            <div class="col-sm-3">
                                <strong>ID Mandante:</strong> <?php echo $id_mandante; ?>
                            </div>
                            <div class="col-sm-3">
                                <strong>ID Post:</strong> <?php echo $id_post; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php
    }
?>