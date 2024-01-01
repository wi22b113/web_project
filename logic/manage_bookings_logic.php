<?php

//Inkludieren der SQL Funktionen
include "./logic/sql_logic.php";

$roomErr = $arrivalDateErr = $departureDateErr = "";
$errorActive = false;

$roomID = $arrivalDate = $departureDate = $state = $includesBreakfast = $includesParking = $bringsDog = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //$booking = new Booking();

    if (empty($_POST["room"])) {
        $roomErr = "Wählen Sie eine Zimmer Kategorie aus!";
    }else{
        $roomID = sanitize_input($_POST["room"]);
    }

    if (empty($_POST["arrivalDate"])) {
        $arrivalDateErr = "Wählen Sie ein Anreisedatum aus!";
    }else{
        $arrivalDate = sanitize_input($_POST["arrivalDate"]);
    }

    if (empty($_POST["departureDate"])) {
        $departureDateErr = "Wählen Sie ein Abreisedatum aus!";
    }else{
        $departureDate = sanitize_input($_POST["departureDate"]);
    }
    
    if(!empty($_POST["arrivalDate"]) && !empty($_POST["departureDate"])){
        if($arrivalDate>$departureDate || $arrivalDate==$departureDate){
            $departureDateErr = "Abreisedatum kann nicht <= Anreisedatum sein!";
        }
    }

    if (!empty($_POST["state"])) {
        $state = sanitize_input($_POST["state"]);
    }

    $includesBreakfast = sanitize_input($_POST["includesBreakfast"]);
    if (empty($_POST["includesBreakfast"]) || $includesBreakfast != "on") {
        $includesBreakfast = 0;
    }else{
        $includesBreakfast = 1;
    }

    $includesParking = sanitize_input($_POST["includesParking"]);
    if (empty($_POST["includesParking"]) || $includesParking != "on") {
        $includesParking = 0;
    }else{
        $includesParking = 1;
    }

    $bringsDog = sanitize_input($_POST["bringsDog"]);
    if (empty($_POST["bringsDog"]) || $bringsDog != "on") {
        $bringsDog = 0;
    }else{
        $bringsDog = 1;
    }

    if($roomErr == "" && $arrivalDateErr == "" && $departureDateErr == ""){
        if(insertBookingDB($roomID, $arrivalDate, $departureDate, $state, $_SESSION["userID"])){
            if($includesBreakfast==1){
                $bookingID = getBookingID($arrivalDate, $departureDate, $_SESSION["userID"]);
                insertBookingsOptionsDB($bookingID, 1);
            }
            if($includesParking==1){
                $bookingID = getBookingID($arrivalDate, $departureDate, $_SESSION["userID"]);
                insertBookingsOptionsDB($bookingID, 2);
            }
            if($bringsDog==1){
                $bookingID = getBookingID($arrivalDate, $departureDate, $_SESSION["userID"]);
                insertBookingsOptionsDB($bookingID, 3);
            }
            $bookingMessage = "Buchung erfolgreich übermittelt!";
        }else{
            $bookingMessage = "Oops, da ist etwas schiefgelaufen!";
        }
    }else{
        $errorActive = true;
    }

}

?>