<!DOCTYPE html>
<html>
<head>
    <title>SoundDrift</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" aria-atomic="">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Major Mono Display">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="queue.js"></script>
</head>
<body>
<audio id="audio"></audio>
<iframe src="home.php" width="100%" height="100%"></iframe>
<footer class="bg-secondary text-center">
        <input type="range" min="0" max="1" value="1" step="0.01" id="volume" onchange="volumeUpdate();" oninput="volumeUpdate();"></input>

        <button type="button" class="btn btn-primary" onclick="prevSong();">
            <i class="bi bi-skip-backward"></i>
        </button>
        <button type="button" class="btn btn-primary" id="playButton">
            <i class="bi bi-play"></i> Play
        </button>
    


        <p style="display:inline-block" id="title">Nome del brano</p>
        <p style="display:inline-block">-</p>
        <p style="display:inline-block" id="author">Nome dell'artista</p>

        <button type="button"  class="btn btn-primary" onclick="nextSong();">
            <i class="bi bi-skip-forward"></i> 
        </button>

        <button type="button" class="btn btn-primary" id="loopButton" onclick="enableLoop();">
            <i class="bi bi-arrow-repeat"></i> Enable Loop
        </button>

        <p style="display:inline-block">Prossimo in coda:</p>
        <p style="display:inline-block" id="next"></p>

 <!--      <button type="button" class="btn btn-primary">
            <i class="bi bi-plus-circle-dotted"></i> 
        </button> 

        <button type="button" class="btn btn-primary">
            <i class="bi bi-suit-heart"></i> 
        </button>

        <button type="button" class="btn btn-primary">
            <i class="bi bi-music-note-list"></i> 
        </button> -->
</footer>
</body>
</html>