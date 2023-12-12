<?php

    /*
    //Die SQL Statements werden in Zukunft noch in Funktionen eingebunden, damit diese übersichtlicher werden
    function insertDB($user_Id, $file_path, $comment){
        require_once("dbaccess.php");
        $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

        //Hier weiter machen
        $sql = "INSERT INTO tickets (user_id, file_path, comment) VALUES (?,?,?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iss", $user_Id, $file_path, $comment);
        if($stmt->execute()){
            echo "<h1>Hooray, the picture uplaoded successfully</h1>";
        }else{
            echo "<h2>Picture faile during DB insert</h2>";
        }
        $stmt->close();
        $connection->close();    
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

            header("Location: master_data.php"); /* Redirect browser */
        }
    }

?>