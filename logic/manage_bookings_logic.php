<?php

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