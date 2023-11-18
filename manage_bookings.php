<?php
    include "objects.php";
    session_start();
    include "common_functions.php";

    $roomErr = $arrivalDateErr = $departureDateErr = "";
    $errorActive = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $booking = new Booking();

        if (empty($_POST["room"])) {
            $roomErr = "Wählen Sie eine Zimmer Kategorie aus!";
        }else{
            $room = sanitize_input($_POST["room"]);
            $booking->set_Room($room);
        }

        if (empty($_POST["arrivalDate"])) {
            $arrivalDateErr = "Wählen Sie ein Anreisedatum aus!";
        }else{
            $arrivalDate = sanitize_input($_POST["arrivalDate"]);
            $booking->set_arrivalDate(date_create($arrivalDate));
        }

        if (empty($_POST["departureDate"])) {
            $departureDateErr = "Wählen Sie ein Abreisedatum aus!";
        }else{
            $departureDate = sanitize_input($_POST["departureDate"]);
            $booking->set_departureDate(date_create($departureDate));
        }
        
        if(!empty($_POST["arrivalDate"]) && !empty($_POST["departureDate"])){
            if($booking->get_arrivalDate()>$booking->get_departureDate() || $booking->get_arrivalDate()==$booking->get_departureDate()){
                $departureDateErr = "Abreisedatum kann nicht <= Anreisedatum sein!";
            }
        }
    
        if (!empty($_POST["state"])) {
            $booking->set_State(sanitize_input($_POST["state"]));
        }

        $breakfast = sanitize_input($_POST["includesBreakfast"]);
        if (empty($_POST["includesBreakfast"]) || $breakfast != "on") {
            $booking->set_includesBreakfast(false);
        }else{
            $booking->set_includesBreakfast(true);
        }

        $parking = sanitize_input($_POST["includesParking"]);
        if (empty($_POST["includesParking"]) || $parking != "on") {
            $booking->set_includesParking(false);
        }else{
            $booking->set_includesParking(true);
        }

        $bringsDog = sanitize_input($_POST["bringsDog"]);
        if (empty($_POST["bringsDog"]) || $bringsDog != "on") {
            $booking->set_bringsDog(false);
        }else{
            $booking->set_bringsDog(true);
        }

        if(isset($_SESSION["bookings"]) && $roomErr == "" && $arrivalDateErr == "" && $departureDateErr == ""){
            $booking->set_number(++$_SESSION["bookingNumber"]);
            $_SESSION['bookings'][] = $booking;
        }elseif($roomErr == "" && $arrivalDateErr == "" && $departureDateErr == ""){
            $booking->set_number(++$_SESSION["bookingNumber"]);
            $_SESSION["bookings"] = array($booking);
        }

        if($roomErr != "" || $arrivalDateErr != "" || $departureDateErr != ""){
            $errorActive = true;
        }

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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div>
                                <label for="room"></label>
                                <select class="mb-3 form-select <?php if($roomErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="room" name="room" aria-label="room" required>
                                    <option value "" disabled selected>Zimmer Kategorie</option>
                                    <option <?php if ($errorActive && isset($room) && $room=="Master Suite") echo "selected";?> >Master Suite</option>
                                    <option <?php if ($errorActive && isset($room) && $room=="Junior Suite") echo "selected";?> >Junior Suite</option>
                                    <option <?php if ($errorActive && isset($room) && $room=="Superior Room") echo "selected";?> >Superior Room</option>
                                    <option <?php if ($errorActive && isset($room) && $room=="Luxury Room") echo "selected";?> >Luxury Room</option>
                                    <option <?php if ($errorActive && isset($room) && $room=="Luxury Extended Room") echo "selected";?> >Luxury Extended Room</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php if($roomErr!=""){echo $roomErr;} ?> 
                                </div>
                            </div>

                            <div>
                                <input type="hidden" id="state" name="state" value="new">
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control <?php if($arrivalDateErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="arrivalDate" name="arrivalDate" placeholder="a" <?php if($errorActive){echo "value=\"". $arrivalDate . "\"";}?> required>
                                <div class="invalid-feedback">
                                    <?php if($arrivalDateErr!=""){echo $arrivalDateErr;} ?> 
                                </div>
                                <label for="arrivalDate">Anreisedatum</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control <?php if($departureDateErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="departureDate" name="departureDate" placeholder="a" <?php if($errorActive){echo "value=\"". $departureDate . "\"";}?> required>
                                <div class="invalid-feedback">
                                    <?php if($departureDateErr!=""){echo $departureDateErr;} ?> 
                                </div>
                                <label for="departureDate">Abreisedatum</label>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input border-primary" id="includesBreakfast" name="includesBreakfast" placeholder="a" <?php if ($errorActive && $breakfast=="on"){echo "checked=\"checked\"";} ?>>
                                <label class="form-check-label" for="includesBreakfast">Frühstück erwünscht?</label>
                            </div>


                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input border-primary" id="includesParking" name="includesParking" placeholder="a" <?php if ($errorActive && $parking=="on"){echo "checked=\"checked\"";} ?>>
                                <label class="form-check-label" for="includesParking">Parkplatz erwünscht?</label>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input border-primary" id="bringsDog" name="bringsDog" placeholder="a" <?php if ($errorActive && $bringsDog=="on"){echo "checked=\"checked\"";} ?>>
                                <label class="form-check-label" for="bringsDog">Ich nehme meinen Hund mit!</label>
                            </div>

                            <div class="col mb-3">
                                <button class="btn btn-outline-danger" type="reset">Reset</button>
                                <button class="btn btn-outline-primary" type="submit">Buchung Bestätigen</button>
                                <br><br>
                                <?php
                                    // Printing out the booking objects in $_SESSION["bookings"]
                                    if(isset($_SESSION["bookings"])) {

                                        $count = count($_SESSION['bookings']);
                                        echo "<h3>Meine Buchungen (Summe: " . $count .")</h3><br>";

                                        for($i=0; $i<$count; $i++) {
                                            echo $_SESSION['bookings'][$i];
                                        }
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