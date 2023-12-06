<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Ticket</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <textarea name="comment" rows="4" cols="50"></textarea>
        <input type="file" name="picture" required accept="image/png, image/jpeg, image/gif" />
        <input type="submit" name="submit" value="Upload"/>
    </form>

    <?php
        $userId = 5;

        if(isset($_POST["submit"])){
            $enteredComment = htmlspecialchars($_POST["comment"]);
            $targetDir = "uploads/";
            mkdir($targetDir . $userId);
            //FileName = uploads/$userid/cat_$timestamp.png

            $date = new DateTime();
            $timestamp = $date->getTimestamp();

            $file = $_FILES["picture"];
            //var_dump($file);

            $uploadedFileName = explode(".",htmlspecialchars($file["name"]));
            $uploadedType = end($uploadedFileName);
            $newFilename = $uploadedFileName[0];

            $targetFile = $targetDir . $userId . "/" . $newFilename . "_" . $timestamp . "." . $uploadedType;
            //echo "<h1>$targetFile</h1>";

            function createDBEntry($user_Id, $file_path, $comment){
                require_once("dbaccess.php");
                $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
                $sql = "INSERT INTO tickets (user_id, file_path, comment) VALUES (?,?,?)";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("iss", $user_Id, $file_path, $comment);
                if($stmt->execute()){
                    echo "<h1>Hooray, the picture uplaoded successfully</h1>";
                }else{
                    echo "<h2>Picture faile during DB insert</h2>";
                }

                $stmt->close();
                $connection->close();

            }

            if(move_uploaded_file($file["tmp_name"], $targetFile)){
                createDBEntry($userId, $targetFile, $enteredComment);
            }else{
                echo "<h3>Failed to move uploaded File </h3>";
            }



        }
    ?>

</body>
</html>