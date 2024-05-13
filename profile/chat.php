<?php
$b = "";
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$unique_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);

$sqlU = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
$sqlT = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$user_id}");

if (mysqli_num_rows($sqlU) > 0) {
    $row = mysqli_fetch_assoc($sqlU);
    $Fname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$unique_id}"))['fname'];
    $lname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$unique_id}"))['lname'];
    $img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$unique_id}"))['img'];
} elseif (mysqli_num_rows($sqlT) > 0) {
    $row = mysqli_fetch_assoc($sqlT);
    $Fname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$unique_id}"))['fname'];
    $lname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$unique_id}"))['lname'];
    $img = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$unique_id}"))['img'];
} else // header("location: profile.php");
?>
<style>
@media screen and (max-width: 930px) {
  .users .users-list a .status-dot, .users .search,
  .users .users-list a div.content div{
      display: none !important;
  }
  .user{
      max-width: 100px !important;
  }
  .users .users-list{
    scrollbar-width: none;
  }
  
  }
</style>
<div class="wrapper chatt">
    <section class="chat-area">
        <header>
            <div class="details">
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <div>
                    <input id="Fname" type="hidden" value=<?php echo $Fname ?> name="">
                    <input id="lname" type="hidden" value=<?php echo $lname ?> name="">
                    <input id="img" type="hidden" value=<?php echo $img ?> name="">
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </div>

            <?php if (isset($_GET['b'])) : ?> <?php $b = 'b'; ?>
                <button id="videoCallingBtn"><i class="fas fa-duotone fa-video fa-2xl "></i></button>
            <?php endif; ?>


        </header>
        <div id="error-message" style="display: none;">this was error message</div>
        <div class="chat-box"></div>
        <form action="#" class="typing-area">

            <button id="cRec" class="active" style="display:none"><i class="active fas fas fa-times"></i></button>
            <button id="mic" class="active"><i class="active fas fa-microphone  microphone-icon"></i></button>
            <button id="stop" class="active" style="display:none;"><i class=" recording-icon fas fa-stop"></i></button>

            <audio src="" id="audioElement" controls style="display: none;"></audio>

            <p id="isRecording"></p>
            <span id="time"></span>
            <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
            <input type="text" class="b" name="b" value="<?php echo $b; ?>" hidden>
            <input id="input-field" type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
            <button id="sendBtn"><i class="fab fa-telegram-plane "></i></button>
            <button id="sendMic" style="display:none"><i class="active fas fa-paper-plane "></i></button>
        </form>
    </section>
</div>




<script src="javascript/chat2.js"> </script>
<script src="javascript/webRtc1.js"> </script>
<script src="javascript/chat.js"> </script>