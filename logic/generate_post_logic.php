<?php
    // define variables and set to empty values
    $textErr = $titleErr = $pictureErr = "";
    $text = $title = $file_name = "";

    $targetDir = "./img/uploads/";
    $resizedDir = "./img/resized/";

    if(!file_exists($targetDir)){
        mkdir($targetDir);
    }
    if(!file_exists($resizedDir)){
        mkdir($resizedDir);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["admin"]===1) {

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
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


            // Check if image file is a actual image or fake image
            if(getimagesize(sanitize_input($_FILES["file"]["tmp_name"]))==false){
                $pictureErr = "File is not an image.";
            }

            // Check if file already exists, if it exists, add a Unix-Timestamp to the filename to prevent overwriting
            if (file_exists($target_file)) {
                $target_file = $targetDir . pathinfo($target_file,PATHINFO_FILENAME) . "_" . time() . "." . $imageFileType;
            }

            $resized_file = $resizedDir . basename($target_file);

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

                    // Laden des Originalbilds 
                    if($imageFileType == "jpg" || $imageFileType == "jpeg"){
                        $source_image = imagecreatefromjpeg($target_file);
                    }else{
                        $source_image = imagecreatefrompng($target_file);
                    }
                    
                    $source_width = imagesx($source_image);
                    $source_height = imagesy($source_image);
                    $thumbnail_width = 426;
                    $thumbnail_height = 240;
                    // Erstellen des Thumbnails
                    $thumbnail = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

                    // Skalieren des Originalbilds auf die Größe des Thumbnails
                    imagecopyresized($thumbnail, $source_image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $source_width, $source_height);
                    
                    // Speichern des Thumbnails
                    if($imageFileType == "jpg" || $imageFileType == "jpeg"){
                        imagejpeg($thumbnail, $resized_file);
                    }else{
                        imagepng($thumbnail, $resized_file);
                    }
                    
                    //Freigeben des Speichers
                    imagedestroy($source_image);
                    imagedestroy($thumbnail);
                } else {
                    $pictureErr = "Sorry, there was an error uploading your file.";
                }
            }
                    
        }

        //Wenn keine Fehler erkannt wurden wird ein Json File erzeugt und darin die Daten eines Posts gespeichert und serverseitig abgelegt
        if($titleErr=="" && $textErr=="" && $pictureErr==""){
            $file = './json/posts.json';
            $current = file_get_contents($file);
            $current = json_decode($current, true);
            $current[] = ['title' => $title, 'content' => $text, 'image' => $resized_file, 'date' => $datumString, 'author' => $author];
            file_put_contents($file, json_encode($current));
        }
    }
?>