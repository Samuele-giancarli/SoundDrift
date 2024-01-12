
<?php
function jsescape($s) {
    return str_replace("'", "\\'", $s);
}
if (!isset($_SESSION["ID"])){
    die();
}

$idutente=$_SESSION["ID"];
$userInfo= $dbh->getUserInfo($idutente);
$imageID="default.png";

?>
<p>Questi sono i brani che ti piacciono:</p>

<?php
$rows= $dbh -> getLikedSongs($idutente);
//var_dump($rows);
if (count($rows)!=0){
echo "<button type=\"button\" onclick=\"";
foreach ($rows as $song){
    echo "window.parent.playNow({";
    echo "'title': '".jsescape($song["Titolo"])."',";
    $userInfo = $dbh->getUserInfo($song["ID_Utente"]);
    echo "'author': '".jsescape($userInfo["Username"])."',";
    echo "'url': 'download.php?id=".$song["ID_Audio"]."'";
    echo "},true);";
}
echo "\">Aggiungi tutto in coda</button>";
echo "<br>";
}

?>
<div>Brani: </div>

<ol>
<?php
foreach ($rows as $song){
    $userInfo = $dbh->getUserInfo($song["ID_Utente"]);
    echo "<li><a style=\"color: black;\" href=\"songPlayer.php?id=".$song["ID"]."\">".htmlentities($song["Titolo"])."</a> -  <a style=\"color: black;\" href=\"profile.php?id=".$userInfo["ID"]."\">".htmlentities($userInfo["Username"])."</a>";
    for ($i=0; $i<2; $i++) {
        echo " <button type=\"button\" onclick=\"";
        echo "window.parent.playNow({";
        echo "'title': '".jsescape($song["Titolo"])."',";
        echo "'author': '".jsescape($userInfo["Username"])."',";
        echo "'url': 'download.php?id=".$song["ID_Audio"]."'";
        echo "},";
        if($i == 0) {
            echo "false";
        } else {
            echo "true";
        }
        echo ");";
        echo "\">";
        if($i == 0) {
            echo "Riproduci";
        } else {
            echo "Aggiungi in coda";
        }
        echo "</button>\n";
    }
    echo "</li>";
}
?>
</ol>