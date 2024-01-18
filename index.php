<!DOCTYPE html>
<html lang="it">
<head>
    <title>SoundDrift</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Major%20Mono%20Display">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="queue.js"></script>
</head>
<body>
<audio id="audio"></audio>
<iframe src="home.php"></iframe>
<footer class="bg-opacity-10 bg-secondary text-center">
<span class="hide-on-mobile">
  <label for="volume" style="display: none;">Volume:</label>
  <input type="range" min="0" max="1" value="1" step="0.01" id="volume" onchange="volumeUpdate();" oninput="volumeUpdate();">
</span>
        <button type="button" class="btn btn-dark" id="playButton">
            <em class="bi bi-play"></em> <span class="hide-on-mobile">Play</span>
        </button>
    
        <button type="button" class="btn btn-dark" onclick="prevSong();">
            <em class="bi bi-skip-backward"></em>
        </button>

        <div class="dropup-center dropup" style="display:inline-block">
        <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Stai ascoltando
        </button>
        <ul class="dropdown-menu">
                            <li><a href="#" id="title"  style="text-align:center" class="link-primary dropdown-item">Brano</a></li>
                            <li><a href="#" id="author"  style="text-align:center" class="dropdown-item">Artista</a></li>
                            
        </ul>
</div>
        <button type="button"  class="btn btn-dark" onclick="nextSong();">
            <em class="bi bi-skip-forward"></em> 
        </button>

        <span class="hide-on-mobile"><button type="button" class="btn btn-dark" id="loopButton" onclick="enableLoop();">
            <em class="bi bi-arrow-repeat"></em> Enable Loop
        </button></span>

        <div class="dropup-center dropup hide-on-mobile" style="display:inline-block">
        <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Prossimo in coda</button>
        <ul class="dropdown-menu">
        <li> <a href="#" id="next" style="text-align:center" title="Next Page"></a></li>
        </ul>
        </div>
</footer>
</body>
</html>