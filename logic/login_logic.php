<?php

    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT `id`,`username`,`email`,`password` FROM Users WHERE username=?";

    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("s", $username);

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

    if ($_SERVER["REQUEST_METHOD"] == "POST" and $usernameErr=="" and $passwdErr=="") {

        $select_stmt->execute();
        $select_stmt->bind_result($id, $username, $email, $password);
        $select_stmt->fetch();

        //HIER MUSS NOCH WEITERGEMACHT WERDEN !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        if(password_verify($passwd, $password)){
            $_SESSION["user"] = $username;
            $_SESSION["gender"] = "männlich";
            $_SESSION["firstname"] = "adminVorname";
            $_SESSION["lastname"] = "adminNachname";
            $_SESSION["email"] = "admin@email.com";
            $_SESSION["password"] = $passwd;
            $_SESSION["bookingNumber"] = 0;          
            header("Location: master_data.php"); // Redirect browser 
        }else{
            $passwdErr = "Falsches Passwort";
        }
    }
?>