<?php

require_once("./dbaccess.php");

$connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

//Annahme, Werte kommen vom Formular über $_GET oder $_POST
$loginUsername = "john123";
$loginPassword = "johnyy";

$select = "SELECT * FROM users WHERE username=?";

// die "s" müssem mit den ? zusammenpassen
$prepStmt = $connection->prepare($select);
$prepStmt->bind_param("s", $uname);

$uname = $loginUsername;

$prepStmt->execute();

$prepStmt->bind_result($id, $username, $useremail, $password);

echo "<ol>";
while($prepStmt->fetch()){
    echo "<ul>";
    echo "<li>" . $id . "</li>";
    echo "<li>" . $username . "</li>";
    echo "<li>" . $useremail . "</li>";
    echo "<li>" . $password . "</li>";
    echo "</ul>";
}
echo "</ol>";

if(password_verify($loginPassword, $password)){
    echo "Correct";
}else{
    echo "False";
}

?>