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
        <?php include "./elements/footer.php"; ?>
    </body>
</html>