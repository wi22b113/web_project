<?php
    include "./logic/objects.php";
    session_start();
    include "./logic/common_functions.php";   

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
                // Lesen Sie die Daten aus der Datei und zeigen Sie die Artikel an
                $file = './json/posts.json';
                $fileContent = file_get_contents($file);


                if (!empty($fileContent)) {
                    $articles = json_decode($fileContent, true);
                    $articles = array_reverse($articles);
                    foreach ($articles as $article) {
                        echo '<div class="row justify-content-center">';
                        echo '<div class="col-md-6 mb-3 justify-content-center">';
                        echo '<div class="card">';
                        echo '<img src="' . $article['image'] . '" class="card-img-top" alt="...">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $article['title'] . '</h5>';
                        echo '<p class="card-text">' . $article['content'] . '</p>';
                        echo '<p class="card-text">' . "Autor: " . $article['author'] . '</p>';
                        echo '<p class="card-text">' . "Erstelldatum: " . $article['date'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                /*$file = 'posts.txt';
                    $articles = file_get_contents($file);
                    echo nl2br($articles);
                */  
                /*  
                    if(isset($_SESSION["posts"])){
                        // Printing out the post objects in $_SESSION["posts"]
                        if(count($_SESSION["posts"])>0) {
                            $count = count($_SESSION["posts"]);
                            for($i=$count-1; $i>=0; $i--) {
                                echo $_SESSION["posts"][$i];
                            }
                        }
                    }
                */   
            ?>
        </div> 
    </main>
    <?php include "./elements/footer.php"; ?>

</body>

</html>