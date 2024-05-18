<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    require_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $b = mysqli_real_escape_string($conn, $_POST['b']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $_SESSION['b'] = $_POST['b'];
    $audioFileName = '';


    if (!empty($message)) {
        // Insert the message into the database
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, audio, b)
            VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$audioFileName}', '{$b}')") or die();
    }
} else {
    header("location: ../login.php");
}
