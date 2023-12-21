<?php
    //Inkludieren der SQL Funktionen
    include "./logic/sql_logic.php";

    // define variables and set to empty values
    $fnameErr = $lnameErr = $emailErr = $usernameErr = $passwd1Err = $passwd2Err = "";
    $gender = $fname = $lname = $email = $username = $passwd1 = $passwd2 = "";
    $registerMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $gender = sanitize_input($_POST["gender"]);
        
        $fname= sanitize_input($_POST["vorname"]);
        // check if firstname only contains letters and whitespace
        if (preg_match("/\d/",$fname)) {
            $fnameErr = "Keine Ziffern erlaubt";
        }

        $lname= sanitize_input($_POST["nachname"]);
        // check if lastname only contains letters and whitespace
        if (preg_match("/\d/",$lname)) {
            $lnameErr = "Keine Ziffern erlaubt";
        }

        if (empty($_POST["email"])) {
            $emailErr = "Bitte wählen Sie eine Email";
        } else {
            $email = sanitize_input($_POST["email"]);
            // check if email is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Ungültiges Email Format";
            }
        }

        if (empty($_POST["username"])) {
            $usernameErr = "Bitte wählen Sie einen Usernamen";
        }else {
            $input_username = sanitize_input($_POST["username"]);
            if(usernameTakenDB($input_username)){
                $usernameErr = "Username bereits vergeben";
            }
        }

        if (empty($_POST["password1"])) {
            $passwd1Err = "Bitte wählen Sie ein Passwort";
        } else {
            $passwd1 = sanitize_input($_POST["password1"]);
        }

        if (empty($_POST["password2"])) {
            $passwd2Err = "Bitte wählen Sie ein Passwort";
        } else {
            $passwd2 = sanitize_input($_POST["password2"]);
        }
        if ($passwd1!=$passwd2){
            $passwd1Err = $passwd2Err = "Passwörter sind nicht gleich";
        }

        if($fnameErr=="" and $lnameErr=="" and $emailErr=="" and $usernameErr=="" and $passwd1Err=="" and $passwd2Err==""){
            $hashedPw = password_hash($passwd1, PASSWORD_DEFAULT);

            if(insertUserDB($gender, $fname, $lname, $email, $input_username, $hashedPw)){
                header("Location: master_data.php"); /* Redirect browser */
            }else{
                $registerMessage = "Oops, da ist etwas schiefgelaufen!";
            }
        }
    }

?>