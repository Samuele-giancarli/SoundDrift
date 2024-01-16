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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="queue.js"></script>
</head>
<body>
<audio id="audio"></audio>
<iframe src="home.php" width="100%" height="100%"></iframe>
<footer class="bg-opacity-10 bg-secondary text-center">
<span class="hide-on-mobile"><input type="range" min="0" max="1" value="1" step="0.01" id="volume" onchange="volumeUpdate();" oninput="volumeUpdate();"></input></span>

        <button type="button" class="btn btn-primary" id="playButton">
            <i class="bi bi-play"></i> <span class="hide-on-mobile">Play</span>
        </button>
    
        <button type="button" class="btn btn-primary" onclick="prevSong();">
            <i class="bi bi-skip-backward"></i>
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
       <!-- <p class="text-primary"style="display:inline-block; inline-size:15%; word-break: break-word;" id="title" >Brano </p>
        <p style="display:inline-block">di</p>
        <p style="display:inline-block; inline-size:15%;  word-break: break-word;  " id="author"> Artista</p> -->

        <button type="button"  class="btn btn-primary" onclick="nextSong();">
            <i class="bi bi-skip-forward"></i> 
        </button>

        <span class="hide-on-mobile"><button type="button" class="btn btn-primary" id="loopButton" onclick="enableLoop();">
            <i class="bi bi-arrow-repeat"></i> Enable Loop
        </button></span>

        <div class="dropup-center dropup" style="display:inline-block">
        <span class="hide-on-mobile"> 
        <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Prossimo in coda</button>
        <ul class="dropdown-menu">
        <li a href="#" id="next" style="text-align:center"></a></li>
        </ul>
        </div>
        </span>
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