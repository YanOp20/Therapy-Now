<?php
include_once "config.php";
function fetchData($conn, $table, $condition = "") {
    $data = array();
    $sql = "SELECT * FROM $table $condition";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

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

function displayUsers($users, $t = "") {
    foreach ($users as $user) {
        echo "<div>";
        echo "<img src='php/images/{$user['img']}' alt='img'>";
        echo "<p>{$user['fname']} {$user['lname']}</p>";
        echo $t === 'therapist' ? "<div>
                                    <form action='#' method='post'>
                                        <input type='text' name='remove' value='{$user['unique_id']}' hidden '>
                                        <button type='submit'>remove</button>
                                    </form>
                                  </div>
                                  " :'';
        echo "</div>";
    }
}

$users = fetchData($conn, "users");
$therapists = fetchData($conn, "therapist");
$onlineUsers = fetchData($conn, "users", "WHERE status = 'Active now'");
$onlineTherapists = fetchData($conn, "therapist", "WHERE status = 'Active now'");
$schedules = fetchData($conn, "appointment"); 
?>
<input type="checkbox" name="" id="">