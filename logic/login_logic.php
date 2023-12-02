<?php

    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT * FROM Users WHERE username=?";

    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("s", $username);

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

    if ($_SERVER["REQUEST_METHOD"] == "POST" and $usernameErr=="" and $passwdErr=="") {

        $select_stmt->execute();
        $select_stmt->bind_result($id, $sex, $fistname, $lastname, $email, $username, $password, $admin);
        $select_stmt->fetch();

        if(password_verify($passwd, $password)){
            $_SESSION["user"] = $username;
            $_SESSION["gender"] = $sex;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $passwd;
            $_SESSION["admin"] = $admin;
            $_SESSION["bookingNumber"] = 0;      
            header("Location: master_data.php"); // Redirect browser 
        }else{
            $passwdErr = "Falsches Passwort";
        }
    }
?>