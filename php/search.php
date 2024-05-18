<?php
    session_start();
    require_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') "; old

    // $Sq = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = 40000");
    $tq = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = $outgoing_id");

    if(mysqli_num_rows($tq) > 0 && $outgoing_id === '40000'){
        $sql = "SELECT * FROM users WHERE (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    }
    elseif(mysqli_num_rows($tq) > 0 && $outgoing_id !== '40000' ){

        $sql = "SELECT * FROM users WHERE unique_id IN 
            (SELECT user_id FROM appointment WHERE therapist_id = {$outgoing_id}) AND 
            (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    }else {$sql = '';}



    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_assoc($query)) {
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
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>