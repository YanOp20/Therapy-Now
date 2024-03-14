<?php
include_once "config.php";

$title = mysqli_real_escape_string($conn, $_POST['title']);
$text = mysqli_real_escape_string($conn, $_POST['text']);
$poster_id = mysqli_real_escape_string($conn, $_POST['_id']);

if (!empty(trim($title)) && !empty(trim($text)) && !empty(trim($poster_id))) {
    if (isset($_FILES['image'])) {;
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

                    $insert_query = mysqli_query($conn, "INSERT INTO blog (title, text, poster_id, img)
                                VALUES ('{$title}','{$text}','{$poster_id}', '{$new_img_name}')");
                    if ($insert_query) {
                        echo "success";
                    } else {
                        echo "Something went wrong. Please try again!";
                    }
                }
            } else {
                echo "Please upload an image file - jpeg, png, jpg";
            }
        } else {
            $insert_query = mysqli_query($conn, "INSERT INTO blog (title, text, poster_id)
                                VALUES ('{$title}','{$text}','{$poster_id}')");
            if ($insert_query) {
                echo "success";
            } 
            // echo "Please upload an image file - jpeg, png, jpg";
        }
    }else{
        $insert_query = mysqli_query($conn, "INSERT INTO blog (title, text, poster_id)
                    VALUES ('{$title}','{$text}','{$poster_id}')");
        if ($insert_query) {
            echo "success";
        } 
    }
} else {
    echo "All input fields are required!";
}
