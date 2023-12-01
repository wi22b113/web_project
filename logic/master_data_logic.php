<?php
    // define variables and set to empty values
    $fnameErr = $lnameErr = $emailErr = $usernameErr = $passwd1Err = $passwd2Err = $oldPasswdErr = "";
    $gender = $fname = $lname = $email = $username = $passwd1 = $passwd2 = $oldPasswd ="";

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
        } else {
            $username = sanitize_input($_POST["username"]);
        }

        if($fnameErr=="" and $lnameErr=="" and $emailErr=="" and $usernameErr==""){
            $_SESSION["user"] = $username;
            $_SESSION["gender"] = $gender;
            $_SESSION["firstname"] = $fname;
            $_SESSION["lastname"] = $lname;
            $_SESSION["email"] = $email;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && sanitize_input($_POST["action"]) === "update-userPasswd" && (isset($_POST["password1"]) || isset($_POST["password2"]))) {

        $oldPasswd = sanitize_input($_POST["oldPasswd"]);

        if($oldPasswd === $_SESSION["password"]){
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

        if($passwd1Err=="" and $passwd2Err==""){
            $_SESSION["password"] = $passwd1;
        }

    }elseif($_SERVER["REQUEST_METHOD"] == "POST" && sanitize_input($_POST["action"]) === "update-userPasswd"){
        
        $oldPasswd = sanitize_input($_POST["oldPasswd"]);

        if($oldPasswd === $_SESSION["password"]){
            $passwordcheck = true; 
        }else{
            $passwordcheck = false;
            $oldPasswdErr = "Falsches Passwort!";
        }
    }
?>