<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $user_id = $_SESSION['unique_id'];
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $symptom = mysqli_real_escape_string($conn, $_POST['symptom']);
    $start_time = mysqli_real_escape_string($conn, $_POST['time']);

    $given_timestamp = strtotime($start_time);
    $new_timestamp = $given_timestamp + (45 * 60); // Add 45 minutes in seconds
    $new_time = date('H:i:s', $new_timestamp);

    $end_time = mysqli_real_escape_string($conn,$new_time);

    $r = mysqli_query($conn, "SELECT * FROM therapist WHERE NOT unique_id = 40000");
    if(mysqli_num_rows($r) > 0) {
        $rows = mysqli_fetch_all($r, MYSQLI_ASSOC);
        $rand = rand(0, count($rows) - 1);
        $therapist_id = $rows[$rand]['unique_id'];
    } else {
        echo "There are no therapists available.";
    }

    
    
    if (!empty($date) && !empty($start_time) && !empty($symptom)) {
        $check_before_appointed = mysqli_query($conn, "SELECT therapist_id FROM appointment WHERE user_id = $user_id");
        if(mysqli_num_rows($check_before_appointed) > 0) {
            $result = mysqli_fetch_assoc($check_before_appointed);
            $therapist_id = $result['therapist_id'];
        }
        
    // get the current date and time in PHP
    $today = date ('Y-m-d');
    $now = date ('H:i:s');
    // check if the date is not in the past
    if ($date >= $today) {
        // check if the time is not in the past
        if ($date > $today || $start_time >= $now) {
            // check if there is no existing appointment for the same therapist, date, and time
            $check_query = mysqli_query($conn, "SELECT EXISTS (SELECT * FROM appointment WHERE therapist_id = '{$therapist_id}' AND date = '{$date}' AND start_time = '{$start_time}')");
            $check_result = mysqli_fetch_row($check_query);
            if ($check_result[0] == 0) {
                // insert the new appointment
                $insert_query = mysqli_query($conn, "INSERT INTO appointment (user_id, therapist_id, date, start_time, end_time, symptom) 
                    VALUES ({$user_id}, '{$therapist_id}','{$date}', '{$start_time}', '{$end_time}', '{$symptom}')");
                if ($insert_query) {
                    echo "success";
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "The therapist is already booked for this date and time. Please choose another slot.";
            }
        } else {
            echo "The time is in the past. Please choose a future time.";
        }
    } else {
        echo "The date is in the past. Please choose a future date.";
    }
} else {
    echo "All input fields are required!";
}

    
    // if (!empty($date) && !empty($start_time) && !empty($symptom)) {
    //     $insert_query = mysqli_query($conn, "INSERT INTO appointment (user_id, therapist_id, date, start_time, end_time, symptom) 
    //                 VALUES ({$user_id}, '{$therapist_id}','{$date}', '{$start_time}', '{$end_time}', '{$symptom}')");
    //     if ($insert_query) {
    //         echo "success";
    //     } else {
    //         echo "Something went wrong. Please try again!";
    //     }
    // }else {
    //     echo "All input fields are required!";
    // }
} else {
    header("location: ../login.php");
}



?>
