<?php
    include "./logic/objects.php";
    session_start();
    include "./logic/common_functions.php";
    include "./logic/manage_users_logic.php";

?> 

<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Users</title>
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
            $currentPage = 'Users';
            include "./elements/header.php";
            ?>
        </header>
        <main>
            <?php if ($_SESSION['admin']==1): ?>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <?php
                        displayAllUsers(getAllUsers());
                        ?>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <h2 class='center mt-3 mb-3'>Userdaten ändern</h2>
                    <div class="col-md-6">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <div>
                                <label for="change_users_id"></label>
                                <select class="mt-2 form-select border-primary" id="change_users_id" name="change_users_id" aria-label="change_users_id">
                                    <option value "" disabled selected>User-ID</option>
                                    <?php
                                    $userIDArray = getUserIDs();
                                    foreach ($userIDArray as $userID){
                                        echo "<option>" . $userID . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-outline-primary mt-3" type="submit">User bearbeiten</button>
                        </form>
                    </div>
                </div>
            </div>
                <?php if(isset($_POST["change_users_id"]) || $errorActive==True) : ?>
                    <?php
                        if(isset($_POST["change_users_id"])){
                            $user_id = sanitize_input($_POST["change_users_id"]);
                            $userToChange = getOneUser($user_id);
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div>
                                        <label for="gender"></label>
                                        <select class="form-select border-primary mb-3" id="gender" name="gender" aria-label="gender">
                                            <option value "" disabled <?php if (!isset($userToChange["sex"])) echo "selected"?>>Geschlecht</option>
                                            <option <?php if (isset($userToChange["sex"]) && $userToChange["sex"]=="weiblich") echo "selected";?> >weiblich</option>
                                            <option <?php if (isset($userToChange["sex"]) && $userToChange["sex"]=="männlich") echo "selected";?>>männlich</option>
                                            <option <?php if (isset($userToChange["sex"]) && $userToChange["sex"]=="divers") echo "selected";?>>divers</option>
                                        </select>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control <?php if($fnameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="vorname" name="vorname" placeholder="a" value="<?php echo $userToChange["firstname"];?>">
                                        <div class="invalid-feedback">
                                            <?php if($fnameErr!=""){echo $fnameErr;} ?>
                                        </div>
                                        <label for="vorname">Vorname</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control <?php if($lnameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="nachname" name="nachname" placeholder="a" value="<?php echo $userToChange["lastname"];?>">
                                        <div class="invalid-feedback">
                                            <?php if($lnameErr!=""){echo $lnameErr;} ?>
                                        </div>
                                        <label for="nachname">Nachname</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control <?php if($emailErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="email" name="email" placeholder="a" value="<?php echo $userToChange["email"];?>" required>
                                        <div class="invalid-feedback">
                                            <?php if($emailErr!=""){echo $emailErr;} ?>
                                        </div>
                                        <label for="email">Email Adresse</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control <?php if($usernameErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="username" name="username" placeholder="a" value="<?php echo $userToChange["username"];?>" required>
                                        <div class="invalid-feedback">
                                            <?php if($usernameErr!=""){echo $usernameErr;} ?>
                                        </div>
                                        <label for="username">Username</label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input border-primary" id="admin" name="admin" placeholder="a" <?php if ($userToChange["admin"]=="1"){echo "checked=\"checked\"";} ?>>
                                        <label class="form-check-label" for="admin">Adminrechte</label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input border-primary" id="active" name="active" placeholder="a" <?php if ($userToChange["active"]=="1"){echo "checked=\"checked\"";} ?>>
                                        <label class="form-check-label" for="active">Aktiv</label>
                                    </div>

                                    <div>
                                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $userToChange["user_id"] ?>">
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control <?php if($passwdErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="password" name="password" placeholder="a">
                                        <div class="invalid-feedback">
                                            <?php if($passwdErr!=""){echo $passwdErr;} ?>
                                        </div>
                                        <label for="password">Neues Passwort</label>
                                    </div>

                                    <div class="col mb-3">
                                        <button class="btn btn-outline-primary" type="submit">Userdaten ändern</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endif ?>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6 mt-3">
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                echo $updateUserDataMessage;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </main>
        <?php include "./elements/footer.php"; ?>
    </body>
</html>