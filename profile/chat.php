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
#error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 5px;
    border-radius: 5px;
    position: fixed;
    top: 15%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
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
            <?php if (isset($_GET['b'])) : ?>
            ,?<?php $b = 'b'; ?>
            <!-- <a href="./javascript/video-calling-app-example-master/public/index.html" target="popup" onclick="window.open('./javascript/video-calling-app-example-master/public/index.html','name','width=600,height=400')"><i class="fas fa-duotone fa-video fa-2xl "></i></a> -->
            <!-- <a href="https://172.22.181.60:8181" target="popup" class="fas fa-duotone fa-video fa-2xl "></i></a> -->

            <!-- addef for video calling -->
            <form action="#" class="formV">
                <!-- new added for getting user id -->
                <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>"
                    hidden>
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" class="b" name="b" value="<?php echo $b; ?>" hidden>
                <input id="c-input-field" type="text" name="message" class="input-field" value="<?php echo "calling" ?>"
                    hidden>
                <button id="videoCallingBtn">
                    <!-- <a href="localhost:8181" target="_blank" onclick="window.open('https://172.22.181.203:8181', 'popup', 'width=600,height=400'); return false;"> <i class="fas fa-duotone fa-video fa-2xl "></i> </a> -->
                    <a href="192.168.0.65:4000" target="_blank"
                        onclick="window.open('https://192.168.0.65:4000', 'popup', 'width=600,height=400'); return false;">
                        <i class="fas fa-duotone fa-video fa-2xl "></i> </a>
                </button>
            </form>
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
            <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>"
                hidden>
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
            <input type="text" class="b" name="b" value="<?php echo $b; ?>" hidden>
            <input id="input-field" type="text" name="message" class="input-field" placeholder="Type a message here..."
                autocomplete="off">
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

const host = `https://${window.location.hostname}`;
const port = 4000;
const socket = io.connect(`${host}:${port}/chat`);

socket.on('connect', () => {
    console.log('Connected to Socket.IO server');
});

socket.emit('get messages by user IDs', {
    ogi,
    ici
});

const roomId = [ogi, ici].sort().join('-');
socket.emit('join room', roomId);

socket.on('load messages', (messages) => {
    messages.forEach((message) => {
        const chatElement = document.createElement('div');
        chatElement.classList.add('chat');

        if (message.outgoing_msg_id == ogi) {
            chatElement.classList.add('outgoing');
        } else {
            chatElement.classList.add('incoming');

            if (message.img) {
                const imgElement = document.createElement('img');
                imgElement.src = `php/images/${message.img}`;
                imgElement.alt = "Profile picture";
                chatElement.appendChild(imgElement);
            }
        }

        const detailsElement = document.createElement('div');
        detailsElement.classList.add('details');

        if (message.audio) {
            const audioElement = document.createElement('audio');
            audioElement.src = `php/uploads/${message.audio}`;
            audioElement.type = 'audio/wav';
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
    chatBox.scrollTop = chatBox.scrollHeight;
    // document.querySelector('#mes').innerHTML = messages[0].msg
});

socket.on('new messages', (data) => {
    let class_name = "";
    let image = "";

    if (data.outgoingId === ogi) {
        class_name = 'outgoing';
    } else {
        class_name = 'incoming';

        if (data.img) {
            image = `<img src="php/images/${data.img}" alt="">`;
        }
    }

    const whatData = data.message && !data.audioDataUrl ?
        `<p>${data.message}</p>` :
        `<audio src="php/uploads/${data.audioDataUrl}" type="audio/wav" controls></audio>`;


    chatBox.innerHTML += `
                <div class="chat ${class_name}">
                    ${image}
                    <div class="details">
                        ${whatData}
                    </div>
                </div>
            `;
    if (!chatBox.classList.contains("active")) {
        scrollToBottom();
    }
});

socket.on('disconnect', () => {
    console.log('Disconnected from Socket.IO server');
});
</script>
<script src="javascript/chat.js"> </script>