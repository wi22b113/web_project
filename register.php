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
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <?php
            $currentPage = 'Registrierung';
            include "header.php";
            include "common_functions.php"
            ?>
        </header>
        <main>
            <?php
                // define variables and set to empty values

                $fnameErr = $lnameErr = $emailErr = $usernameErr = $passwd1Err = $passwd2Err = "";
                $gender = $fname = $lname = $email = $username = $passwd1 = $passwd2 = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $gender = $_POST["gender"];
                    
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
                    } else {
                        $username = sanitize_input($_POST["username"]);
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
                }
            ?>            
            <h2 class="center mb-3">Registrierung</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div>
                                <label for="gender"></label>
                                <select class="form-select border-primary mb-3" id="gender" name="gender" aria-label="gender">
                                    <option value "" disabled selected>Geschlecht</option>
                                    <option <?php if (isset($gender) && $gender=="weiblich") echo "selected";?> >weiblich</option>
                                    <option <?php if (isset($gender) && $gender=="männlich") echo "selected";?>>männlich</option>
                                    <option <?php if (isset($gender) && $gender=="divers") echo "selected";?>>divers</option>
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
                                <h2>
                                    <?php
                                        if ($_SERVER["REQUEST_METHOD"] == "POST" and $fnameErr=="" and $lnameErr=="" and $emailErr=="" and $usernameErr=="" and $passwd1Err=="" and $passwd2Err=="") {
                                            echo "Erfolg!";            
                                        }elseif($_SERVER["REQUEST_METHOD"] == "POST"){echo "kein Erfolg";}
                                    ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
        <footer>
            &copy 2023
        </footer>
    </body>
</html>