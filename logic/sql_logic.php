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
 * This function inserts a user into the database
 * @param $title_f
 * @param $content_f
 * @param $picture_f
 * @param $picture_alt_f
 * @param $date_f
 * @param $user_f
 * @return bool
 */
function insertPostDB($title_f, $content_f, $picture_f, $picture_alt_f, $date_f, $user_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlInsert = "INSERT INTO Posts (`title`, `content`, `picture`, `picture_alt`, `date`,`user_id_fk`) VALUES (?,?,?,?,?,?)";
    $insert_stmt = $connection->prepare($sqlInsert);
    $insert_stmt->bind_param("sssssi", $title_f, $content_f, $picture_f, $picture_alt_f, $date_f, $user_f);

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
 * @return array --> Returns all Data from the Post Table
 */
function getAllPosts(){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT * FROM Posts";
    $select_stmt = $connection->prepare($sqlSelect);

    $select_stmt->execute();
    $select_stmt->bind_result($id, $title, $content, $picture, $picture_alt, $date, $user_id_fk);

    $posts = array();

    while ($select_stmt->fetch()) {
        $post = array(
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'picture' => $picture,
            'picture_alt' => $picture_alt,
            'date' => $date,
            'user_id' => $user_id_fk,
            );
        $posts[] = $post;
    }

    $select_stmt->close();
    $connection->close();

    return $posts;

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
    $select_stmt->bind_result($id, $sex, $firstname, $lastname, $email, $username, $password, $admin, $active);
    $select_stmt->fetch();

    $select_stmt->close();
    $connection->close();

    if(password_verify($input_passwd_f, $password) && $active==1){
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

function updateUserDataAdminDB($gender_f, $fname_f, $lname_f, $email_f, $username_f, $id_f, $admin_f, $active_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlUpdate = "UPDATE Users SET `sex` = ?, `firstname` = ?, `lastname` = ?, `email` = ?, `username` = ?, `admin` = ?, `active` = ? WHERE `Users`.`id` = ?";
    $update_stmt = $connection->prepare($sqlUpdate);
    $update_stmt->bind_param("sssssiii", $gender_f, $fname_f, $lname_f, $email_f, $username_f, $admin_f, $active_f, $id_f);

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
function insertBookingDB($roomID_f, $arrivalDate_f, $departureDate_f, $bookingState_f, $userID_f, $datetime_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlInsert = "INSERT INTO Bookings (`room_id_fk`, `arrival_date` , `departure_date`, `booking_state`, `user_id_fk`, `booking_datetime`) VALUES (?,?,?,?,?,?)";
    $insert_stmt = $connection->prepare($sqlInsert);
    $insert_stmt->bind_param("isssis", $roomID_f, $arrivalDate_f, $departureDate_f, $bookingState_f, $userID_f, $datetime_f);
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

/**
 * @param $arrivalDate_f
 * @param $departureDate_f
 * @param $userID_f
 * @return mixed --> Returns the BookingsID of the given booking
 */
function getBookingID($arrivalDate_f, $departureDate_f, $userID_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT id FROM Bookings WHERE arrival_date=? AND departure_date=? AND user_id_fk=?";
    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("ssi", $arrivalDate_f, $departureDate_f, $userID_f);

    $select_stmt->execute();
    $select_stmt->bind_result($id);
    $select_stmt->fetch();

    $select_stmt->close();
    $connection->close();

    return $id;
}

/**
 * @param $bookingsID_f
 * @param $optionsID_f
 * @return bool --> Inserts into the Auxiliary Table for the m:n Relation between Bookings and Options
 */
function insertBookingsOptionsDB($bookingsID_f, $optionsID_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlInsert = "INSERT INTO AT_Bookings_Options (`bookings_id_fk`, `options_id_fk`) VALUES (?,?)";
    $insert_stmt = $connection->prepare($sqlInsert);
    $insert_stmt->bind_param("ii", $bookingsID_f, $optionsID_f);
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
 * @return array --> Diese Funktion gibt die Buchungen für einen spezifischen Usernamen aus
 */
function getUserBookings($input_username_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "
    SELECT 
        B.id AS booking_id,
        B.arrival_date,
        B.departure_date,
        DATEDIFF(B.departure_date, B.arrival_date) AS duration_days,
        R.designation,
        GROUP_CONCAT(O.designation SEPARATOR ',<br>') AS booked_options,
        ((R.price + IFNULL(SUM(O.price), 0)) * DATEDIFF(B.departure_date, B.arrival_date)) AS total_price_duration,
        B.booking_state,
        B.booking_datetime
    FROM 
        Bookings B
    INNER JOIN 
        Rooms R ON B.room_id_fk = R.id
    LEFT JOIN 
        AT_Bookings_Options AO ON B.id = AO.bookings_id_fk
    LEFT JOIN 
        Options O ON AO.options_id_fk = O.id
    INNER JOIN 
        Users U ON B.user_id_fk = U.id
    WHERE 
        U.username = ?
    GROUP BY 
        B.id, R.price, B.arrival_date, B.departure_date
    ";
    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("s", $input_username_f);

    $select_stmt->execute();
    $select_stmt->bind_result($booking_id,$arrival_date, $departure_date, $duration_days, $room, $options, $total_price, $booking_state, $booking_datetime);

    $bookings = array();

    while ($select_stmt->fetch()) {
        $booking = array(
            'booking_id' => $booking_id,
            'arrival_date' => $arrival_date,
            'departure_date' => $departure_date,
            'duration_days' => $duration_days,
            'room' => $room,
            'options' => $options,
            'total_price' => $total_price,
            'booking_state' => $booking_state,
            'booking_datetime' => $booking_datetime
        );
        $bookings[] = $booking;
    }

    $select_stmt->close();
    $connection->close();

    return $bookings;

}

/**
 * @return array --> Diese Funktion gibt Alle Buchungen aus
 */
function getAllBookings(){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "
    SELECT 
        U.id AS user_id,
        U.username AS username,
        B.id AS booking_id,
        B.arrival_date,
        B.departure_date,
        DATEDIFF(B.departure_date, B.arrival_date) AS duration_days,
        R.designation,
        GROUP_CONCAT(O.designation SEPARATOR ',<br>') AS booked_options,
        ((R.price + IFNULL(SUM(O.price), 0)) * DATEDIFF(B.departure_date, B.arrival_date)) AS total_price_duration,
        B.booking_state,
        B.booking_datetime
    FROM 
        Bookings B
    INNER JOIN 
        Rooms R ON B.room_id_fk = R.id
    LEFT JOIN 
        AT_Bookings_Options AO ON B.id = AO.bookings_id_fk
    LEFT JOIN 
        Options O ON AO.options_id_fk = O.id
    INNER JOIN 
        Users U ON B.user_id_fk = U.id
    GROUP BY 
        U.id, U.username, B.id, R.price, B.arrival_date, B.departure_date
    ";
    $select_stmt = $connection->prepare($sqlSelect);

    $select_stmt->execute();
    $select_stmt->bind_result($user_id, $username, $booking_id,$arrival_date, $departure_date, $duration_days, $room, $options, $total_price, $booking_state, $booking_datetime);

    $bookings = array();

    while ($select_stmt->fetch()) {
        $booking = array(
            'user_id' => $user_id,
            'username' => $username,
            'booking_id' => $booking_id,
            'arrival_date' => $arrival_date,
            'departure_date' => $departure_date,
            'duration_days' => $duration_days,
            'room' => $room,
            'options' => $options,
            'total_price' => $total_price,
            'booking_state' => $booking_state,
            'booking_datetime' => $booking_datetime
        );
        $bookings[] = $booking;
    }

    $select_stmt->close();
    $connection->close();

    return $bookings;

}

/**
 * @param $filter_f
 * @return array --> Diese Funktion gibt Alle Buchungen mit einem gewissen Buchungsstatus aus
 */
function getFilteredBookings($filter_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "
    SELECT 
        U.id AS user_id,
        U.username AS username,
        B.id AS booking_id,
        B.arrival_date,
        B.departure_date,
        DATEDIFF(B.departure_date, B.arrival_date) AS duration_days,
        R.designation,
        GROUP_CONCAT(O.designation SEPARATOR ',<br>') AS booked_options,
        ((R.price + IFNULL(SUM(O.price), 0)) * DATEDIFF(B.departure_date, B.arrival_date)) AS total_price_duration,
        B.booking_state,
        B.booking_datetime
    FROM 
        Bookings B
    INNER JOIN 
        Rooms R ON B.room_id_fk = R.id
    LEFT JOIN 
        AT_Bookings_Options AO ON B.id = AO.bookings_id_fk
    LEFT JOIN 
        Options O ON AO.options_id_fk = O.id
    INNER JOIN 
        Users U ON B.user_id_fk = U.id
    WHERE B.booking_state = '$filter_f'
    GROUP BY 
        U.id, U.username, B.id, R.price, B.arrival_date, B.departure_date
    ";
    $select_stmt = $connection->prepare($sqlSelect);

    $select_stmt->execute();
    $select_stmt->bind_result($user_id, $username, $booking_id,$arrival_date, $departure_date, $duration_days, $room, $options, $total_price, $booking_state, $booking_datetime);

    $bookings = array();

    while ($select_stmt->fetch()) {
        $booking = array(
            'user_id' => $user_id,
            'username' => $username,
            'booking_id' => $booking_id,
            'arrival_date' => $arrival_date,
            'departure_date' => $departure_date,
            'duration_days' => $duration_days,
            'room' => $room,
            'options' => $options,
            'total_price' => $total_price,
            'booking_state' => $booking_state,
            'booking_datetime' => $booking_datetime
        );
        $bookings[] = $booking;
    }

    $select_stmt->close();
    $connection->close();

    return $bookings;

}

/**
 * @return array --> Returns all Data from the Users Table
 */
function getAllUsers(){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT * FROM Users";
    $select_stmt = $connection->prepare($sqlSelect);

    $select_stmt->execute();
    $select_stmt->bind_result($user_id,$sex, $fname, $lname, $email, $username, $passwd, $admin, $active);

    $users = array();

    while ($select_stmt->fetch()) {
        $user = array(
            'user_id' => $user_id,
            'sex' => $sex,
            'firstname' => $fname,
            'lastname' => $lname,
            'email' => $email,
            'username' => $username,
            'password' => $passwd,
            'admin' => $admin,
            'active' => $active,
            );
        $users[] = $user;
    }

    $select_stmt->close();
    $connection->close();

    return $users;

}

/**
 * @return array --> Returns an Array of Booking IDs
 */
function getBookingIDs(){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT id FROM Bookings ORDER BY id";
    $select_stmt = $connection->prepare($sqlSelect);

    $select_stmt->execute();
    $select_stmt->bind_result($booking_id);

    $ids = array();

    while ($select_stmt->fetch()) {
        $ids[] = $booking_id;
    }

    $select_stmt->close();
    $connection->close();

    return $ids;

}

/**
 * @param $bookingID_f
 * @param $bookingState_f
 * @return bool --> Updates the Booking State
 */
function updateBookingStateDB($bookingID_f, $bookingState_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlUpdateState = "UPDATE Bookings SET `booking_state` = ? WHERE `id` = ?";
    $update_stmt = $connection->prepare($sqlUpdateState);
    $update_stmt->bind_param("si", $bookingState_f, $bookingID_f);

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
 * @return array --> Returns an Array of User IDs
 */
function getUserIDs(){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT id FROM Users ORDER BY id";
    $select_stmt = $connection->prepare($sqlSelect);

    $select_stmt->execute();
    $select_stmt->bind_result($user_id);

    $ids = array();

    while ($select_stmt->fetch()) {
        $ids[] = $user_id;
    }

    $select_stmt->close();
    $connection->close();

    return $ids;

}

function getOneUser($user_id_f){
    global $dbHost,$dbUsername, $dbPassword, $dbName;
    require_once("./db/dbaccess.php");
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $sqlSelect = "SELECT * FROM Users WHERE id = ?";
    $select_stmt = $connection->prepare($sqlSelect);
    $select_stmt->bind_param("i", $user_id_f);

    $select_stmt->execute();
    $select_stmt->bind_result($user_id,$sex, $fname, $lname, $email, $username, $passwd, $admin, $active);
    $select_stmt->fetch();

    $user = array(
        'user_id' => $user_id,
        'sex' => $sex,
        'firstname' => $fname,
        'lastname' => $lname,
        'email' => $email,
        'username' => $username,
        'password' => $passwd,
        'admin' => $admin,
        'active' => $active,
    );

    $select_stmt->close();
    $connection->close();

    return $user;

}



