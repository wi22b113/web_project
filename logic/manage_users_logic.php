<?php

    //Inkludieren der SQL Funktionen
    include "./logic/sql_logic.php";


    // define variables and set to empty values
    $fnameErr = $lnameErr = $emailErr = $usernameErr = "";
    $gender = $fname = $lname = $email = $input_username = $passwd = $admin = $active = "";
    $updateUserDataMessage = "";
    $errorActive = False;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["change_users_id"])) {

        $user_id = sanitize_input($_POST["user_id"]);
        $userToChange = getOneUser($user_id);

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
            if(!($input_username == $userToChange["username"])){
                //Check if username is already taken
                if(usernameTakenDB($input_username)){
                    $usernameErr = "Username bereits vergeben";
                }
            }
        }

        $active= sanitize_input($_POST["active"]);
        if($active=="on"){
            $active=1;
        }else{
            $active=0;
        }
        $admin= sanitize_input($_POST["admin"]);
        if($admin=="on"){
            $admin=1;
        }else{
            $admin=0;
        }

        if($fnameErr=="" and $lnameErr=="" and $emailErr=="" and $usernameErr==""){
            $errorActive = False;
            if(updateUserDataAdminDB($gender, $fname, $lname, $email, $input_username, $user_id, $admin, $active)){
                $updateUserDataMessage = "Stammdaten erfolgreich aktualisiert!";
                if (!empty($_POST["password"])) {
                    $passwd = sanitize_input($_POST["password"]);
                    $hashedPw = password_hash($passwd, PASSWORD_DEFAULT);
                    if(updateUserPasswdDB($hashedPw, $user_id)){
                        $updateUserDataMessage = "Stammdaten erfolgreich aktualisiert!";
                    }else{
                        $updateUserDataMessage = "Oops, da ist etwas schiefgelaufen!";
                    }
                }
            }else{
                $updateUserDataMessage = "Oops, da ist etwas schiefgelaufen!";
            }
        }else{
            $errorActive = True;
        }

    }

?>