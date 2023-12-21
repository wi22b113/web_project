<?php

    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Logout Procedure
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(sanitize_input($_GET["logout"])==true){
            session_unset();
            session_destroy();
            header("Location: login.php"); /* Redirect browser */
            exit;
        }
    }
    
