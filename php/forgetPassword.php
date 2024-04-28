<?php
// session_start();
// include_once "config.php";
// $email = mysqli_real_escape_string($conn, $_POST['email']);
// // $password = mysqli_real_escape_string($conn, $_POST['password']);
// // $c_password = mysqli_real_escape_string($conn, $_POST['c-password']);

// if (!empty($email)) {
//     // $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

//     # -------------this was for adding doctors-----------------------
//     $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
//     if (mysqli_num_rows($sql) == 0) {
//         $sql = mysqli_query($conn, "SELECT * FROM therapist WHERE email = '{$email}'");
//     }



//     if (mysqli_num_rows($sql) > 0) {
//         $row = mysqli_fetch_assoc($sql);


//         echo "{}";




//         // $user_pass = md5($password);
//         $enc_pass = $row['password'];
//         if ($password === $enc_pass) {
//             $status = "Active now";
//             //    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");



//             $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

//             $sql2 = mysqli_query($conn, "UPDATE therapist SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

//             if ($sql2) {
//                 $_SESSION['unique_id'] = $row['unique_id'];
//                 echo "success";
//             } else {
//                 echo "Something went wrong. Please try again!" . $row['unique_id'];
//             }
//         } else {
//             echo "Email or Password is Incorrect!";
//         }
//     } else {
//         echo "$email - This email not Exist!";
//     }
// } else {
//     echo "Please Enter your email address!";
// }

?>

<?php
session_start();
require_once "config.php";
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($email)) {

        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) == 0) {
            $sql = mysqli_query($conn, "SELECT * FROM therapist WHERE email = '{$email}'");
        }

        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);

            header('Content-Type: application/json');
            echo json_encode([
                'message' => 'email',
                'first_name' => $row['fname'],
                'last_name' => $row['lname'],
                'email' => $row['email'],
                'img' => $row['img']
            ]);
        } else {
            echo json_encode([
                'message' => "$email - This email does not exist!"
            ]);        }
    } else {
        echo json_encode([
            'message' => 'Please enter your email address!'
        ]);
    }
}
// <--------getting password and change -------------------->

if (isset($_POST['password']) && isset($_POST['c-password'])) {

    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c-password']);

    if (!empty($c_password) && !empty($c_password)) {

        // $user_pass = md5($password);
        if ($password === $c_password) {

            $status = "Active now";

            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}', set password = '{$password}' WHERE unique_id = {$row['unique_id']}");

            $sql2 = mysqli_query($conn, "UPDATE therapist SET status = '{$status}', set password = '{$password}' WHERE unique_id = {$row['unique_id']}");

            if ($sql2) {
                $_SESSION['unique_id'] = $row['unique_id'];
                echo json_encode([
                    'message' => 'success'
                ]);
            } else {
                echo json_encode([
                    'message' => "Something went wrong. Please try again! Unique ID: " . $row['unique_id']
                ]);
            }
        } else {
            echo json_encode([
                'message' => 'Passwords do not match.'
            ]);
        }
    } else {
        echo json_encode([
            'message' => 'you must fill all the fields'
        ]);
    }
}


?>
