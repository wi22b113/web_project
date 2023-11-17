<?php
    session_start();
    include "common_functions.php";
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Hotel Tramonto</title>
        <meta charset="UTF-8">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="description" content="Hotel Bacher Buchungsplatform">
        <meta name="author" content="Philipp Huber/Matthias Teuschl">
        <meta http-equiv="refresh" content="30">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Import Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
        <!--Link Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <!--Link stylesheet-->
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>    
        <header>
            <?php
            $currentPage = 'Index';
            include "header.php";
            ?>
            <h1>Hotel Tramonto</h1>
        </header>
        <main>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/Hotel-1.jpeg" class="d-block w-100" alt="Bild des Hotels">
                    </div>
                    <div class="carousel-item">
                        <img src="img/Hotel-2.jpeg" class="d-block w-100" alt="Bild des Hotels">
                    </div>
                    <div class="carousel-item">
                        <img src="img/Hotel-3.jpeg" class="d-block w-100" alt="Bild des Hotels">
                    </div>
                    <div class="carousel-item">
                        <img src="img/Hotel-4.jpeg" class="d-block w-100" alt="Bild des Hotels">
                    </div>
                    <div class="carousel-item">
                        <img src="img/Hotel-5.jpeg" class="d-block w-100" alt="Bild des Hotels">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </main>
        <footer>
            &copy 2023
        </footer>
    </body>

</html>