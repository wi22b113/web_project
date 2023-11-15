<?php
    $uploadDir = "uploads/";
    if(!file_exists($uploadDir)){
        mkdir($uploadDir);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_FILES)){
            var_dump($_FILES);
            $uploadedFileName = $uploadDir . htmlspecialchars(basename(($_FILES["file"]["name"])));
            move_uploaded_file($_FILES["file"]["tmp_name"],$uploadedFileName); 
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>File Upload</h3>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" id="file" name="file" />
        <input type="submit" value="Hochladen" />
    </form>

    <ul>
        <?php
            $files = scandir($uploadDir);
            for($i=0; isset($files[$i]); $i++){
                echo "<li>" . $files[$i] . "</li>";
            }
        ?>
    </ul>


</body>
</html>