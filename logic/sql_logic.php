<?php

/**
 * This function inserts a user into the database
 * @param $gender_f
 * @param $fname_f
 * @param $lname_f
 * @param $email_f
 * @param $input_username_f
 * @param $hashedPw_f
 * @return void
 */
function insertUserDB($gender_f, $fname_f, $lname_f, $email_f, $input_username_f, $hashedPw_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlInsert = "INSERT INTO Users (`sex`, `firstname` , `lastname`, `email`, `username`, `password`) VALUES (?,?,?,?,?,?)";
    $insert_stmt = $connection->prepare($sqlInsert);
    $insert_stmt->bind_param("ssssss", $gender_f, $fname_f, $lname_f, $email_f, $input_username_f, $hashedPw_f);
    if(!$insert_stmt->execute()) {
        echo "<h1>Something went wrong</h1>";
    }
    $insert_stmt->close();
    $connection->close();
}

/**
 * This function prooves if a username is already taken in the database
 * @param $input_username_f
 * @return bool
 */
function usernameTakenDB($input_username_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
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

/**
 * This function logs a user in
 * @param $input_username_f --> Entered Username
 * @param $input_passwd_f --> Entered Password
 * @return bool --> True if User was successfully logged in, False if not
 */
function loginUserDB($input_username_f, $input_passwd_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT * FROM Users WHERE username=?";
    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("s", $input_username_f);

    $select_stmt->execute();
    $select_stmt->bind_result($id, $sex, $firstname, $lastname, $email, $username, $password, $admin);
    $select_stmt->fetch();

    $select_stmt->close();
    $connection->close();

    if(password_verify($input_passwd_f, $password)){
        $_SESSION["id"] = $id;
        $_SESSION["user"] = $username;
        $_SESSION["gender"] = $sex;
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        $_SESSION["admin"] = $admin;
        $_SESSION["bookingNumber"] = 0;
        return true;
    }else{
        return false;
    }
}