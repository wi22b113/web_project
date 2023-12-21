<?php
    //Inkludieren der SQL Funktionen
    include "./logic/sql_logic.php";


    // define variables and set to empty values
    $usernameErr = $passwdErr = "";
    $input_username = $passwd = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Bitte wählen Sie einen Usernamen";
        } else {
            $input_username = sanitize_input($_POST["username"]);
        }
    
        if (empty($_POST["password"])) {
            $passwdErr = "Bitte wählen Sie ein Passwort";
        } else {
            $passwd = sanitize_input($_POST["password"]);
        }

    }


    if ($_SERVER["REQUEST_METHOD"] == "POST" and $usernameErr=="" and $passwdErr=="") {

        if(loginUserDB($input_username, $passwd)){
            header("Location: master_data.php"); // Redirect browser 
        }else{
            $passwdErr = "Falscher Username oder Passwort";
            $usernameErr = " "; //Damit auch das Username Eingabefeld rot erscheint
        }

    }


