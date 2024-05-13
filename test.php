<?php
include_once "php/config.php";
function fetchData($conn, $table, $condition = "") {
    $data = array();
    $sql = "SELECT * FROM $table $condition";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

$users = fetchData($conn, "users");
$therapists = fetchData($conn, "therapist");
$onlineUsers = fetchData($conn, "users", "WHERE status = 'Active now'");
$onlineTherapists = fetchData($conn, "therapist", "WHERE status = 'Active now'");
$schedules = fetchData($conn, "appointment"); // Assuming 'appointment' table for schedules

// foreach ($users as $user) {
//     echo "Name: {$user['fname']}\nEmail: {$user['email']}\n"; 
// }
// print_r($schedules);
print_r($onlineTherapists);

function countRows($conn, $table, $condition = "") {
    $sql = "SELECT COUNT(*) AS total_rows FROM $table $condition";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_rows'];
    } else {
        return 0; // Example error return value
    }
}

// echo countRows($conn, 'therapist', "where status = 'Active now'");
// echo countRows($conn, 'users');