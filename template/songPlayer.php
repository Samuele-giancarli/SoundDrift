<?php
function jsescape($s) {
    return str_replace("'", "\\'", $s);
}

if (!isset($_GET["id"])){
    die();
}

$idcanzone=$_GET["id"];
$info=$dbh->getSongInfo($idcanzone);
$userInfo=$dbh->getUserInfo($info["ID_Utente"]);
$idutente=$userInfo["ID"];
$audioInfo = $dbh->getResourceInfo($info["ID_Audio"]);
$alreadyin=$dbh->inWhichPlaylists($idcanzone);
for($i = 0; $i < count($alreadyin); $i++) {
    $alreadyin[$i] = $alreadyin[$i]["ID_Playlist"];
}
?>

<script>
function duration() {
    let audio = document.getElementById("song");
    let durataElement = document.getElementById("durata");
    let durata = audio.duration | 0;
    let ore = (durata / 3600) | 0;
    durata -= ore * 3600;
    let minuti = (durata / 60) | 0;
    let secondi = durata % 60;
    if (ore!=0){
    durataElement.innerText = "Durata: " + ore + "h" + minuti + "m" + secondi + "s";
    }else{
    durataElement.innerText = "Durata: " + minuti + "m" + secondi + "s";
    }
    audio.volume = 0;
    audio.play();
}

function play(enqueue) {
    let data = {};
    data.title = <?php echo "'".jsescape($info["Titolo"])."'"; ?>;
    data.author = <?php echo "'".jsescape($userInfo["Username"])."'"; ?>;
    data.url = <?php echo "'download.php?id=".$info["ID_Audio"]."'"; ?>;
    window.parent.playNow(data, enqueue);
}

function songLike(){
    let button=document.getElementById("like");
    let xhr=new XMLHttpRequest();
    xhr.open('GET', 'songLike.php?id=' + <?php echo "'".$idcanzone."'"; ?>);
    xhr.onload=songLikeDone;
    xhr.send();
}

function songLikeDone() {
    let button=document.getElementById("like");
    button.innerText="Rimuovi dai piaciuti";
    button.onclick = songUnlike;
}

function songUnlike(){
    let button=document.getElementById("like");
    let xhr=new XMLHttpRequest();
    xhr.open('GET', 'songUnlike.php?id=' + <?php echo "'".$idcanzone."'"; ?>);
    xhr.onload=songUnlikeDone;
    xhr.send();
    
}

function songUnlikeDone() {
    let button=document.getElementById("like");
    button.innerText="Aggiungi ai piaciuti";
    button.onclick = songLike;
}
</script>

<p class="titolo"><?php echo $info["Titolo"]; ?></p>
<div title="titolo" class="mb-3">Titolo: <?php echo $info["Titolo"]; ?></div>
<div title="autore" class="mb-3">Autore: <?php echo "<a class=\"link-primary\" href=\"profile.php?id=".$userInfo["ID"]."\">".htmlentities($userInfo["Username"])."</a>"; ?></div>
<div title="genere" class="mb-3">Genere: <?php echo $info["Genere"]; ?></div>

<?php 
if (!is_null($info["ID_Immagine"])){
?>
<div class="mb-3"><img alt="songCover" <?php echo "src=\"download.php?id=".$info["ID_Immagine"]."\""; ?>  id="profile-pic" class="img-thumbnail" style="width: 150px; height: 150px;"></div>
<?php
}
?>

<div class="mb-3" id="durata"></div>
<div><audio id="song">

<source
<?php
echo "src=\"download.php?id=".$audioInfo["ID"]."\" ";
echo "type=\"".$audioInfo["MimeType"]."\">";
?>
>
</audio></div>

<?php 
if (!is_null($info["ID_Album"])){
    $albumInfo=$dbh->getAlbumInfo($info["ID_Album"]);
?>
<div title="album di cui fa parte" class="mb-3">Album di appartenenza: <?php echo "<a class=\"link-primary\" href=\"albumPlayer.php?id=".$albumInfo["ID"]."\">".htmlentities($albumInfo["Titolo"])."</a>"; ?></div>
<?php
}
?>

<div class="mb-3">
<button title="riproduci" type="button" class="btn btn-dark" onclick="play(false)">Riproduci</button>
<script>
let audio = document.getElementById("song");
audio.ondurationchange = duration;
audio.oncanplaythrough = duration;
</script>


<button title="aggiungi in coda" type="button" class="btn btn-dark" onclick="play(true)">Aggiungi in coda</button>
</div>

<div class="mb-3">
<?php
if (isset($_SESSION["ID"])){
    if ($dbh -> isSongLiked($_SESSION["ID"], $idcanzone)){
        echo "<button title=\"non mi piace più\" class=\"btn btn-dark\" id=\"like\" type=\"button\" onclick=\"songUnlike();\">Rimuovi da Piaciuti </button>";
    }else{
        echo "<button title=\"mi piace\" class=\"btn btn-dark\" id=\"like\" type=\"button\" onclick=\"songLike();\">Aggiungi a Piaciuti </button>";    
    }
        echo "<a title=\"condividi\" class=\"btn btn-dark\" id=\"share\" href=\"upload.php?songid=".$idcanzone."\">Condividi</a>";
}
?>
</div>

<form id="playlist" method="GET" action="songAssoc.php" enctype="multipart/form-data" class="mt-4" >
<div class="mb-3">
<label for="playlists" class="form-label"> Aggiungi a playlist: </label>
<select class="form-control" id="playlists" name="playlist" form="playlist">

    <?php
    $stmt = $dbh->db->prepare("SELECT * FROM playlist WHERE ID_Utente=?");
    $idcreatore=$_SESSION["ID"];
    $stmt->bind_param("i", $idcreatore);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()){
        if(in_array($row["ID"], $alreadyin)) {
            continue;
        }
        echo "<option value=".$row["ID"].">".htmlentities($row["Titolo"])."</option>";
        $dbh->addSongToPlaylist($idcanzone, $row["ID"]);
    }
    ?>
    </select>  
</div>
    <input type="hidden" name="songid" value=<?php echo "'".$idcanzone."'"; ?>>
    <button title="aggiungi" type="submit" class="btn btn-secondary">Aggiungi</button>
</form>


