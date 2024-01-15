<!DOCTYPE html>
<html lang="it">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo $templateParams["titolo"]; ?></title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="css/style.css" aria-atomic="">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Major Mono Display">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    </head>

    <body class="bg-light">
        <header class="bg-black fixed-top d-flex justify-content-between align-items-center">
            <!--<h1 class="text-light"><button><a href="home.php" style="text-decoration:none"> <img src="images\logo.png" width=70>SoundDrift </a></button></h1>
            -->

            <a href="home.php">
                <!-- da rivedere per il discorso del percorso assoluto -->
                    <img src="images/App_images/logo3.jpg" id="logo" width="70" style="display:inline-block">
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
                    <a href="profile.php?id=<?php echo $_SESSION["ID"] ?>" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-person" style="font-size: 20px"></i>
                    </a>
                    <a href="notifications.php?id=<?php echo $_SESSION["ID"] ?>" class="btn btn-dark" style="text-decoration:none">
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
        
        <?php
            if(isset($_SESSION["ID"])):
        ?>
        <footer id="second-footer" class="bg-black text-center">
            <div class="container">
                <a href="ricerca.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-search"></i> Cerca
                </a>
                <a href="libreria.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-collection"></i> Libreria
                </a>
                <a href="upload.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-file-post"></i> Post
                </a>
                <a href="settings.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-gear"></i> Impostazioni
                </a>
            </div>
        </footer>
        <?php endif ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>