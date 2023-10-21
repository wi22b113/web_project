<!DOCTYPE html>
<html lang="de">
    <head>
    <title>Hilfe</title>
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
            $currentPage = 'Hilfe';
            include "header.php";
            ?>
            <h1>Hilfe</h1>
        </header>
        <main>
            <div class=" container">
                <div class="row">
                    <div class="col-md-6 mt-5 justify-content-start">
                        <h2>FAQ</h2>
                        <details>
                            <summary>Wie kann ich ein Zimmer buchen?</summary>
                            <p class="text-primary">
                                Um ein Zimmer buchen zu können, klicken Sie in der Menüleiste am
                                rechten oberen Rand auch die Schaltfläche "Buchen" .........
                            </p>
                        </details>
                        <details>
                            <summary>Was ist der Unterschied zwischen einem Doppelzimmer und einem Zweibettzimmer?</summary>
                            <p class="text-primary">
                                Ein Doppelzimmer bietet 1 Doppelbett. Ein Zweibettzimmer bietet 2 Einzelbetten.
                                Wenn ein Zimmer als Doppel-/ oder Zweibettzimmer bezeichnet wird, kann es beide
                                Bettenkonfigurationen zur
                                Verfügung stellen.
                            </p>
                        </details>
                        <details>
                            <summary>Wie kann ich meine Buchung stornieren?</summary>
                            <p class="text-primary">
                                Um ein Reservierung stornieren zu können, müssen Sie sich zuerst einloggen .........
                            </p>
                        </details>
                        <details>
                            <summary>Zahle ich eine Stornierungsgebühr, falls ich meine Buchung stornieren muss?</summary>
                            <p class="text-primary">
                                Wenn Ihre Buchung kostenfrei stornierbar ist, zahlen Sie keine Stornierungsgebühr.
                                Wenn Ihre Buchung nicht oder nicht mehr kostenfrei stornierbar ist, entsteht eventuell eine
                                Stornierungsgebühr.
                            </p>
                        </details>
                        <details>
                            <summary>Ich reise außerhalb der Check-in-Zeiten an. Kann ich trotzdem einchecken?</summary>
                            <p class="text-primary">
                                Gerne können Sie sich auch außerhalb der Check-in-Zeiten einchecken. Wir bitten Sie aber um
                                rechtzeitige
                                Bekanntgabe.
                            </p>
                        </details>
                        <details>
                            <summary>Kann ich Änderungen (z.B. Änderung der Reisedaten) an meiner Buchung vornehmen
                            </summary>
                            <p class="text-primary">
                                Ja. Sie können Änderungen an Ihrer Buchung vornehmen. Sie können von Ihrer
                                Buchungsbestätigung
                                aus oder direkt
                                auf Bacher-Hotel.com auf den entsprechenden Bereich zugreifen.
                            </p>
                        </details>
                    </div>
                    <div class="col-md-6 mt-5 justify-content-start">
                        <h2>Weitere Fragen?</h2>
                        Dann kontaktieren Sie uns doch gerne per E-Mail:
                        <a class="btn btn-outline-primary" onclick="location.href='mailto:hotel-tramonto@gmail.com';">E-Mail senden</a>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            &copy 2023
        </footer>
    </body>
</html>