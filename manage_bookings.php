<?php
    include "./logic/objects.php";
    session_start();
    include "./logic/common_functions.php";
    include "./logic/manage_bookings_logic.php";

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
        <link href="./css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <?php
            $currentPage = 'Buchungen';
            include "./elements/header.php";
            ?>
        </header>
        <main>
            <?php if ($_SESSION['admin']==0): ?><h2 class="center mb-3">Neue Buchung</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div>
                                <label for="room"></label>
                                <select class="mb-3 form-select <?php if($roomErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="room" name="room" aria-label="room" required>
                                    <option value "" disabled selected>Zimmer Kategorie</option>
                                    <option value="1" <?php if ($errorActive && isset($room) && $room=="1") echo "selected";?> >Master Suite</option>
                                    <option value="2" <?php if ($errorActive && isset($room) && $room=="2") echo "selected";?> >Junior Suite</option>
                                    <option value="3" <?php if ($errorActive && isset($room) && $room=="3") echo "selected";?> >Superior Room</option>
                                    <option value="4" <?php if ($errorActive && isset($room) && $room=="4") echo "selected";?> >Luxury Room</option>
                                    <option value="5" <?php if ($errorActive && isset($room) && $room=="5") echo "selected";?> >Luxury Extended Room</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php if($roomErr!=""){echo $roomErr;} ?> 
                                </div>
                            </div>

                            <div>
                                <input type="hidden" id="state" name="state" value="neu">
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
                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && $bookingMessage !== "") {
                                        if($bookingMessage == "Buchung erfolgreich übermittelt!"){
                                            echo "<h2 class='text-primary'>" . $bookingMessage . "</h2>";
                                        }else{
                                            echo "<h2 class='text-danger'>" . $bookingMessage . "</h2>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <?php
                        displayUserBookings(getUserBookings($_SESSION["user"]));
                        ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2 class='center mb-3'>Buchungen</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <div>
                                <label for="filter">Filter (Buchungsstatus):</label>
                                <select class="mb-3 mt-2 form-select border-primary" id="filter" name="filter" aria-label="filter">
                                    <option value=""<?php if (isset($filter) && $filter=="") echo "selected";?> >kein Filter</option>
                                    <option <?php if (isset($filter) && $filter=="neu") echo "selected";?> >neu</option>
                                    <option <?php if (isset($filter) && $filter=="bestätigt") echo "selected";?> >bestätigt</option>
                                    <option <?php if (isset($filter) && $filter=="storniert") echo "selected";?> >storniert</option>
                                </select>
                            </div>
                            <button class="btn btn-outline-primary mb-3" type="submit">Filter anwenden</button>
                        </form>
                        <?php
                        if($filter==""){
                            displayAllBookings(getAllBookings());
                        }else{
                            displayAllBookings(getFilteredBookings($filter));
                        }
                        ?>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <h2 class='center mt-3 mb-3'>Buchungsstatus ändern</h2>
                        <div class="col-md-4">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                <div>
                                    <label for="change_booking_id"></label>
                                    <select class="mt-2 form-select border-primary" id="change_booking_id" name="change_booking_id" aria-label="booking_id">
                                        <option value "" disabled selected>Buchungs-ID</option>
                                        <?php
                                        $bookingIDArray = getBookingIDs();
                                        foreach ($bookingIDArray as $bookingID){
                                            echo "<option>" . $bookingID . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="change_booking_state"></label>
                                    <select class="mb-3 form-select border-primary" id="change_booking_state" name="change_booking_state" aria-label="change_booking_state">
                                        <option value "" disabled selected>Buchungsstatus</option>
                                        <option>neu</option>
                                        <option>bestätigt</option>
                                        <option>storniert</option>
                                    </select>
                                </div>
                                <button class="btn btn-outline-primary" type="submit">Buchungsstatus ändern</button>
                                <br><br>
                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST" && $changeBookingMessage !== "") {
                                    if($changeBookingMessage == "Status erfolgreich geändert!"){
                                        echo "<h2 class='text-primary'>" . $changeBookingMessage . "</h2>";
                                    }else{
                                        echo "<h2 class='text-danger'>" . $changeBookingMessage . "</h2>";
                                    }
                                }
                                ?>
                            </form>
                        </div>
                </div>
            </div>
            <?php endif ?>
        </main>
        <?php include "./elements/footer.php"; ?>
    </body>
</html>