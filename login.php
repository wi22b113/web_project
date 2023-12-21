<?php
    session_start();
    include "./logic/common_functions.php";
    include "./logic/login_logic.php"
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="description" content="Hotel Bacher Buchungsplatform">
        <meta name="author" content="Philipp Huber/Matthias Teuschl">
        <meta http-equiv="refresh" content="30">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Import Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
        <!--Link Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <!--Link stylesheet-->
        <link href="./css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <?php
            $currentPage = 'Login';
            include "./elements/header.php";
            ?>
        </header>
        <main>
            <?php if (!isset($_SESSION["user"])): ?> 
                <h2 class="center mb-3">Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control <?php if($usernameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="username" name="username" placeholder="Username" value="<?php echo $input_username;?>" required>
                                    <div class="invalid-feedback">
                                        <?php if($usernameErr!=""){echo $usernameErr;} ?> 
                                    </div>
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control <?php if($passwdErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="password" name="password" placeholder="Password" value="<?php echo $passwd;?>" required>
                                    <div class="invalid-feedback">
                                        <?php if($passwdErr!=""){echo $passwdErr;} ?> 
                                    </div>
                                    <label for="password">Passwort</label>
                                </div>

                                Noch kein Konto? <a href="./register.php">Hier</a> registrieren!

                                <div class="col mb-3 mt-3">
                                    <button class="btn btn-outline-danger" type="reset">Reset</button>
                                    <button class="btn btn-outline-primary" type="submit">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php else: ?>  
                <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col center mt-5">
                                    <h3>
                                        Hello <?php echo $_SESSION["user"]; ?>
                                        <br>
                                        <br>
                                    </h3>
                                    <p>
                                        Möchtest du ein Zimmer buchen?
                                        Oder möchtest du deine bereits getätigten Buchungen ansehen?
                                        Dann klicke <a class="btn btn-primary" href="./manage_bookings.php" role="button">Hier!</a>
                                    </p>
                            </div>
                        </div>
                </div>
            <?php endif ?> 
        </main>
        <?php include "./elements/footer.php"; ?>
    </body>
</html>