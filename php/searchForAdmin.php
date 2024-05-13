<?php
include_once "config.php";

$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
$whereToSearch = mysqli_real_escape_string($conn, $_POST['whereToSearch']); 

$table ="";


// if (!empty($searchTerm)) {
    
    if($whereToSearch == 'online-clients-list'){
        $sql = "SELECT * FROM users 
            WHERE status = 'Active now' AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
    }elseif ($whereToSearch == 'all-clients-list') {
            $sql = "SELECT * FROM users 
                    WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
    }elseif ($whereToSearch == 'online-therapist-list') {
            $sql = "SELECT * FROM therapist 
                    WHERE status = 'Active now' AND  (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
    }elseif ($whereToSearch == 'all-therapist-list') {
            $sql = "SELECT * FROM therapist
                    WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
    }elseif ($whereToSearch == 'all-schedules-list') {
        $sql = "SELECT u.fname AS user_fname, 
        u.lname AS user_lname, 
        u.img AS user_img, 
        t.fname AS therapist_fname, 
        t.lname AS therapist_lname, 
        t.img AS therapist_img, 
        a.date AS appointment_date, 
        a.start_time AS start_time,
        a.end_time AS end_time
    FROM Appointment a
    JOIN therapist t ON a.therapist_id = t.unique_id
    JOIN users u ON a.user_id = u.unique_id
    WHERE (u.fname LIKE '%{$searchTerm}%' OR u.lname LIKE '%{$searchTerm}%' OR t.fname LIKE '%{$searchTerm}%' OR t.lname LIKE '%{$searchTerm}%');";
        $table = 'schedule';
        
            // $sql = "SELECT * FROM appointment 
            //         WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
    }elseif ($whereToSearch == 'all-therapist-list-remove') {
        $table = 'therapist';
            $sql = "SELECT * FROM therapist 
                    WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
    }else{
        $sql ="";
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            if ($table === 'schedule') {
                // $user_result = mysqli_query($conn, "SELECT * FROM users WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') AND unique_id = '{$row['user_id']}'");
                // $therapist_result = mysqli_query($conn, "SELECT * FROM therapist WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') AND unique_id = '{$row['therapist_id']}'");
                
                // // Check if the queries returned results
                // if ($user_result && $therapist_result) {
                //     $users = mysqli_fetch_assoc($user_result);
                //     $therapist_row = mysqli_fetch_assoc($therapist_result);
                    
                //     // Output the HTML only if both user and therapist rows are found
                //     if ($users && $therapist_row) {
                        echo"<div>
                                <div class='users-img-name'>
                                    <img src='php/images/{$row['user_img']}' alt='img'>
                                    <p>{$row['user_fname']} {$row['user_lname']}</p>
                                </div>
                                <div class='date'><span>{$row['appointment_date']}</span></div>
                                <div class='time'><span>{$row['start_time']} - {$row['end_time']}</span></div>
                                <div class='therapist-img-name'>
                                    <img src='php/images/{$row['therapist_img']}' alt='img'>
                                    <p>{$row['therapist_fname']} {$row['therapist_lname']}</p>
                                </div>
                            </div>";
                //     }
                // }
            }else{
            // Use the same display logic from displayUsers() 
                echo "<div>";
                echo "<img src='php/images/{$row['img']}' alt='img'>";
                echo "<p>{$row['fname']} {$row['lname']}</p>";
                echo "</div>";
                // Add any additional elements like the "remove" button here if needed
                if ($table === 'therapist') {
                    echo "<div><form methoud='post'><button type='submit' name='remove' value={$row['unique_id']}>remove</button></div></form>";
                }
            }
        }
    }
// }