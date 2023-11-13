<?php
    include "common_functions.php";
    session_start();

    // define variables and set to empty values
    $fnameErr = $lnameErr = $emailErr = $usernameErr = $passwd1Err = $passwd2Err = $oldPasswdErr = "";
    $gender = $fname = $lname = $email = $username = $passwd1 = $passwd2 = $oldPasswd ="";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["oldPasswd"])) {

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

        if($fnameErr=="" and $lnameErr=="" and $emailErr=="" and $usernameErr==""){
            $_SESSION["user"] = $username;
            $_SESSION["gender"] = $gender;
            $_SESSION["firstname"] = $fname;
            $_SESSION["lastname"] = $lname;
            $_SESSION["email"] = $email;
            $_SESSION["userdata_message"] = "Erfolgreich Aktualisiert!";
            header("Location: master_data.php"); /* Redirect browser */
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["password1"]) || isset($_POST["password2"]))) {

        $oldPasswd = sanitize_input($_POST["oldPasswd"]);

        if($oldPasswd === $_SESSION["password"]){
            $passwordcheck = true; 
        }else{
            $passwordcheck = false;
            $oldPasswdErr = "Falsches Passwort!";
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

        if($passwd1Err=="" and $passwd2Err==""){
            $_SESSION["password"] = $passwd1;
            $_SESSION["passwd_message"] = "Erfolgreich Aktualisiert!";
            header("Location: master_data.php"); /* Redirect browser */
        }

    }elseif($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["oldPasswd"])){

        $oldPasswd = sanitize_input($_POST["oldPasswd"]);

        if($oldPasswd === $_SESSION["password"]){
            $passwordcheck = true; 
        }else{
            $passwordcheck = false;
            $oldPasswdErr = "Falsches Passwort!";
        }
    }

?> 

<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Stammdaten</title>
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
            $currentPage = 'Stammdaten';
            include "header.php";
            ?>
        </header>
        <main>
           
            <h2 class="center mb-3">Stammdaten</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div>
                                <label for="gender"></label>
                                <select class="form-select border-primary mb-3" id="gender" name="gender" aria-label="gender">
                                    <option value "" disabled <?php if (!isset($_SESSION["gender"])) echo "selected"?>>Geschlecht</option>
                                    <option <?php if (isset($_SESSION["gender"]) && $_SESSION["gender"]=="weiblich") echo "selected";?> >weiblich</option>
                                    <option <?php if (isset($_SESSION["gender"]) && $_SESSION["gender"]=="männlich") echo "selected";?>>männlich</option>
                                    <option <?php if (isset($_SESSION["gender"]) && $_SESSION["gender"]=="divers") echo "selected";?>>divers</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control <?php if($fnameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="vorname" name="vorname" placeholder="a" value="<?php echo $_SESSION["firstname"];?>">
                                <div class="invalid-feedback">
                                    <?php if($fnameErr!=""){echo $fnameErr;} ?> 
                                </div>
                                <label for="vorname">Vorname</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control <?php if($lnameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="nachname" name="nachname" placeholder="a" value="<?php echo $_SESSION["lastname"];?>">
                                <div class="invalid-feedback">
                                    <?php if($lnameErr!=""){echo $lnameErr;} ?> 
                                </div>
                                <label for="nachname">Nachname</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control <?php if($emailErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="email" name="email" placeholder="a" value="<?php echo $_SESSION["email"];?>" required>
                                <div class="invalid-feedback">
                                    <?php if($emailErr!=""){echo $emailErr;} ?> 
                                </div>
                                <label for="email">Email Adresse</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control <?php if($usernameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="username" name="username" placeholder="a" value="<?php echo $_SESSION["user"];?>" required>
                                <div class="invalid-feedback">
                                    <?php if($usernameErr!=""){echo $usernameErr;} ?> 
                                </div>
                                <label for="username">Username</label>
                            </div>
                            <div class="col mb-3">
                                <button class="btn btn-outline-primary" type="submit">Aktualisieren</button>
                                <br><br>
                                <?php
                                    echo $_SESSION["userdata_message"];
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <h2 class="center mb-3">Passwort</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <p>Um das Passwort zu ändern müssen sie zuerst das alte Passwort eingeben: <br></p>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control <?php if($oldPasswdErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="oldPasswd" name="oldPasswd" placeholder="a" value="<?php echo $oldPasswd;?>">
                                <div class="invalid-feedback">
                                    <?php if($oldPasswdErr!=""){echo $oldPasswdErr;} ?> 
                                </div>
                                <label for="oldPasswd">Altes Passwort</label>
                            </div>
                            <div class="col mb-3">
                                <button class="btn btn-outline-primary" type="submit">Prüfen</button>
                                <br><br>
                            </div>

                            <?php if ($passwordcheck): ?> 
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control <?php if($passwd1Err!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="password1" name="password1" placeholder="a" value="<?php echo $_SESSION["password"];?>" required>
                                    <div class="invalid-feedback">
                                        <?php if($passwd1Err!=""){echo $passwd1Err;} ?> 
                                    </div>
                                    <label for="password1">Neues Passwort</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control <?php if($passwd2Err!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="password2" name="password2" placeholder="a" value="<?php echo $_SESSION["password"];?>" required>
                                    <div class="invalid-feedback">
                                        <?php if($passwd2Err!=""){echo $passwd2Err;} ?> 
                                    </div>
                                    <label for="password2">Neues Passwort überprüfen</label>
                                </div>
                                <div class="col mb-3">
                                <button class="btn btn-outline-primary" type="submit">Aktualisieren</button>
                                <br><br>
                                </div>
                            <?php endif ?> 

                            <?php
                                echo $_SESSION["passwd_message"];
                            ?>
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