
<?php

function jsescape($s) {
    return str_replace("'", "\\'", $s);
}

if (!isset($_SESSION["ID"])){
    die();
}

$search=$_GET["query"] ?? null;
$idplaylist=$_GET["id"];
if (!isset($idplaylist)){
    die();
}
$playlistInfo=$dbh->getPlaylistInfo($idplaylist);


?>

<form method="GET" action="addToPlaylist.php" class="mt-4">
    <fieldset>
<legend><?php echo "Aggiungi canzoni a: "."<a title=\"playlist corrente\" class=\"link-primary\" href=\"playlistPlayer.php?id=".$idplaylist."\">".htmlentities($playlistInfo['Titolo'])."</a>";?></legend>
    <div class="mb-3">
        <label for="query" class="form-label">Cerca canzoni:</label>
        <input type="text" title="cerca il brano" id="query" name="query" class="form-control" placeholder="Nome del brano" required>
</div>
    <input type="hidden" name="id" value=<?php echo "\"".$idplaylist."\""; ?>>
    <button type="submit" title="conferma ricerca" class="btn btn-dark">Cerca</button>
</fieldset>
</form>


<ul class="list-group">
<?php
if (!is_null($search)){
    $rows=$dbh->searchSongsbyTitleWithFilter($search, $idplaylist);
    foreach ($rows as $song){
        ?>    
        <?php
        $authorInfo=$dbh->getUserInfo($song["ID_Utente"]);
        ?>
        <form action="playlistAddSong.php" method="GET" class="mt-4">
        <li class="list-group-item">
        <?php 
        echo "<input type=\"hidden\" name=\"idsong\" value=\"".$song["ID"]."\">";
        echo "<input type=\"hidden\" name=\"idplaylist\" value=\"".$idplaylist."\">";
        echo "<input type=\"hidden\" name=\"queryused\" value='".jsescape($search)."'>";
        echo "<a class=\"link-primary\" href=\"songPlayer.php?id=".$song["ID"]."\">".$song["Titolo"]."</a> - ".$authorInfo["Username"]." ";
        echo "<button type=\"submit\" class=\"btn btn-secondary\">Aggiungi</button>";
        ?>
        </li></form>
        <?php
    }
    ?>
        </ul>
<?php
}
?>

