<?php
    $value = "A fist cookie to set";
    setcookie("firstCookie", $value);



    $user = [];
    $user["jim"] = "mysupersecretpassword";
    $user["andrea"] = "mypassword";

    $enteredPw= htmlspecialchars($_POST["password"]);
    $enteredUsername= htmlspecialchars($_POST["username"]);
    
    if($user[$enteredUsername] === $enteredPw){
        $_SESSION["user"] = $enteredUsername;
    }

    //$_SESSION["username"] = "Jim";

    //$valueFromCookie = htmlspecialchars($_COOKIE["firstCookie"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<p>
    <?php
        echo $valueFromCookie;
    ?>
</p>

<?php if (!isset($_SESSION["user"])): ?> 
<form action="login2.php" method="POST">
    <input name="username" />
    <input type="password" name="password" />
    <input type="submit" value="Login" />
</form>
<?php else: ?>  
<h3>
    Hello <?php echo $_SESSION["user"]; ?>
    <form action="logout.php" method="POST">
        <input type="submit" value="Logout" />
    </form>
</h3>
<?php endif ?> 

</body>
</html>