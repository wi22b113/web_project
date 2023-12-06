<?php

require_once("./dbaccess.php");

$connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

// Annahme Werte kommen vo mUser zB über $_POST oder $_GET
$username = "john123";
$password = "doe";
$email = "john@example.com";

$hashedPw = password_hash($passwd, PASSWORD_DEFAULT);

// Prepared statement
$sqlInsert = "INSERT INTO users (`username`, `password` , `useremail`) VALUES (?,?,?)";

// die "s" müssem mit den ? zusammenpassen
$stmt = $connection->prepare($sqlInsert);
$stmt->bind_param("sss", $uname, $passwd, $mail);

$uname = $username;
$passwd = $hashedPw;
$mail = $email;

if($stmt->execute()){
    echo "<h1>Success</h1>";
}else{
    echo "<h1>Failed to insert</h1>";
}

$stmt->close();
$connection->close();


?>