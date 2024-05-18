<?php
session_start();
require_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$birthDate = mysqli_real_escape_string($conn, $_POST['birthDate']);
$specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

if (!empty(trim($fname)) && !empty(trim($lname)) && !empty($gender) && !empty($birthDate) && !empty($phone) && !empty($specialization) && !empty(trim($email)) && !empty(trim($password))) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT * FROM therapist WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exist!";
        } else {
            if (isset($_FILES['image'])) {
                ;
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if (in_array($img_ext, $extensions) === true) {
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        $time = time();
                        $new_img_name = $time . $img_name;
                        if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                            $ran_id = rand(time(), 100000000);
                            $status = "Active now";
                            // $encrypt_pass = md5($password); 
                            $insert_query = mysqli_query($conn, "INSERT INTO therapist (unique_id, fname, lname, gender, birthDate, specialization, email, phone, password, img, status) 
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$gender}', '{$birthDate}', '{$specialization}', '{$email}', '{$phone}', '{$password}', '{$new_img_name}', '{$status}')");
                            
                            if ($insert_query) {
                                $select_sql2 = mysqli_query($conn, "SELECT * FROM therapist WHERE email = '{$email}'");
                                if (mysqli_num_rows($select_sql2) > 0) {
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id'] = $result['unique_id'];
                                    echo "success";
                                } else {
                                    echo "This email address not Exist!";
                                }
                            } else {
                                echo "Something went wrong. Please try again!";
                            }
                        }
                    } else {
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }
        }
    } else {
        echo "$email is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
