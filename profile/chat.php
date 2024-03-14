<?php
$b = "";
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$sqlU = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
$sqlT = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$user_id}");

if (mysqli_num_rows($sqlU) > 0) {
    $row = mysqli_fetch_assoc($sqlU);
} elseif (mysqli_num_rows($sqlT) > 0) {
    $row = mysqli_fetch_assoc($sqlT);
} else {
    // header("location: profile.php");
}
?>
<div class="wrapper chatt">
    <section class="chat-area">
        <header>
            <div class="details">
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div>
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </div>
            <?php if (isset($_GET['b'])) {
                $b = 'b'; ?>
                <!-- <a href="./javascript/video-calling-app-example-master/public/index.html" target="popup" onclick="window.open('./javascript/video-calling-app-example-master/public/index.html','name','width=600,height=400')"><i class="fas fa-duotone fa-video fa-2xl "></i></a> -->
                <!-- <a href="https://172.22.181.60:8181" target="popup" class="fas fa-duotone fa-video fa-2xl "></i></a> -->

                <!-- addef for video calling -->
                <form action="#" class="formV">
                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" class="b" name="b" value="<?php echo $b; ?>" hidden>
                    <input id="input-field" type="text" name="message" class="input-field" value="<?php echo "calling" ?>" hidden>
                    <button id="Vbtn">
                        <a href="https://172.22.181.203:8181" target="_blank" onclick="window.open('https://172.22.181.203:8181', 'popup', 'width=600,height=400'); return false;"> <i class="fas fa-duotone fa-video fa-2xl "></i> </a>
                    </button>
                </form>

            <?php   } ?>
        </header>
        <div class="chat-box">


        </div>
        <form action="#" class="typing-area">

            <button id="cRec" class="active" style="display:none"><i class="active fas fas fa-times"></i></button>
            <button id="mic" class="active"><i class="active fas fa-microphone  microphone-icon"></i></button>
            <button id="stop" class="active" style="display:none;"><i class=" recording-icon fas fa-stop"></i></button>

            <audio src="" id="audioElement" controls style="display: none;"></audio>

            <p id="isRecording"></p>
            <span id="time"></span>
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
            <input type="text" class="b" name="b" value="<?php echo $b; ?>" hidden>
            <input id="input-field" type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <button id="sendBtn"><i class="fab fa-telegram-plane "></i></button>
            <button id="sendMic" style="display:none"><i class="active fas fa-paper-plane "></i></button>
        </form>
    </section>
</div>
<script src="javascript/chat.js"></script>