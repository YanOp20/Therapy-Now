
<?php

$id = $_SESSION['unique_id'];
$output = "";
date_default_timezone_set('Africa/Addis_Ababa');

$sql = "SELECT * FROM users LEFT JOIN appointment ON users.unique_id = appointment.user_id WHERE appointment.user_id = $id ORDER BY appointment.date DESC";
$sqlD = "SELECT * FROM therapist LEFT JOIN appointment ON therapist.unique_id = appointment.therapist_id WHERE appointment.therapist_id = $id ORDER BY appointment.date DESC";
$query = mysqli_query($conn, $sql);
$queryD = mysqli_query($conn, $sqlD);

while ($row = mysqli_fetch_assoc($queryD)) {
    $user_id = $row['user_id'];
    $sql2 = "SELECT * FROM users  WHERE users.unique_id = $user_id";
    $query2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($query2) > 0) {
        while ($row2 = mysqli_fetch_assoc($query2)) {
            $fname =  $row2['fname'];
            $lname =  $row2['lname'];
            $img =  $row2['img'];
            $u_id =  $row2['unique_id'];
        }
    } else {
        $fname = $img = $lname = "";
    }

    $appointmentTime = strtotime($row['date'] . ' ' . $row['start_time']);
    $currentTime = time();
    if ($appointmentTime < $currentTime) {
        $status = 'past';
    } elseif ($appointmentTime > $currentTime) {
        $status = 'future';
    } else {
        $status = 'present';
    }

    $datetime_string = $row['r_date']. " " .$row['r_time'];
    $status .=  (abs(time() - strtotime($datetime_string)) <= 60) ? " opacity-50" : " opacity-100";

    $output .= '<tr class="' . $status . '">
                    <td class="name">
                        <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                            <img src="php/images/' . $img . '?>" alt="">' . $fname . ' ' . $lname . '
                        </a>
                    </td>
                    <td>
                        <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                            '.$row['date'].'
                        </a>
                    </td>
                    <td>
                        <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                            '.$row['start_time'].'
                        </a>
                    </td>
                    <td>
                        <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                            '.$row['end_time'].'
                        </a>
                    </td>
                    <td>
                        <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                            '.$row['symptom'].'
                        </a>
                    </td>
                </tr>';
}

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {

        $user_id = $row['therapist_id'];
        $sql2 = "SELECT * FROM therapist  WHERE therapist.unique_id = $user_id";
        $query2 = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($query2) > 0) {
            while ($row2 = mysqli_fetch_assoc($query2)) {
                $fname =  $row2['fname'];
                $lname =  $row2['lname'];
                $img =  $row2['img'];
                $u_id =  $row2['unique_id'];
            }
        } else {
            $fname = $img = $lname = "";
        }
        $appointmentTime = strtotime($row['date'] . ' ' . $row['start_time']);
        $currentTime = time();
        if ($appointmentTime < $currentTime) {
            $status = 'past';
        } elseif ($appointmentTime > $currentTime) {
            $status = 'future';
        } else {
            $status = 'present';
        }

        $datetime_string = $row['r_date']. " " .$row['r_time'];
        $status .=  (abs(time() - strtotime($datetime_string)) <= 60) ? " opacity-50" : " opacity-100";

        $output .= '<tr class="' . $status . '">
                        <td class="name">
                            <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                                <img src="php/images/' . $img . '?>" alt="">' . $fname . ' ' . $lname . '
                            </a>
                        </td>
                        <td>
                            <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                                '.$row['date'].'
                            </a>
                        </td>
                        <td>
                            <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                                '.$row['start_time'].'
                            </a>
                        </td>
                        <td>
                            <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                                '.$row['end_time'].'
                            </a>
                        </td>
                        <td>
                            <a href="profile.php?user_id=' . $u_id . '&link=chat&b=b">
                                '.$row['symptom'].'
                            </a>
                        </td>
                    </tr>';
    }
}


echo '<div class="schedule right table-container">
<h1>Schedule</h1>
<div>
        <table>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Symptom</th>
            </tr>';

if ($output !== "") {
    echo $output;
} else {
    echo '<tr><td colspan="5">there is no scheduled</td></tr>';
}

echo '</table></div></div>';
?>
