<?php 

    if(!is_null($_GET["id"])){

        $userId = $_GET["id"];

        foreach ($dbh->getListOfNotifications($userId) as $notifica) {
            renderNotification($notifica);
        }

    } else {
        echo "solo chi è loggato può vedere le proprie notifiche";
    }

?>