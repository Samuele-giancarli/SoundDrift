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

echo "<a href=\"playlistPlayer.php?id=".$idplaylist."\" style=\"color:black; text-decoration:none\">Aggiungi canzoni a: ".$playlistInfo["Titolo"]."</a>";
?>

<form method="GET" action="addToPlaylist.php">
    <input type="text" placeholder="Cerca canzone" name="query">
    <input type="hidden" name="id" value=<?php echo "\"".$idplaylist."\""; ?>>
    <input type="submit" value="Cerca">
</form>

<?php
if (!is_null($search)){
echo "<ul>";
    $rows=$dbh->searchSongsbyTitleWithFilter($search, $idplaylist);
    foreach ($rows as $song){
        $authorInfo=$dbh->getUserInfo($song["ID_Utente"]);
        echo "<form action=\"playlistAddSong.php\" method=\"GET\">";
        echo "<li>";
        echo "<input type=\"hidden\" name=\"idsong\" value=\"".$song["ID"]."\">";
        echo "<input type=\"hidden\" name=\"idplaylist\" value=\"".$idplaylist."\">";
        echo "<input type=\"hidden\" name=\"queryused\" value='".jsescape($search)."'>";
        echo "<a href=\"songPlayer.php?id=".$song["ID"]."\" style=\"color:black; text-decoration:none\">".$song["Titolo"]."</a> - ".$authorInfo["Username"]." ";
        echo "<input type=\"submit\" value=\"Aggiungi\">";
        echo "</li></form>";
    }
echo "</ul>";
}
?>

