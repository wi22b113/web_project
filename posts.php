<?php
    include "objects.php";
    session_start();
    include "common_functions.php";

    $posts = [];
    //$post["text1"] = "hallo ich bin Text 1";
    //$post["bild1"] = "./img/Hotel-1.jpeg";
    //$post["text2"] = "hallo ich bin Text 2";
    //$post["bild2"] = "./img/Hotel-2.jpeg";


    // define variables and set to empty values
    $text = $title = $picture = "";
    
    $target_dir = "./uploads";
    $uploadOk = 1;

    if(!file_exists($targetDir)){
        mkdir($targetDir);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $text = sanitize_input($_POST["text"]);
        if (empty($text)) {
            $_SESSION["textErr"] = "Bitte geben Sie einen Text ein";
        }

        $title = sanitize_input($_POST["title"]);
        if (empty($title)) {
            $_SESSION["titleErr"]= "Bitte geben Sie einen Titel ein";
        }

        $datum = date("d.m.Y - H:i", sanitize_input($_POST["date"]));
        $author = sanitize_input($_POST["author"]);




        //$target_file = $target_dir . basename($_FILES["file"]["name"]);
        //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        if(isset($_FILES)){
            var_dump($_FILES);
            //$uploadedFileName = $target_dir . htmlspecialchars(basename(($_FILES["file"]["name"])));
        }

                /*

        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION["formatErr"] = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }

        */

        if($titleErr=="" && $textErr=="" && $formatErr==""){
            //$post = new post();
            //$post->set_title($title);
            //$post->set_text($text);
            //$post->set_picture($target_file);
            //$post->set_author($author);
            //$post->set_date($date);
        }

        if($titleErr=="" && $textErr=="" && $formatErr==""){
            //$post[] = $post;
        }

    }

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
        
    </main>

</body>

</html>