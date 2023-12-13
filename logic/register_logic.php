<?php

    //Mit den Funktionen funktioniert es leider nicht??????
    /*
    function insertUserDB($gender_f, $fname_f, $lname_f, $email_f, $input_username_f, $hashedPw_f){
        require_once("./db/dbaccess.php");
        $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

        $sqlInsert = "INSERT INTO Users (`sex`, `firstname` , `lastname`, `email`, `username`, `password`) VALUES (?,?,?,?,?,?)";
        $insert_stmt = $connection->prepare($sqlInsert);
        $insert_stmt->bind_param("ssssss", $gender_f, $fname_f, $lname_f, $email_f, $input_username_f, $hashedPw_f);
        if($insert_stmt->execute()){
        }else{
            echo "<h1>Something went wrong</h1>";
        }
        $insert_stmt->close();
        $connection->close();    
    }

    function usernameTakenDB($input_username_f){
        require_once("./db/dbaccess.php");
        $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

        $sqlSelect = "SELECT username FROM Users WHERE username=?";
        $select_stmt = $connection->prepare($sqlSelect);
        $select_stmt->bind_param("s", $input_username_f);

        $select_stmt->execute();
        $select_stmt->bind_result($username);
        $select_stmt->fetch();

        $select_stmt->close();
        $connection->close();    
        
        if($username!=""){
            return true;
        }else{
            return false;
        }
    }
    */

    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    // Prepared statement
    $sqlInsert = "INSERT INTO Users (`sex`, `firstname` , `lastname`, `email`, `username`, `password`) VALUES (?,?,?,?,?,?)";
    $insert_stmt = $connection->prepare($sqlInsert);
    $insert_stmt->bind_param("ssssss", $gender, $fname, $lname, $email, $input_username, $hashedPw);

    $sqlSelect = "SELECT username FROM Users WHERE username=?";
    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("s", $input_username);

    
    // define variables and set to empty values
    $fnameErr = $lnameErr = $emailErr = $usernameErr = $passwd1Err = $passwd2Err = "";
    $gender = $fname = $lname = $email = $username = $passwd1 = $passwd2 = "";

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
            //Check if username is already taken
            $select_stmt->execute();
            $select_stmt->bind_result($username);
            $select_stmt->fetch();
            if($username!=""){
               $usernameErr = "Username bereits vergeben";
            }
            $select_stmt->close();

            /*
            //Mit den Funktionen funktioniert es leider nicht
            if(usernameTakenDB($input_username)){
                $usernameErr = "Username bereits vergeben";
            }
            */
                
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
            $_SESSION["user"] = $input_username;
            $_SESSION["gender"] = $gender;
            $_SESSION["firstname"] = $fname;
            $_SESSION["lastname"] = $lname;
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $passwd1;
            $_SESSION["bookingNumber"] = 0;

            $hashedPw = password_hash($passwd1, PASSWORD_DEFAULT);

            $insert_stmt->execute();
            $insert_stmt->close();
            $connection->close(); 
            //Mit den Funktionen funktioniert es leider nicht
            //insertUserDB($gender, $fname, $lname, $email, $input_username, $hashedPw);

            header("Location: master_data.php"); /* Redirect browser */
        }
    }

?>