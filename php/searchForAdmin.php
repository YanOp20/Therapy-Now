<?php
include_once "config.php";

$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); 
$whereToSearch = mysqli_real_escape_string($conn, $_POST['whereToSearch']); 

$t ="";


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
        $t = 'schedule';
        
            // $sql = "SELECT * FROM appointment 
            //         WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
    }elseif ($whereToSearch == 'all-therapist-list-remove') {
        $t = 'therapist';
            $sql = "SELECT * FROM therapist 
                    WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')";
    }else{
        $sql ="";
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            if ($t === 'schedule') {
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

            }else{
                echo "<div>";
                echo "<img src='php/images/{$row['img']}' alt='img'>";
                echo "<p>{$row['fname']} {$row['lname']}</p>";
                echo $t === 'therapist' ? "<div>
                                            <form method='post' autocomplete='off'>
                                                <input type='hidden' name='remove' value='{$row['unique_id']}'>
                                                <button type='submit'>Remove</button>
                                            </form>
                                        </div>
                                        " :'';
                echo "</div>";
            }
        }
    }
// }