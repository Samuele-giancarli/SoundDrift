
<p title="notifiche" class="titolo">Le tue notifiche:</p>
<?php 

    if(!is_null($_SESSION["ID"])){

        $userId = $_SESSION["ID"];

        foreach ($dbh->getListOfNotifications($userId) as $notifica) {
            renderNotification($notifica,$dbh);
        }
    } else {
        echo "Solo chi è loggato può vedere le proprie notifiche";
    }

?>