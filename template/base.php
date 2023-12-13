<!DOCTYPE html>
<html lang="it">
    <head>
        <title><?php echo $templateParams["titolo"]; ?></title>
        <meta charset="UTF-8"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="base2.css">

        <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }

        #second-footer {
            position: relative; /* Modifica qui */
            bottom: 0;
            width: 100%;
        }
    </style>

    </head>    
    <body class="bg-light">
        <header class="bg-dark fixed-top d-flex justify-content-between align-items-center p-4">
            <h1 class="text-light">SoundDrift</h1>
            <div>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-bell"></i>
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-person"></i>
                </button>
            </div>
        </header>
        <main>

        </main>
        <footer class="bg-secondary p-3 text-center">
            Scrivo qualcosa
        </footer>
        
        <footer id="second-footer" class="bg-dark p-3 text-center">
            <div class="container">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cerca
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-collection"></i> Libreria
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-plus-square"></i> Carica
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-gear"></i> Impostazioni
                </button>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>