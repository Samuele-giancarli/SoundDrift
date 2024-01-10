<!DOCTYPE html>
<html>
<head>
    <title>SoundDrift</title>
    <meta charset="UTF-8"/>
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
<button type="button" class="btn btn-primary">
            <i class="bi bi-skip-backward"></i>
        </button>
<button type="button" class="btn btn-primary" id="playButton">
            <i class="bi bi-play"></i> Play
        </button>
        <button type="button" class="btn btn-primary">
            <i class="bi bi-skip-forward"></i> 
</button>


        <p style="display:inline-block" id="title">Nome del brano</p>
        <p style="display:inline-block">-</p>
        <p style="display:inline-block" id="author">Nome dell'artista</p>

        <button type="button" class="btn btn-primary">
            <i class="bi bi-repeat"></i> 
        </button>

        <button type="button" class="btn btn-primary">
            <i class="bi bi-plus-circle-dotted"></i> 
        </button>

        <button type="button" class="btn btn-primary">
            <i class="bi bi-suit-heart"></i> 
        </button>

        <button type="button" class="btn btn-primary">
            <i class="bi bi-music-note-list"></i> 
        </button>
</footer>
</body>
</html>