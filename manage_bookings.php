<?php
    include "booking.php";
    session_start();
    include "common_functions.php";

    $bookingCounter = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $booking = new booking();


        $booking->set_number(++$bookingCounter);
        

        if (!empty($_POST["room"])) {
            $booking->set_Room(sanitize_input($_POST["room"]));
        }

        if (!empty($_POST["arrivalDate"])) {
            $booking->set_arrivalDate(sanitize_input($_POST["arrivalDate"]));
        }

        if (!empty($_POST["departureDate"])) {
            $booking->set_departureDate(sanitize_input($_POST["departureDate"]));
        }

        if (!empty($_POST["state"])) {
            $booking->set_State(sanitize_input($_POST["state"]));
        }

        if (empty($_POST["includesBreakfast"]) || sanitize_input($_POST["includesBreakfast"]) != "on") {
            $booking->set_includesBreakfast(false);
        }else{
            $booking->set_includesBreakfast(true);
        }

        if (empty($_POST["includesParking"]) || sanitize_input($_POST["includesParking"]) != "on") {
            $booking->set_includesParking(false);
        }else{
            $booking->set_includesParking(true);
        }

        if (empty($_POST["bringsDog"]) || sanitize_input($_POST["bringsDog"]) != "on") {
            $booking->set_bringsDog(false);
        }else{
            $booking->set_bringsDog(true);
        }

        $_SESSION["booking"] = $booking;


    }
?> 

<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Buchungen</title>
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
            $currentPage = 'Buchungen';
            include "header.php";
            ?>
        </header>
        <main>
            <h2 class="center mb-3">Buchungen</h2>
            <h4 class="center mb-3">Kein Error-Handling umgesetzt</h4>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div>
                                <label for="room"></label>
                                <select class="form-select border-primary mb-3" id="room" name="room" aria-label="room" required>
                                    <option value "" disabled selected>Room Category</option>
                                    <option>Master Suite</option>
                                    <option>Junior Suite</option>
                                    <option>Superior Room</option>
                                    <option>Luxury Room</option>
                                    <option>Luxury Extended Room</option>
                                </select>
                            </div>

                            <div>
                                <input type="hidden" id="state" name="state" value="new">
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control border-primary" id="arrivalDate" name="arrivalDate" placeholder="a" required>
                                <label for="arrivalDate">Anreisedatum</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control border-primary" id="departureDate" name="departureDate" placeholder="a" required>
                                <label for="departureDate">Abreisedatum</label>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input border-primary" id="includesBreakfast" name="includesBreakfast" placeholder="a">
                                <label class="form-check-label" for="includesBreakfast">Frühstück erwünscht?</label>
                            </div>


                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input border-primary" id="includesParking" name="includesParking" placeholder="a">
                                <label class="form-check-label" for="includesParking">Parkplatz erwünscht?</label>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input border-primary" id="bringsDog" name="bringsDog" placeholder="a">
                                <label class="form-check-label" for="bringsDog">Ich nehme meinen Hund mit!</label>
                            </div>

                            <div class="col mb-3">
                                <button class="btn btn-outline-danger" type="reset">Reset</button>
                                <button class="btn btn-outline-primary" type="submit">Buchung Bestätigen</button>
                                <br><br>
                                <?php
                                    if(isset($_SESSION["booking"])){
                                        echo "<h3>Meine Buchungen:</h3>";
                                        echo "Buchungsnummer: ";
                                        echo $bookingCounter;
                                        echo $_SESSION["booking"]->get_number(); echo "<br>";
                                        echo "Zimmer: ";
                                        echo $_SESSION["booking"]->get_room(); echo "<br>";
                                        echo "Ankunftsdatum: ";
                                        echo $_SESSION["booking"]->get_arrivalDate(); echo "<br>";
                                        echo "Abreisedatum: ";
                                        echo $_SESSION["booking"]->get_departureDate(); echo "<br>";
                                        echo "Status: ";
                                        echo $_SESSION["booking"]->get_State(); echo "<br>";
                                        echo "Frühstück: ";
                                        echo $_SESSION["booking"]->get_includesBreakfast(); echo "<br>";
                                        echo "Parkplatz: ";
                                        echo $_SESSION["booking"]->get_includesParking(); echo "<br>";
                                        echo "Bringt Hund mit: ";
                                        echo $_SESSION["booking"]->get_bringsDog(); echo "<br>";
                                    }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </main>
        <footer>
            &copy 2023
        </footer>
    </body>
</html>