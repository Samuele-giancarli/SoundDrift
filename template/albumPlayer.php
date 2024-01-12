<?php
function jsescape($s) {
    return str_replace("'", "\\'", $s);
}
if (!isset($_GET["id"])){
    die();
}
$idalbum=$_GET["id"];
$info=$dbh->getAlbumInfo($idalbum);
$userInfo=$dbh->getUserInfo($info["ID_Utente"]);
$idutente=$userInfo["ID"];

?>
<script>
function albumLike(){
    let button=document.getElementById("like");
    let xhr=new XMLHttpRequest();
    xhr.open('GET', 'albumLike.php?id=' + <?php echo "'".$idalbum."'"; ?>);
    xhr.onload=albumLikeDone;
    xhr.send();
}

function albumLikeDone() {
    let button=document.getElementById("like");
    button.innerText="Togli dalla libreria";
    button.onclick = albumUnlike;
}

function albumUnlike(){
    let button=document.getElementById("like");
    let xhr=new XMLHttpRequest();
    xhr.open('GET', 'albumUnlike.php?id=' + <?php echo "'".$idalbum."'"; ?>);
    xhr.onload=albumUnlikeDone;
    xhr.send();
    
}

function albumUnlikeDone() {
    let button=document.getElementById("like");
    button.innerText="Aggiungi in libreria";
    button.onclick = albumLike;
}
</script>


<div>Titolo: <?php echo $info["Titolo"]; ?></div>
<div>Autore: <?php echo "<a style=\"color:black\" href=\"profile.php?id=".$userInfo["ID"]."\">".htmlentities($userInfo["Username"])."</a>"; ?></div>
<div>Genere: <?php echo $info["Genere"]; ?></div>

<?php 
if (!is_null($info["ID_Immagine"])){
?>
<div>Copertina: <img <?php echo "src=\"download.php?id=".$info["ID_Immagine"]."\""; ?>  id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" /></div>
<?php
}
$rows= $dbh -> getSongsFromAlbum($idalbum);
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
}
if (isset($_SESSION["ID"])&&$info["Finalizzato"]==1){
if ($dbh -> isAlbumLiked($idutente, $idalbum)){
    echo "<button id=\"like\" type=\"button\" onclick=\"albumUnlike();\">Togli dalla libreria</button>";
}else{
    echo "<button id=\"like\" type=\"button\" onclick=\"albumLike();\">Aggiungi in libreria</button>";    
}
}
?>
<div>Brani: </div>

<ol>
<?php
foreach ($dbh -> getSongsFromAlbum($idalbum) as $song){
    echo "<li><a style=\"color: black;\" href=\"songPlayer.php?id=".$song["ID"]."\">".htmlentities($song["Titolo"])."</a>";
    for ($i=0; $i<2; $i++) {
        echo " <button type=\"button\" onclick=\"";
        echo "window.parent.playNow({";
        echo "'title': '".jsescape($song["Titolo"])."',";
        $userInfo = $dbh->getUserInfo($song["ID_Utente"]);
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