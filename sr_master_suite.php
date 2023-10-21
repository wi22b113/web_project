<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Master Suite</title>
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
            $currentPage = 'SuitesAndRooms';
            include "header.php";
            ?>
            <h1>Master Suite</h1>
        </header>
        <main>
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/master-suite/ms-suite-1.jpeg" class="d-block w-100" alt="Master Suite Picture 1">
                    </div>
                    <div class="carousel-item">
                        <img src="img/master-suite/ms-suite-2.jpeg" class="d-block w-100" alt="Master Suite Picture 2">
                    </div>
                    <div class="carousel-item">
                        <img src="img/master-suite/ms-suite-3.jpeg" class="d-block w-100" alt="Master Suite Picture 3">
                    </div>
                    <div class="carousel-item">
                        <img src="img/master-suite/ms-suite-4.jpeg" class="d-block w-100" alt="Master Suite Picture 4">
                    </div>
                    <div class="carousel-item">
                        <img src="img/master-suite/ms-suite-5.jpeg" class="d-block w-100" alt="Master Suite Picture 5">
                    </div>
                    <div class="carousel-item">
                        <img src="img/master-suite/ms-suite-6.jpeg" class="d-block w-100" alt="Master Suite Picture 6">
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
            <div class="container text-center">
                <div class="row">
                    <div class="col mt-5">
                        WOHNEN UND SCHLAFEN IN MODERNEM LUXUS. IN DEN GETRENNTEN WOHN- UND SCHLAFBEREICHEN UNSERER 70 M² GROSSEN MASTER SUITE VERMISCHEN 
                        SICH EXQUISITE ANTIQUITÄTEN MIT TRENDIGEN DESIGNERMÖBELN ZU LUXURIÖSER ELEGANZ
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 mt-5 justify-content-start">
                        EINE NACHT AB<br>
                        666 € PRO ZIMMER<br>
                        INKL. FRÜHSTÜCK
                    </div>
                    <div class="col-md-6 mt-5 justify-content-start">
                        Das großzügige Badezimmer mit großer, runder Wanne ist ein Rückzugsort für alle Sinne. 
                        Eingerahmt in Marmor mit zwei Waschbecken, extra Dusche und separater Toilette finden 
                        Sie hier Ihre private Wohlfühloase. Bluetooth Lautsprecher von Bang & Olufsen sorgen 
                        für hervorragenden Sound in Bad und Wohnzimmer. Tiefe Fensterbänke lassen Träume Realität
                        werden. Nachts betten Sie sich wie die englische Königsfamilie und genießen auf den 
                        Boxspringbetten von Vispring besten Schlafkomfort.
                    </div>
                </div>
            </div>
        </main>
        <footer>
            &copy 2023
        </footer>
    </body>
</html>