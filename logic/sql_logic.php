<?php

/**
 * This function inserts a user into the database
 * @param $gender_f
 * @param $fname_f
 * @param $lname_f
 * @param $email_f
 * @param $input_username_f
 * @param $hashedPw_f
 * @return bool
 */
function insertUserDB($gender_f, $fname_f, $lname_f, $email_f, $input_username_f, $hashedPw_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlInsert = "INSERT INTO Users (`sex`, `firstname` , `lastname`, `email`, `username`, `password`) VALUES (?,?,?,?,?,?)";
    $insert_stmt = $connection->prepare($sqlInsert);
    $insert_stmt->bind_param("ssssss", $gender_f, $fname_f, $lname_f, $email_f, $input_username_f, $hashedPw_f);
    if($insert_stmt->execute()) {
        $_SESSION["user"] = $input_username_f;
        $_SESSION["userID"] = getUserID($input_username_f);
        $_SESSION["gender"] = $gender_f;
        $_SESSION["firstname"] = $fname_f;
        $_SESSION["lastname"] = $lname_f;
        $_SESSION["email"] = $email_f;
        $insert_stmt->close();
        $connection->close();
        return true;
    }else{
        $insert_stmt->close();
        $connection->close();
        return false;
    }
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
        $_SESSION["user"] = $username;
        $_SESSION["userID"] = $id;
        $_SESSION["gender"] = $sex;
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["email"] = $email;
        $_SESSION["admin"] = $admin;
        return true;
    }else{
        return false;
    }
}

/**
 * @param $gender_f
 * @param $fname_f
 * @param $lname_f
 * @param $email_f
 * @param $username_f
 * @param $id_f
 * @return bool --> True if userdata was successfully updated, False if not
 */
function updateUserDataDB($gender_f, $fname_f, $lname_f, $email_f, $username_f, $id_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlUpdate = "UPDATE Users SET `sex` = ?, `firstname` = ?, `lastname` = ?, `email` = ?, `username` = ? WHERE `Users`.`id` = ?";
    $update_stmt = $connection->prepare($sqlUpdate);
    $update_stmt->bind_param("sssssi", $gender_f, $fname_f, $lname_f, $email_f, $username_f, $id_f);

    if($update_stmt->execute()) {
        $_SESSION["user"] = $username_f;
        $_SESSION["gender"] = $gender_f;
        $_SESSION["firstname"] = $fname_f;
        $_SESSION["lastname"] = $lname_f;
        $_SESSION["email"] = $email_f;
        $update_stmt->close();
        $connection->close();
        return true;
    }else{
        $update_stmt->close();
        $connection->close();
        return false;
    }
}

/**
 * @param $input_username_f
 * @return mixed --> Returns the password of the given user
 */
function getUserPasswdDB($input_username_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT password FROM Users WHERE username=?";
    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("s", $input_username_f);

    $select_stmt->execute();
    $select_stmt->bind_result($password);
    $select_stmt->fetch();

    $select_stmt->close();
    $connection->close();

    return $password;
}

/**
 * @param $hashedPw_f
 * @param $id_f
 * @return bool --> True if the user-password was updated, False if not
 */
function updateUserPasswdDB($hashedPw_f, $id_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlUpdatePasswd = "UPDATE Users SET `password` = ? WHERE `Users`.`id` = ?";
    $update_stmt = $connection->prepare($sqlUpdatePasswd);
    $update_stmt->bind_param("si", $hashedPw_f, $id_f);

    if($update_stmt->execute()) {
        $update_stmt->close();
        $connection->close();
        return true;
    }else{
        $update_stmt->close();
        $connection->close();
        return false;
    }
}

/**
 * This function inserts a booking into the database
 * @param $roomID_f
 * @param $arrivalDate_f
 * @param $departureDate_f
 * @param $bookingState_f
 * @param $breakfast_f
 * @param $parking_f
 * @param $dog_f
 * @param $userID_f
 * @return bool
 */
function insertBookingDB($roomID_f, $arrivalDate_f, $departureDate_f, $bookingState_f, $breakfast_f, $parking_f, $dog_f, $userID_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlInsert = "INSERT INTO Bookings (`room_id_fk`, `arrival_date` , `departure_date`, `booking_state`, `breakfast`, `parking`, `dog`, `user_id_fk`) VALUES (?,?,?,?,?,?,?,?)";
    $insert_stmt = $connection->prepare($sqlInsert);
    $insert_stmt->bind_param("isssiiii", $roomID_f, $arrivalDate_f, $departureDate_f, $bookingState_f, $breakfast_f, $parking_f, $dog_f, $userID_f);
    if($insert_stmt->execute()) {
        $insert_stmt->close();
        $connection->close();
        return true;
    }else{
        $insert_stmt->close();
        $connection->close();
        return false;
    }
}

/**
 * @param $input_username_f
 * @return mixed --> Returns the UserID of the given user
 */
function getUserID($input_username_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT id FROM Users WHERE username=?";
    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("s", $input_username_f);

    $select_stmt->execute();
    $select_stmt->bind_result($id);
    $select_stmt->fetch();

    $select_stmt->close();
    $connection->close();

    return $id;
}


