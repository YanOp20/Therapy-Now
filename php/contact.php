<?php
session_start();
    include_once "config.php";
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['textarea']);

    
    if (!empty($name) && !empty($message) && !empty($email)) {
        
        $insert_query = mysqli_query($conn, "INSERT INTO contactUs (name, email, message) VALUES ({$name}, '{$email}', '{$message}')");
        if ($insert_query) {
            echo "success";
        } else {
            echo "Something went wrong. Please try again!";
        }
    }else{

        echo "All input fields are required!";
    }

    CREATE TABLE ContactUs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        submission_date DATE DEFAULT (CURRENT_DATE),
        submission_time TIME DEFAULT (CURRENT_TIME)
    );
?>
