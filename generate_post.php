<?php
    include "objects.php";
    session_start();
    include "common_functions.php";  

    
    // define variables and set to empty values
    $textErr = $titleErr = $pictureErr = "";
    $text = $title = $file_name = "";
    
    $targetDir = "./uploads/";
    $resizedDir = "./resized/";

    if(!file_exists($targetDir)){
        mkdir($targetDir);
    }
    if(!file_exists($resizedDir)){
        mkdir($resizedDir);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $text = sanitize_input($_POST["text"]);
        if (empty($text)) {
            $textErr = "Bitte geben Sie einen Text ein";
        }

        $title = sanitize_input($_POST["title"]);
        if (empty($title)) {
            $titleErr= "Bitte geben Sie einen Titel ein";
        }

        $datum = new DateTime();
        $datum->setTimestamp(sanitize_input($_POST["date"]));
        $datumString = $datum->format("d.m.Y H:i");

        $author = sanitize_input($_POST["author"]);
        if(sanitize_input($_FILES["file"]["size"]) == 0){
            $pictureErr = "Bitte laden Sie ein Bild hoch";
        }else{
            $file_name = sanitize_input(basename(($_FILES["file"]["name"])));
            $target_file = $targetDir . sanitize_input(basename(($_FILES["file"]["name"])));
            $resized_file = $resizedDir . sanitize_input(basename(($_FILES["file"]["name"])));
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


            // Check if image file is a actual image or fake image
            if(getimagesize(sanitize_input($_FILES["file"]["tmp_name"]))==false){
                $pictureErr = "File is not an image.";
            }

            // Check if file already exists
            //if (file_exists($target_file)) {
            //    $pictureErr =  "Sorry, file already exists.";
            //}

            // Check file size (if > 50MB)
            if (sanitize_input($_FILES["file"]["size"]) > 50000000) {
                $pictureErr = "Sorry, your file is too large.";
            }

            // Allow only certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $pictureErr = "Sorry, only JPG, JPEG & PNG files are allowed.";
            }

            // Check if upload was Ok and move the file
            if ($pictureErr=="") {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {    

                    
                    // Laden Sie das Originalbild 
                    if($imageFileType == "jpg" || $imageFileType == "jpeg"){
                        $source_image = imagecreatefromjpeg($target_file);
                    }else{
                        $source_image = imagecreatefrompng($target_file);
                    }
                    
                    $source_width = imagesx($source_image);
                    $thumbnail_width = 426;
                    $source_height = imagesy($source_image);
                    $thumbnail_height = 240;
                    // Erstellen Sie das Thumbnail
                    $thumbnail = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

                    // Skalieren Sie das Originalbild auf die Größe des Thumbnails
                    imagecopyresized($thumbnail, $source_image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $source_width, $source_height);
                    
                    
                    // Speichern Sie das Thumbnail
                    if($imageFileType == "jpg" || $imageFileType == "jpeg"){
                        imagejpeg($thumbnail, $resized_file);
                    }else{
                        imagepng($thumbnail, $resized_file);
                    }
                    
                    //Freigeben von Speicher
                    imagedestroy($source_image);
                    imagedestroy($thumbnail);
                } else {
                    $pictureErr = "Sorry, there was an error uploading your file.";
                }
            }
                    
        }
        // Laden Sie das Bild hoch und speichern Sie den Pfad
        //$target_dir = "./uploads/";
        //$target_file = $target_dir . basename($_FILES["file"]["name"]);
        //move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        if($titleErr=="" && $textErr=="" && $pictureErr==""){
            $file = 'posts.json';
            $current = file_get_contents($file);
            $current = json_decode($current, true);
            $current[] = ['title' => $_POST['title'], 'content' => $_POST['text'], 'image' => $resized_file, 'date' => $datumString, 'author' => $_POST['author']];
            file_put_contents($file, json_encode($current));
        }
    }

        /*
        if(isset($_SESSION["posts"]) && $titleErr=="" && $textErr=="" && $pictureErr==""){
            $post = new Post();
            $post->set_title($title);
            $post->set_text($text);
            $post->set_author($author);
            $post->set_date($datum);
            if(sanitize_input($_FILES["file"]["size"]) != 0){
                $post->set_picture($target_file);
            }
            $_SESSION['posts'][] = $post;
            header("Location: posts.php"); //Redirect browser 
        }elseif($titleErr=="" && $textErr=="" && $pictureErr==""){
            $post = new Post();
            $post->set_title($title);
            $post->set_text($text);
            $post->set_author($author);
            $post->set_date($datum);
            if(sanitize_input($_FILES["file"]["size"]) != 0){
                $post->set_picture($target_file);
            }
            $_SESSION['posts'] = array($post);
            header("Location: posts.php"); // Redirect browser 
            
        }*/
    
    
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Generate Post</title>
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
        $currentPage = 'Generate-Post';
        include "header.php";
        ?>
        <h1>Posts erstellen</h1>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="generate_post.php" method="post" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                                <input type="text" class="form-control <?php if($titleErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="title" name="title" placeholder="a" value="<?php echo $title;?>"/>
                                <div class="invalid-feedback">
                                    <?php if($titleErr!=""){echo $titleErr;} ?> 
                                </div>
                                <label for="title">Titel</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <textarea class="form-control <?php if($textErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" id="text" name="text" rows="5" style="height: 100px" placeholder="a"><?php echo $text;?></textarea>
                                <div class="invalid-feedback">
                                    <?php if($textErr!=""){echo $textErr;} ?> 
                                </div>
                            <label for="text">Inhalt</label>        
                        </div>
                        
                        <div class="mb-3">
                            <label for="file" class="form-label">Bild Upload</label>  
                            <input class="form-control <?php if($pictureErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" type="file" id="file" name="file" />
                                <div class="invalid-feedback">
                                    <?php if($pictureErr!=""){echo $pictureErr;} ?> 
                                </div>
                        </div>

                        <div>
                            <input type="hidden" id="date" name="date" value="<?php echo time();?>">
                        </div>

                        <div>
                                <input type="hidden" id="author" name="author" value="<?php echo $_SESSION["user"];?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Post erstellen</button>
                    </form>
                    <div class="mt-3 center">
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if($titleErr=="" && $textErr=="" && $pictureErr==""){
                                    echo "<h3>Danke für deinen Post!</h3>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
    </main>

</body>

</html>