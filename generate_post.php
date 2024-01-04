<?php
    include "./logic/objects.php";
    session_start();
    include "./logic/common_functions.php";  
    include "./logic/generate_post_logic.php";
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
    <link href="./css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <?php
        $currentPage = 'Generate-Post';
        include "./elements/header.php";
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
                            <input class="form-control <?php if($pictureErr!=""){echo "is-invalid";}else{echo "border-primary";} ?>" type="file" accept=".png, .jpg, .jpeg" id="file" name="file" />
                                <div class="invalid-feedback">
                                    <?php if($pictureErr!=""){echo $pictureErr;} ?> 
                                </div>
                        </div>

                        <div>
                            <input type="hidden" id="date" name="date" value="<?php echo time();?>">
                        </div>

                        <div>
                                <input type="hidden" id="author" name="author" value="<?php echo getUserID($_SESSION["user"]);?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Post erstellen</button>
                    </form>
                    <div class="mt-3 center">
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if($titleErr=="" && $textErr=="" && $pictureErr==""){
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    <?php include "./elements/footer.php"; ?>

</body>

</html>