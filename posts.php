<?php
    include "./logic/objects.php";
    session_start();
    include "./logic/common_functions.php";   
    include "./logic/sql_logic.php";
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
    <link href="./css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <?php
        $currentPage = 'Posts';
        include "./elements/header.php";
        ?>
        <h1>Posts</h1>
    </header>
    <main>
        <div class="container-fluid">
            <?php

                //displayAllPosts(getAllPosts());
                // Lesen Sie die Daten aus der Datei und zeigen Sie die Artikel an
                $articles = getAllPosts();
                $articles = array_reverse($articles); // Dreht das Array um, damit die neuesten Artikel zuerst angezeigt werden
                if (!empty($articles)) { // Überprüft, ob das Array $articles nicht leer ist
                    foreach ($articles as $article) { // Durchläuft jedes Element in $articles
                        echo '<div class="row justify-content-center">';
                        echo '<div class="col-md-6 mb-3 justify-content-center">';
                        echo '<div class="card">';
                        echo '<img src="' . $article['picture'] . '" class="card-img-top" alt=" ... ">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $article['title'] . '</h5>';
                        echo '<p class="card-text">' . $article['content'] . '</p>';
                        echo '<p class="card-text">' . "Autor: " . getOneUser($article['user_id'])["username"] . " " . "Erstelldatum: " . $article['date'] . '</p>';
                        //echo '<p class="card-text">'  '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="row justify-content-center">';
                    echo '<div class="col-md-6 mb-3 justify-content-center">';
                    echo '<h3 class="center"> Keine Posts vorhanden! </h3>';
                    echo '</div>';
                    echo '</div>';
                    
                }
            ?>
        </div> 
    </main>
    <?php include "./elements/footer.php"; ?>

</body>

</html>