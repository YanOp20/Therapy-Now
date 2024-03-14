<?php
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
    // $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

    # -------------this was for adding doctors-----------------------
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) == 0) {
        $sql = mysqli_query($conn, "SELECT * FROM therapist WHERE email = '{$email}'");
    }
    # -------------this was for adding doctors-----------------------


    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        // $user_pass = md5($password);
        $enc_pass = $row['password'];
        if ($password === $enc_pass) {
            $status = "Active now";
            //    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");



            # -------------this was for adding doctors-----------------------
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            // if (!$sql2) {
            $sql2 = mysqli_query($conn, "UPDATE therapist SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            // }
            # -------------this was for adding doctors-----------------------

            if ($sql2) {
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success";
            } else {
                echo "Something went wrong. Please try again!" . $row['unique_id'];
            }
        } else {
            echo "Email or Password is Incorrect!";
        }
    } else {
        echo "$email - This email not Exist!";
    }
} else {
    echo "All input fields are required!";
}
