<?php
    include "objects.php";
    session_start();
    include "common_functions.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Posts</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!--Link stylesheet-->
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <?php
        $currentPage = 'Posts';
        include "header.php";
        ?>
        <h1>Posts</h1>
    </header>
    <main>
        <?php
            
            if(isset($_SESSION["posts"])){
                // Printing out the post objects in $_SESSION["posts"]
                if(count($_SESSION["posts"])>0) {
                    $count = count($_SESSION["posts"]);
                    for($i=$count-1; $i>=0; $i--) {
                        echo $_SESSION["posts"][$i];
                    }
                }
            }
            
        ?>
    </main>
</body>

</html>