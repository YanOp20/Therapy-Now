<?php
session_start();
    require_once "config.php";
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['textarea']);

    
    if (!empty($name) && !empty($message) && !empty($email)) {
        
        $insert_query = mysqli_query($conn, "INSERT INTO contactus (email, name, message) VALUES ('{$email}', '{$name}', '{$message}')");
        if ($insert_query) {
            echo "success";
        } else {
            echo "Something went wrong. Please try again!";
        }
    }else{
        echo "All input fields are required!";
    }

?>
