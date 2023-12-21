<?php
    session_start();
    include "./logic/common_functions.php";
    include "./logic/register_logic.php";
?> 

<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Registrierung</title>
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
            $currentPage = 'Registrierung';
            include "./elements/header.php";
            ?>
        </header>
        <main>
           
            <h2 class="center mb-3">Registrierung</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div>
                                <label for="gender"></label>
                                <select class="form-select border-primary mb-3" id="gender" name="gender" aria-label="gender">
                                    <option value "" disabled selected>Geschlecht</option>
                                    <option <?php if (isset($gender) && $gender=="female") echo "selected";?> >weiblich</option>
                                    <option <?php if (isset($gender) && $gender=="male") echo "selected";?>>männlich</option>
                                    <option <?php if (isset($gender) && $gender=="other") echo "selected";?>>divers</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control <?php if($fnameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="vorname" name="vorname" placeholder="a" value="<?php echo $fname;?>">
                                <div class="invalid-feedback">
                                    <?php if($fnameErr!=""){echo $fnameErr;} ?> 
                                </div>
                                <label for="vorname">Vorname</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control <?php if($lnameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="nachname" name="nachname" placeholder="a" value="<?php echo $lname;?>">
                                <div class="invalid-feedback">
                                    <?php if($lnameErr!=""){echo $lnameErr;} ?> 
                                </div>
                                <label for="nachname">Nachname</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control <?php if($emailErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="email" name="email" placeholder="a" value="<?php echo $email;?>" required>
                                <div class="invalid-feedback">
                                    <?php if($emailErr!=""){echo $emailErr;} ?> 
                                </div>
                                <label for="email">Email Adresse</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control <?php if($usernameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="username" name="username" placeholder="a" value="<?php echo $username;?>" required>
                                <div class="invalid-feedback">
                                    <?php if($usernameErr!=""){echo $usernameErr;} ?> 
                                </div>
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control <?php if($passwd1Err!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="password1" name="password1" placeholder="a" value="<?php echo $passwd1;?>" required>
                                <div class="invalid-feedback">
                                    <?php if($passwd1Err!=""){echo $passwd1Err;} ?> 
                                </div>
                                <label for="password1">Passwort</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control <?php if($passwd2Err!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="password2" name="password2" placeholder="a" value="<?php echo $passwd2;?>" required>
                                <div class="invalid-feedback">
                                    <?php if($passwd2Err!=""){echo $passwd2Err;} ?> 
                                </div>
                                <label for="password2">Passwort überprüfen</label>
                            </div>
                            <div class="col mb-3">
                                <button class="btn btn-outline-danger" type="reset">Reset</button>
                                <button class="btn btn-outline-primary" type="submit">Registrieren</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <?php include "./elements/footer.php"; ?>
    </body>
</html>