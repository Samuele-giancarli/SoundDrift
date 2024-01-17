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

            <a href="home.php" id="logo">
                    <img src="images/App_images/logo3.jpg" width="70" style="display:inline-block">
                    <h1 class="text-white" style="display:inline-block; font-size:27px" >SoundDrift</h1>
            </a>

            <div>

            <?php
                if(isset($_SESSION["ID"])) {
                ?>
                    <div class="btn-group" id="upperButtons">
                        <a id="home" href="home.php" class="btn btn-dark " style="text-decoration:none">
                            <i class="bi bi-house" style="font-size: 20px"></i>
                        </a>
                        <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Carica
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="songUpload.php"><i class="bi bi-plus-square"></i> Carica Canzone</a></li>
                            <li><a class="dropdown-item" href="albumCreate.php"><i class="bi bi-disc-fill"></i> Crea Album</a></li>
                            <li><a class="dropdown-item" href="playlist.php"><i class="bi bi-cassette"></i> Crea Playlist</a></li>
                        </ul>
                        <a href="profile.php?id=<?php echo $_SESSION["ID"] ?>" class="btn btn-dark" style="text-decoration:none">
                            <i class="bi bi-person" style="font-size: 20px"></i>
                        </a>

                        <?php
                        if ($dbh->newNotifications($_SESSION["ID"])){
                            ?>
                            <a href="notifications.php?id=<?php echo $_SESSION["ID"] ?>" class="btn btn-danger" style="text-decoration:none">
                            <i class="bi bi-bell" style="font-size: 20px"></i>
                        </a>
                        <?php
                        }else{
                            ?>
                        <a href="notifications.php?id=<?php echo $_SESSION["ID"] ?>" class="btn btn-dark" style="text-decoration:none">
                            <i class="bi bi-bell" style="font-size: 20px"></i>
                        </a>
                        <?php
                        }
                        
                        ?>
                        <a href="logout.php" class="btn btn-dark" style="text-decoration:none">
                            <i class="bi bi-box-arrow-left" style="font-size: 20px"></i>
                        </a>
                    </div>
                <?php
                } else {
                ?>
                    <a id="loginfromOut" href="login.php" class="btn btn-dark">
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
                <a href="ricerca.php" class="btn btn-dark " style="text-decoration:none">
                        <i class="bi bi-search"></i> <span class="hide-on-mobile">Cerca</span>
                </a>
                <a href="libreria.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-collection"></i> Libreria</span>
                </a>
                </a>
                <a href="upload.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-file-post"></i> Post</span>
                </a>
                </a>
                <a href="settings.php" class="btn btn-dark" style="text-decoration:none">
                        <i class="bi bi-gear"></i> <span class="hide-on-mobile">Impostazioni</span>
                </a>
                </a>
            </div>
        </footer>
        <?php endif ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>