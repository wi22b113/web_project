<?php
$user = [];
    $user["admin"] = "admin";

    // define variables and set to empty values
    $usernameErr = $passwdErr = "";
    $username = $passwd = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Bitte wählen Sie einen Usernamen";
        } else {
            $username = sanitize_input($_POST["username"]);
        }
    
        if (empty($_POST["password"])) {
            $passwdErr = "Bitte wählen Sie ein Passwort";
        } else {
            $passwd = sanitize_input($_POST["password"]);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" and $usernameErr=="" and $passwdErr=="" and $user[$username] === $passwd) {
        $_SESSION["user"] = $username;
        $_SESSION["gender"] = "männlich";
        $_SESSION["firstname"] = "adminVorname";
        $_SESSION["lastname"] = "adminNachname";
        $_SESSION["email"] = "admin@email.com";
        $_SESSION["password"] = $passwd;
        $_SESSION["bookingNumber"] = 0;
        header("Location: master_data.php"); /* Redirect browser */
    }
?>