<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $d_id = 40000;
    $output = "";

    $uq = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$outgoing_id}");
    $tq = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$outgoing_id}");

    if (mysqli_num_rows($tq) > 0) {

        $userID = $incoming_id;

        $sqlP = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE ((b = 'b') AND ((incoming_msg_id = {$incoming_id}  AND outgoing_msg_id = {$outgoing_id} ) or (incoming_msg_id = {$outgoing_id}   AND outgoing_msg_id = {$incoming_id})));";
    } elseif (mysqli_num_rows($uq) > 0) {


        $userID = $outgoing_id;
        $sqlP = "SELECT * FROM messages LEFT JOIN therapist ON therapist.unique_id = messages.outgoing_msg_id
                WHERE ((b = 'b') AND ((incoming_msg_id = {$incoming_id}  AND outgoing_msg_id = {$outgoing_id} ) or (incoming_msg_id = {$outgoing_id}   AND outgoing_msg_id = {$incoming_id})));";
    }



    $sql = "SELECT messages.*, users.fname, 
        CASE 
            WHEN therapist.unique_id IS NOT NULL AND users.img IS NULL THEN therapist.img
            ELSE users.img
        END AS img
        FROM messages 
        LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
        LEFT JOIN therapist ON therapist.unique_id = messages.outgoing_msg_id
        WHERE (NOT (b = 'b') AND ((incoming_msg_id = {$d_id} AND outgoing_msg_id = {$userID} ) OR (incoming_msg_id = {$userID}))) ORDER BY `messages`.`msg_id` ASC;";

    if (isset($_SESSION['b']) && $_SESSION['b'] == 'b') {
        $query = mysqli_query($conn, $sqlP);
    } else {
        $query = mysqli_query($conn, $sql);
    }

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['`outgoing_msg_id`'] === $outgoing_id) {
                if ($row['audio']) {
                    $output .= '<div class="chat outgoing">
                                        <div class="details">
                                        <audio src="php/uploads/' . $row['audio'] . '" type="audio/mp3" controls></audio>
                                        </div>
                                        </div>';
                } else {

                    $output .= '<div class="chat outgoing">
                        <div class="details">
                        <p>' . $row['msg'] . '</p>
                        </div>
                        </div>';
                }
            } else {
                if ($row['audio'] != '') {
                    $output .= '<div class="chat incoming">
                        <img src="php/images/' . $row['img'] . '" alt="">

                        <div class="details">
                        <audio src="php/uploads/' . $row['audio'] . '" type="audio/mp3" controls></audio>
                        </div>
                        </div>';
                } else {
                    $output .= '<div class="chat incoming">
                                    <img src="php/images/' . $row['img'] . '" alt="">
                                    <div class="details">
                                        <p>' . $row['msg'] . '</p>
                                    </div>
                                </div>';
                }
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
