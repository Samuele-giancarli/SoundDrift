<!DOCTYPE html>
<html lang="it">
    <head>
        <title><?php echo $templateParams["titolo"]; ?></title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="../SoundDrift/css/style.css" aria-atomic="">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Major Mono Display">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>

    <body class="bg-light">
        <header class="bg-black fixed-top d-flex justify-content-between align-items-center">
            <!--<h1 class="text-light"><button><a href="index.php" style="text-decoration:none"> <img src="images\logo.png" width=70>SoundDrift </a></button></h1>
            -->

            <a href="index.php">
                <!-- da rivedere per il discorso del percorso assoluto -->
                    <img src="http://localhost/SoundDrift/images/App_images/logo3.jpg" width="70" style="display:inline-block">
                    <h1 class="text-white" style="display:inline-block; font-size:27px" >SoundDrift</h1>
            </a>

            <div>

                <?php
                if(isset($_SESSION["ID"])) {
                ?>
                <a href="songUpload.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-plus-square" style="font-size: 20px"></i>
                </a>
                <a href="albumCreate.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-disc-fill" style="font-size: 20px"></i>
                </a>
                    <a href="profile.php?utenteCorrente=<?php echo $_SESSION["ID"] ?>" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-person" style="font-size: 20px"></i>
                    </a>
                    <a href="#" class="btn btn-dark" style="text-decoration:none">
                    <i class="bi bi-bell" style="font-size: 20px"></i>
                    </a>

                    <a href="logout.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-box-arrow-left" style="font-size: 20px"></i>
                    </a>
                <?php
                } else {
                ?>
                    <a href="login.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-box-arrow-in-right" style="font-size: 20px"></i>
                    </a>
                <?php
                }
                ?>
            </div>
        </header>
        
        <main>
            <?php 
                if(isset($templateParams["nome"])){
                    require($templateParams["nome"]);
                }
            ?>
        </main>

        <footer class="bg-secondary text-center">
        <button type="button" class="btn btn-primary">
                    <i class="bi bi-skip-backward"></i>
                </button>
        <button type="button" class="btn btn-primary">
                    <i class="bi bi-play"></i> Play
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-skip-forward"></i> 
        </button>


                <p style="display:inline-block"><a href="https://www.voiceevolutioninstitute.it/teams/view/aisja-baglioni" style="text-decoration:none">Nome del brano</a></p>
                <p style="display:inline-block">-</p>
                <p style="display:inline-block"><a href="https://www.voiceevolutioninstitute.it/teams/view/aisja-baglioni" style="text-decoration:none">Nome dell'artista</a></p>

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
        
        <footer id="second-footer" class="bg-black text-center">
            <div class="container">
                <a href="#" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-search"></i> Cerca
                </a>
                <a href="#" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-collection"></i> Libreria
                </a>
                <a href="upload.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-file-post"></i> Post
                </a>
                <a href="#" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-gear"></i> Impostazioni
                </a>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>