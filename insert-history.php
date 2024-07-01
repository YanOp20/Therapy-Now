<?php

require_once "php/config.php";

if (isset($_POST['submit'])) {
    $therapist_id = mysqli_real_escape_string($conn, $_POST['therapist_id']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $his = mysqli_real_escape_string($conn, $_POST['text']);

    if (!empty($his)) {
        $sql = mysqli_query($conn, "INSERT INTO history (user_id, therapist_id, his)
            VALUES ({$user_id}, {$therapist_id}, '{$his}')") or die(mysqli_error($conn));
    }

    // Construct the URL
    $url = 'profile.php?user_id=' . $user_id . '&link=user_profile';

    // Redirect to the constructed URL
    header('Location: ' . $url);
    exit;
}