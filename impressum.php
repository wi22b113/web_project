<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Impressum</title>
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
            $currentPage = 'Impressum';
            include "header.php";
            ?>
            <h1>Impressum</h1>
        </header>
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h2>Hotel-Tramonto GmbH</h2>
                        Rechtsform: Gesellschaft mit beschränkter Haftung <br>
                        Unternehmensgegenstand: Hotellerie<br>
                        UID-Nr.: ATU 12345678<br>
                        FN: FN 12345z <br>
                        FB-Gericht: Handelsgericht Wien <br>
                        Sitz: Wien <br>
                        <br>
                        Adresse:<br>
                        Tuchlauben 8<br>
                        1010 Wien<br>
                        Österreich<br> <br>
                        Tel: +43 (0) 12345-6 <br>
                        E-Mail: hotel-tramonto@gmail.com<br><br>

                        Kammerzugehörigkeit: Wirtschaftskammer Österreich, ÖHV <br>
                        Berufsverband: Österreichs Hotellerie <br>
                        Berufsrecht: <a
                            href="https://www.ris.bka.gv.at/GeltendeFassung.wxe?Abfrage=Bundesnormen&Gesetzesnummer=10007517">Gewerbeordnung</a>:
                        <a href="https://www.ris.bka.gv.at/">ris.bka.gv.at</a><br>
                        Aufsichtsbehörde: Magistrat der Stadt Wien <br><br>

                        Verbraucher haben die Möglichkeit,
                        Beschwerden an die Online Streitbeilegungsplattform der EU zu
                        richten: <a href="http://ec.europa.eu/odr">ec.europa.eu/odr</a>.<br>
                        Sie können allfällige Beschwerde auch an die oben angegebene <a
                            href="mailto:hotel-tramonto@gmail.com">E-Mail-Adresse</a> richten.<br><br>

                        Geschäftsführer: Philipp Huber, Matthias Teuschl <br>
                        Geschäftsanteile: Philipp Huber (50%), Matthias Teuschl (50%)
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-6">
                        <h2>Hotelverwaltung</h2>
                        <h3>Managing Directors</h3>
                        <div class="row justify-content-start mt-3">
                            <div class="col-md-6">
                                <article>
                                    <figure>
                                        <img class="directorpictures" src="img/PhilippH.jpg"
                                            alt="Bild von Philipp Huber">
                                        <figcaption>Philipp Huber</figcaption>
                                    </figure>
                                </article>
                            </div>
                            <div class="col-md-6">
                                <article>
                                    <figure>
                                        <img class="directorpictures" src="img/MatthiasT.JPG"
                                            alt="Bild von Matthias Teuschl">
                                        <figcaption>Matthias Teuschl</figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            &copy 2023
        </footer>
    </body>
</html>