<!DOCTYPE html>
<html lang="it">
    <head>
        <title><?php echo $templateParams["titolo"]; ?></title>
        <meta charset="UTF-8"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


        <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            text-align: center;
            font-family: 'Major Mono Display', monospace;
        }

        main {
            flex: 1;
        }

        footer {
            background-color:gainsboro;
            color:black;
            text-align: center;
            padding: 0.5rem;
            width:100%;
        }

        footer a:link{
            color:black;
        }

        footer a:visited{
            color:black;
        }

        footer a:hover{
            color:black;
        }

        #second-footer {
            position: relative; /* Modifica qui */
            bottom: 0;
            width: 100%;
            padding:0.5rem;
        }

        #second-footer a:link{
            color:white
        }

        #second-footer a:visited{
            color:white
        }

        #second-footer a:hover{
            color:aquamarine
        }
        </style>
    </head>

    <body class="bg-light">
        <header class="bg-dark fixed-top d-flex justify-content-between align-items-center">
            <h1 class="text-light"><button><a href="index.php" style="text-decoration:none"> <img src="images\logo.png" width=70>SoundDrift </a></button></h1>
            <div>
                <button type="button" class="btn btn-light"> <a href="https://www.voiceevolutioninstitute.it/teams/view/aisja-baglioni" style="text-decoration:none">
                    <i class="bi bi-bell"></i></a>
                </button>
                <button type="button" class="btn btn-light"> <a href="profile.php" style="text-decoration:none">
                    <i class="bi bi-person"></i></a>
                </button>
            </div> -->

            <a href="base.html">
                <!-- da rivedere per il discorso del percorso assoluto -->
                <img src="http://localhost/SoundDrift/images/logo3.jpg" width="70" style="display:inline-block">
                <h1 class="text-white" style="display:inline-block; font-size:27px" >SoundDrift</h1>
            </a>
            <div>
                <button type="button" class="btn btn-light bg-black"> <a href="#" style="text-decoration:none">
                    <i class="bi bi-bell" style="font-size: 20px"></i></a>
                </button>
                <button type="button" class="btn btn-light bg-black"> <a href="#" style="text-decoration:none">
                    <i class="bi bi-person" style="font-size: 20px"></i></a>
                </button>
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
            <button type="button" class="btn btn-dark"><a href="https://www.voiceevolutioninstitute.it/teams/view/aisja-baglioni" style="text-decoration:none">
                    <i class="bi bi-search"></i> Cerca
    </a></button>
            <button type="button" class="btn btn-dark"><a href="https://www.voiceevolutioninstitute.it/teams/view/aisja-baglioni"style="text-decoration:none">
                    <i class="bi bi-collection"></i> Libreria
    </a></button>
            <button type="button" class="btn btn-dark"><a href="https://www.voiceevolutioninstitute.it/teams/view/aisja-baglioni"style="text-decoration:none">
                    <i class="bi bi-plus-square"></i> Carica
    </a></button>
            <button type="button" class="btn btn-dark"><a href="https://www.voiceevolutioninstitute.it/teams/view/aisja-baglioni"style="text-decoration:none">
                    <i class="bi bi-gear"></i> Impostazioni
    </a></button>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>