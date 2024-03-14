<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $b = mysqli_real_escape_string($conn, $_POST['b']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $audioFileName = '';
    
    $_SESSION['b'] = $_POST['b'];

    if (!empty($_FILES)) {
        // An audio file was uploaded
        $audioFile = $_FILES['audio'];
        $uploadDir = 'uploads/';
        $newFileName = time() . '_' . basename($audioFile['name']);
        $uploadFile = $uploadDir . $newFileName;
        if (move_uploaded_file($audioFile['tmp_name'], $uploadFile)) {
            error_log("Audio file was successfully uploaded: $uploadFile");
            $audioFileName = $newFileName;
        } else {
            error_log("Error uploading audio file: " . print_r($audioFile, true));
        }
    }

    if (!empty($message) || !empty($audioFileName)) {
        // Insert the message into the database
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, audio, b)
VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$audioFileName}', '{$b}')") or die();
    }
} else {
    header("location: ../login.php");
}




?>
