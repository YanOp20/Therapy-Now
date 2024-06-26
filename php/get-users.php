<?php
session_start();
require_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$sqlU = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = $outgoing_id"); // user
$sqlT = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = $outgoing_id"); // therapist 
$output  = '';

if (mysqli_num_rows($sqlU) > 0) { // for user viewing
    $sqlU2 = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = 40000;"); // public
    $sqlU22 = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id IN (SELECT therapist_id FROM appointment WHERE user_id = {$outgoing_id});"); //private

    if (mysqli_num_rows($sqlU2) > 0) { // user public viewing

        while ($row = mysqli_fetch_assoc($sqlU2)) {
            $sql2 = "SELECT * FROM messages WHERE 
                    incoming_msg_id = 40000 AND outgoing_msg_id = {$outgoing_id} OR 
                    incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = 40000 
                    ORDER BY msg_id DESC LIMIT 1";
            

            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
            (strlen($result) > 20) ? $msg =  substr($result, 0, 20) . '...' : $msg = $result;
            if (isset($row2['outgoing_msg_id'])) {
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            } else {
                $you = "";
            }
            ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";


            $output .= '<a href="profile.php?user_id=' . $row['unique_id'] . '&link=chat">
                    <div class="content">
                        <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
        }
    }
    if (mysqli_num_rows($sqlU22) > 0) { // user private viewing

        while ($row = mysqli_fetch_assoc($sqlU22)) {
            $sql2 = "SELECT * FROM messages WHERE ((b = 'b') AND ((incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}))) ORDER BY msg_id DESC LIMIT 1";

            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
            (strlen($result) > 20) ? $msg =  substr($result, 0, 20) . '...' : $msg = $result;
            if (isset($row2['outgoing_msg_id'])) {
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            } else {
                $you = "";
            }
            ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";


            $output .= '<a href="profile.php?user_id=' . $row['unique_id'] . '&link=chat&b=b">
                    <div class="content">
                        <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
        }
    }
} elseif (mysqli_num_rows($sqlT) > 0 && $outgoing_id !== '40000') { // for therapists viewing
    $sqlT22 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id IN (SELECT user_id FROM appointment WHERE therapist_id = {$outgoing_id});"); // private

    if (mysqli_num_rows($sqlT22) > 0) { // therapists private view


        while ($row = mysqli_fetch_assoc($sqlT22)) {
            $sql2 = "SELECT * FROM messages WHERE ((b = 'b') AND((incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}))) ORDER BY msg_id DESC LIMIT 1";

            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
            (strlen($result) > 20) ? $msg =  substr($result, 0, 20) . '...' : $msg = $result;
            if (isset($row2['outgoing_msg_id'])) {
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            } else {
                $you = "";
            }
            ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

// style="padding: 0.5em;background:rgba(190, 247, 206, .5); border-radius: 15px;"
            $output .= '<a  href="profile.php?user_id=' . $row['unique_id'] . '&link=chat&b=b">
                    <div class="content">
                        <img src="php/images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
        }

    }
} elseif (mysqli_num_rows($sqlT) > 0 && $outgoing_id === '40000') { // for speack freely viewing

    $sqlT2 = mysqli_query($conn, "
                SELECT u.*, MAX(m.msg_id) as latest_msg_id
                FROM Users u
                LEFT JOIN messages m ON (u.unique_id = m.outgoing_msg_id OR u.user_id = m.incoming_msg_id)
                GROUP BY u.user_id
                ORDER BY latest_msg_id DESC;
        " );


    if (mysqli_num_rows($sqlT2) > 0) { // therapists public view
    
            while ($row = mysqli_fetch_assoc($sqlT2)) {
                $sql2 = "SELECT * FROM messages WHERE 
                        incoming_msg_id = {$row['unique_id']} AND outgoing_msg_id = {$outgoing_id} OR 
                        incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$row['unique_id']} 
                        ORDER BY msg_id DESC LIMIT 1";
                
    
                $query2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($query2);
                (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
                (strlen($result) > 20) ? $msg =  substr($result, 0, 20) . '...' : $msg = $result;
                if (isset($row2['outgoing_msg_id'])) {
                    ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
                } else {
                    $you = "";
                }
                ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
                ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
    
    
                $output .= '<a href="profile.php?user_id=' . $row['unique_id'] . '&link=chat">
                        <div class="content">
                            <img src="php/images/' . $row['img'] . '" alt="">
                            <div class="details">
                                <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                                <p>' . $you . $msg . '</p>
                            </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';
            }



        }


}else {
    $output .= "No users are available to chat";
}

echo $output;
