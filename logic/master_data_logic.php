<?php

    //Inkludieren der SQL Funktionen
    include "./logic/sql_logic.php";


    // define variables and set to empty values
    $fnameErr = $lnameErr = $emailErr = $usernameErr = $passwd1Err = $passwd2Err = $oldPasswdErr = "";
    $gender = $fname = $lname = $email = $username = $passwd1 = $passwd2 = $oldPasswd ="";
    $updateUserDataMessage = $updateUserPasswdMessage = "";

    $id = $_SESSION["id"];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && sanitize_input($_POST["action"]) === "update-userdata") {

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
            if(!($input_username == $_SESSION["user"])){
                //Check if username is already taken
                if(usernameTakenDB($input_username)){
                    $usernameErr = "Username bereits vergeben";
                }
            }
        }

        if($fnameErr=="" and $lnameErr=="" and $emailErr=="" and $usernameErr==""){
            if(updateUserDataDB($gender, $fname, $lname, $email, $input_username, $id)){
                $updateUserDataMessage = "Stammdaten erfolgreich aktualisiert!";
            }else{
                $updateUserDataMessage = "Oops, da ist etwas schiefgelaufen!";
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && sanitize_input($_POST["action"]) === "update-userPasswd" && (isset($_POST["password1"]) || isset($_POST["password2"]))) {


        $oldPasswd = sanitize_input($_POST["oldPasswd"]);

        if(password_verify($oldPasswd, getUserPasswdDB($_SESSION["user"]))){
            $passwordcheck = true; 
        }else{
            $passwordcheck = false;
            $oldPasswdErr = "Falsches Passwort!"; 
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

        if($passwd1Err=="" and $passwd2Err=="" && $oldPasswdErr==""){
            $hashedPw = password_hash($passwd1, PASSWORD_DEFAULT);
            if(updateUserPasswdDB($hashedPw, $id)){
                $updateUserPasswdMessage = "Passwort erfolgreich aktualisiert!";
            }else{
                $updateUserPasswdMessage = "Oops, da ist etwas schiefgelaufen!";
            }
        }

    }elseif($_SERVER["REQUEST_METHOD"] == "POST" && sanitize_input($_POST["action"]) === "update-userPasswd"){
        
        $oldPasswd = sanitize_input($_POST["oldPasswd"]);

        if(password_verify($oldPasswd, getUserPasswdDB($_SESSION["user"]))){
            $passwordcheck = true;
        }else{
            $passwordcheck = false;
            $oldPasswdErr = "Falsches Passwort!";
        }

    }
?>