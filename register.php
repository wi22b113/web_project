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
            ?>
        </header>
        <main>
            <h2 class="center mb-3">Registrierung</h2>
            <form action="./register.php" method="POST">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div>
                                <label for="anrede"></label>
                                <select class="form-select border-primary mb-3" id="anrede" aria-label="Anrede">
                                    <option value "" disabled selected>Anrede</option>
                                    <option>Herr</option>
                                    <option>Frau</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-primary" id="vorname" placeholder="a">
                                <label for="vorname">Vorname</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-primary" id="nachname" placeholder="a">
                                <label for="nachname">Nachname</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control border-primary" id="email" placeholder="a" required>
                                <label for="email">Email Adresse</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-primary" id="username" placeholder="a" required>
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-primary" id="password1" placeholder="a" required>
                                <label for="password1">Passwort</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-primary" id="password2" placeholder="a" required>
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
        <footer>
            &copy 2023
        </footer>
    </body>
</html>