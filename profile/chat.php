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
<style>
    /* div{border: solid 1px pink;} */
</style>
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
                    <!-- new added for getting user id -->
                    <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                    <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" class="b" name="b" value="<?php echo $b; ?>" hidden>
                    <input id="c-input-field" type="text" name="message" class="input-field" value="<?php echo "calling" ?>" hidden>
                    <button id="Vbtn">
                        <a href="https://172.22.181.203:8181" target="_blank" onclick="window.open('https://172.22.181.203:8181', 'popup', 'width=600,height=400'); return false;"> <i class="fas fa-duotone fa-video fa-2xl "></i> </a>
                    </button>
                </form>

            <?php   } ?>
        </header>
        <div class="chat-box">

            <div id="mes"></div>
        </div>
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
<script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
<!-- <script src="./Server/socket.io.min.js"></script> -->
<script>
    const ogi = document.querySelector('.outgoing_id').value;
    const ici = document.querySelector('.incoming_id').value;
    const host = `https://172.22.181.211`;
    const port = 4000
    
    const socket = io.connect(`${host+':'+port}/chat`);
    
    
    socket.on('connect', () => {
        console.log('Connected to Socket.IO server');
    });
    
    
    socket.emit('get messages by user IDs', { ogi, ici});
    const roomId = [ogi, ici].sort().join('-');
    socket.emit('join room', roomId);
    

    // ... other code
    socket.on('load messages', (messages) => {
        messages.forEach((message) => {
            // Create HTML elements based on message data
            const chatElement = document.createElement('div');
            chatElement.classList.add('chat');
            // console.log('outgoing id', ogi)
            // console.log('incoming' , ici)
            
            if (message.outgoing_msg_id === ogi) {
                chatElement.classList.add('incoming');
            } else {
                chatElement.classList.add('outgoing');
            }
            
            const detailsElement = document.createElement('div');
            detailsElement.classList.add('details');
            
            if (message.audio) {
                const audioElement = document.createElement('audio');
                audioElement.src = `php/uploads/${message.audio}`;
                audioElement.type = 'audio/mp3';
                audioElement.controls = true;
                detailsElement.appendChild(audioElement);
            } else {
                const messageElement = document.createElement('p');
                messageElement.textContent = message.msg;
                detailsElement.appendChild(messageElement);
            }
            
            chatElement.appendChild(detailsElement);
            
            // Append the chat element to the chat box
            chatBox.appendChild(chatElement);
            // console.log(chatBox)
            if (!chatBox.classList.contains("active")) {
                scrollToBottom();
            }
        });
        // document.querySelector('#mes').innerHTML = messages[0].msg
    });
    
    socket.on('new messages', d => {
        console.log("New message received:", d.data);
        const ddata = d.data.message && !d.data.audioDataUrl ?
                `<p> ${d.data.message}</p>` :
                `<audio src="php/uploads/${d.data.audioDataUrl} type="audio/mp3" controls></audio>`;
        chatBox.innerHTML += `<div class="chat outgoing">
                                    <div class="details">
                                        ${ddata}
                                    </div>
                                </div>`
        
        if (!chatBox.classList.contains("active")) {
            scrollToBottom();
        }
        
    })    
    
    
    socket.on('disconnect', () => {
        console.log('Disconnected from Socket.IO server');
    });
</script>
<script src="javascript/chat.js"> </script>