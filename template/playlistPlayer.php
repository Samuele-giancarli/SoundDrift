<?php
function jsescape($s) {
    return str_replace("'", "\\'", $s);
}
if (!isset($_GET["id"])){
    die();
}

$idplaylist=$_GET["id"];
$info=$dbh->getPlaylistInfo($idplaylist);
$userInfo=$dbh->getUserInfo($info["ID_Utente"]);
$idutente=$userInfo["ID"];

?>
<script>
function playlistLike(){
    let button=document.getElementById("like");
    let xhr=new XMLHttpRequest();
    xhr.open('GET', 'playlistLike.php?id=' + <?php echo "'".$idplaylist."'"; ?>);
    xhr.onload=playlistLikeDone;
    xhr.send();
}

function playlistLikeDone() {
    let button=document.getElementById("like");
    button.innerText="Togli dalla libreria";
    button.onclick = playlistUnlike;
}

function playlistUnlike(){
    let button=document.getElementById("like");
    let xhr=new XMLHttpRequest();
    xhr.open('GET', 'playlistUnlike.php?id=' + <?php echo "'".$idplaylist."'"; ?>);
    xhr.onload=playlistUnlikeDone;
    xhr.send();
    
}

function playlistUnlikeDone() {
    let button=document.getElementById("like");
    button.innerText="Aggiungi in libreria";
    button.onclick = playlistLike;
}
</script>

<p class="titolo"><?php echo $info["Titolo"]." (Playlist)"; ?></p>
<div class="mb-3">Titolo: <?php echo $info["Titolo"]; ?></div>
<div class="mb-3">Autore: <?php echo "<a class=\"link-primary\"  href=\"profile.php?id=".$userInfo["ID"]."\">".htmlentities($userInfo["Username"])."</a>"; ?></div>

<?php 
if (!is_null($info["ID_Immagine"])){
?>
<div>Copertina: <img <?php echo "src=\"download.php?id=".$info["ID_Immagine"]."\""; ?>  id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;" /></div>
<?php
}

$rows= $dbh -> getSongsFromPlaylist($idplaylist);
?>
<div class="mb-3">
<?php
if (count($rows)!=0){
echo "<button class=\"btn btn-dark\" type=\"button\" onclick=\"";
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
?>
</div>

<div class="mb-3">
<?php
if (isset($_SESSION["ID"])){
if ($dbh -> isPlaylistLiked($idutente, $idplaylist)){
    echo "<button class=\"btn btn-dark\" id=\"like\" type=\"button\" onclick=\"playlistUnlike();\">Togli da Libreria</button>";
}else{
    echo "<button class=\"btn btn-dark\" id=\"like\" type=\"button\" onclick=\"playlistLike();\">Aggiungi a Libreria</button>";    
}
if ($_SESSION["ID"]==$info["ID_Utente"]){
    echo "<a class=\"btn btn-dark\" id=\"playlist\" href=\"addToPlaylist.php?id=".$idplaylist."\">Aggiungi canzoni</a>";
}
}
?>
</div>
<p class="mt-4">Brani:</p>

<ol class="list-group list-group-numbered">
<?php
foreach ($rows as $song){
    $songInfo=$dbh->getSongInfo($song["ID"]);
    $userInfo = $dbh->getUserInfo($song["ID_Utente"]);
    echo "<li class=\"list-group-item\"><a class=\"link-primary\" href=\"songPlayer.php?id=".$song["ID"]."\">".htmlentities($song["Titolo"])."</a> -  <a style=\"color: black;\" href=\"profile.php?id=".$userInfo["ID"]."\">".htmlentities($userInfo["Username"])."</a>";
    for ($i=0; $i<2; $i++) {
        echo " <button class=\"btn btn-secondary\" type=\"button\" onclick=\"";
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
            echo "Coda";
        }
        echo "</button>\n";
    }
    echo "</li>";
}
?>
</ol>