<?php
$b = "";
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$unique_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);

$sqlU = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
$sqlT = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$user_id}");

if (mysqli_num_rows($sqlU) > 0) {
    $row = mysqli_fetch_assoc($sqlU);
    $Fname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$unique_id}"))['fname'];
} elseif (mysqli_num_rows($sqlT) > 0) {
    $row = mysqli_fetch_assoc($sqlT);
    $Fname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$unique_id}"))['fname'];
} else // header("location: profile.php");
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
                    <input id="Fname" type="hidden" value=<?php echo $Fname ?> name="">
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
            </div>
            <?php if (isset($_GET['b'])) : ?>
                <?php $b = 'b'; ?>

                <!-- <form action="#" class="formV"> -->
                <!-- new added for getting user id -->
                <!-- <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>"
                    hidden>
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" class="b" name="b" value="<?php echo $b; ?>" hidden>
                <input id="c-input-field" type="text" name="message" class="input-field" value="<?php echo "calling" ?>"
                    hidden>
                <button id="videoCallingBtn"> -->
                <!-- <a href="localhost:8181" target="_blank" onclick="window.open('https://172.22.181.203:8181', 'popup', 'width=600,height=400'); return false;"> <i class="fas fa-duotone fa-video fa-2xl "></i> </a> -->
                <!-- <a href="192.168.0.65:4000" target="_blank"
                        onclick="window.open('https://192.168.0.65:4000', 'popup', 'width=600,height=400'); return false;">
                        <i class="fas fa-duotone fa-video fa-2xl "></i> </a>
                </button>
            </form> -->
                <button id="videoCallingBtn">
                    <!-- <a href="localhost:8181" target="_blank" onclick="window.open('https://172.22.181.203:8181', 'popup', 'width=600,height=400'); return false;"> <i class="fas fa-duotone fa-video fa-2xl "></i> </a> -->
                    <!-- <a href="192.168.0.65:4000" target="_blank"
                    onclick="window.open('https://192.168.0.65:4000', 'popup', 'width=600,height=400'); return false;"> -->
                    <i class="fas fa-duotone fa-video fa-2xl "></i>
                    <!-- </a> -->b
                </button>


            <?php endif; ?>
            <div class="row mb-3 mt-3 justify-content-md-center">
            <div id="user-name"></div>
                <div id="user-name"></div>
                <button id="call" class="btn btn-primary col-1">Call!</button>
                <button id="hangup" class="col-1" class="btn btn-primary">Hangup</button>
                <div id="answer" class="col"></div>
            </div>
            <div id="incomingCallModal" class="modal">

                <div class="modal-content">
                    <span id="callerName"></span>
                    <button id="acceptCallBtn">Accept</button>
                    <button id="declineCallBtn">Decline</button>
                </div>
            </div>
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

<!-- video Call interface -->
<!-- ((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))) -->
<!-- ((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))) -->
<style>
    /* Initial styling */
    #videoCallContainer * {
        border: solid 1px white;
    }

    #videoCallContainer {
        display: none;
        /* Initially hidden */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index: 2;
        /* Ensure it's on top */
    }

    #remoteVideoContainer {
        border: solid 1px red;
        width: 100%;
        height: 100%;
        position: relative;
        /* To allow positioning elements inside */
    }

    #remoteVideo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        bottom: 0;
        right: 0;
    }

    #localVideoContainer {
        position: absolute;
        bottom: 10%;
        right: 5%;
        width: 20vw;
        height: 20vw;
        border-radius: 50%;
        overflow: hidden;
        z-index: 10;
    }

    #localVideo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #callControls {
        position: absolute;
        bottom: 5%;
        left: 20%;
        z-index: 10;
    }

    #callingMsg {
        position: absolute;
        bottom: 40%;
        left: 30%;
        z-index: 10;
        color: yellow;
        font: 3em;
        font-weight: 800;
    }

    /* Minimized styles (add these later) */
    .minimized {
        width: 25%;
        height: 25%;
        top: 37.5%;
        left: 37.5%;
        border-radius: 10px;
    }

    .circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Header Styles */
    #header {
        display: flex;
        justify-content: flex-end;
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
    }

    #header button {
        margin-left: 10px;
    }

    #circleBtn,
    #maximizeBtn {
        display: none;
    }
</style>
<div id="videoCallContainer">

    <div id="header">
        <button id="minimizeBtn1">Minimize 1</button>
        <button id="minimizeBtn2">Minimize 2</button>
        <button id="maximizeBtn" style="display: none;">Maximize</button>
    </div>

    <div id="remoteVideoContainer">
        <video id="remoteVideo" autoplay playsinline></video>
    </div>

    <div id="localVideoContainer">
        <video id="localVideo" autoplay playsinline muted></video>
    </div>
    <div id="callingMsg">
        <h1>calling</h1>
    </div>

    <div id="callControls">
        <button id="muteVideoBtn">mute video</button>
        <button id="muteBtn">Mute</button>
        <button id="hangUpBtn">Hang Up</button>
    </div>
    <div id="circle">
        <button id="minimizeToCircleBtn">Minimize (Circle)</button>
        <button id="maximizeBtn" style="display: none;">Maximize</button>
    </div>
</div>

<!-- ((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))) -->
<!-- ((((((((((((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))) -->


<!-- <script src="./Server/socket.io.min.js"></script>
<script src="/socket.io/socket.io.js"></script> -->
<script src="https://cdn.socket.io/4.7.5/socket.io.min.js" integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO" crossorigin="anonymous"></script>
<!-- <script src="/socket.io/socket.io.js"></script> -->
<!--  this was for chat -->
<script>
    const host = `https://${window.location.hostname}`;
    const port = 4000;
    // const socket = io.connect(`${host}:${port}`);
</script>
<script>
    // chat
    const outgoingID = document.querySelector('.outgoing_id').value;
    const incomingID = document.querySelector('.incoming_id').value;

    const chatNamespace = io.connect(`${host}:${port}/chat`,{
        secure: true,
        rejectUnauthorized: false
    });


    chatNamespace.on('connect', () => {
        console.log('Connected to Socket.IO server chatNamespace');
    });
    chatNamespace.on('connect_error', (error) => {
    console.error('Connection error:', error);
});

    chatNamespace.emit('get messages by user IDs', {
        outgoingID,
        incomingID
    });

    const roomId = [outgoingID, incomingID].sort().join('-');

    chatNamespace.emit('join room', roomId);

    chatNamespace.on('load messages', messages => {

        messages.forEach((message) => {
            const chatElement = document.createElement('div');
            chatElement.classList.add('chat');
            if (message.outgoing_msg_id == outgoingID) {
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

    chatNamespace.on('new messages', (data) => {
        // console.log("new message", data);
        let class_name = "";
        let image = "";

        if (data.outgoingId != outgoingID) {
            class_name = 'incoming';

            if (data.img) {
                image = `<img src="php/images/${data.img}" alt="">`;
            }
        } else {
            class_name = 'outgoing';
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

    chatNamespace.on('disconnect', () => {
        console.log('Disconnected from Socket.IO server chatnamespace');
    });
</script>

<!-- this was for video calling  -->
<!-- <script>
    const videoCallingBtn = document.getElementById("videoCallingBtn");
    const localVideoEl = document.querySelector('#localVideo');
    const remoteVideoEl = document.querySelector('#remoteVideo');
    const callingMsg = document.querySelector('#callingMsg');
    const userName = document.getElementById("Fname").value+"-" + outgoingID
    // const userName = "Rob-" + Math.floor(Math.random() * 100000)
    const password = "p";
    // document.querySelector('#user-name').innerHTML = userName;
    // const host = `https://${window.location.hostname}`;
    // const port = 4000;
    const webRtcNamespace = io.connect(`${host}:${port}/webRtc`, {
        auth: {
            userName,
            password
        },
        secure: true,
        rejectUnauthorized: false
    });
    webRtcNamespace.on('connect', console.log('Connected to Socket.io server on web rtc namespace'));
    webRtcNamespace.on('error', (error) => {console.error('Connection error:', error);
    });

    webRtcNamespace.emit('joinRoom', roomId);

    let localStream; //a var to hold the local video stream
    let remoteStream; //a var to hold the remote video stream
    let peerConnection; //the peerConnection that the two clients use to talk
    let didIOffer = false;

    let peerConfiguration = {
        iceServers: [{
            urls: ['stun:stun.l.google.com:19302', 'stun:stun1.l.google.com:19302']
        }]
    }

    webRtcNamespace.on("logCallerId", (data) => {
        console.log("Received data:", data);
        const {
            callerId
        } = data;
        // Log the caller ID only if it doesn't match the outgoing ID
        if (callerId !== outgoingID) {
            // console.log("Call request from:", callerId);
            // const modalElement = document.getElementById("incomingCallModal");
            // modalElement.style.display = "block";
            // document.getElementById("callerName").textContent = document.getElementById("Fname").innerText; // Or any other way to get caller's name
            videoCallingBtn.style.display = "none";

        }
    });


    //when a client initiates a call
    const call = async e => {
        await fetchUserMedia();
        //peerConnection is all set with our STUN servers sent over
        await createPeerConnection();


        //create offer time!
        try {
            console.log("Creating offer...")
            const offer = await peerConnection.createOffer();
            // console.log(offer);
            peerConnection.setLocalDescription(offer);
            didIOffer = true;
            webRtcNamespace.emit('newOffer', offer); //send offer to signalingServer


            // Show the video call container
            videoCallContainer.style.display = 'block';
            videoCallingBtn.style.display = 'none';
            // Emit the callRequest event to initiate the call
            webRtcNamespace.emit("callRequest", {
                callerId: outgoingID,
                recipientId: incomingID,
                roomId
            });

        } catch (error) {
            console.error("Error creating offer:", error);
        }
    };


    const answerOffer = async (offerObj) => {
        await fetchUserMedia()
        await createPeerConnection(offerObj);
        const answer = await peerConnection.createAnswer({}); //just to make the docs happy
        await peerConnection.setLocalDescription(answer); //this is CLIENT2, and CLIENT2 uses the answer as the localDesc
        console.log(offerObj)
        console.log(answer)
        console.log(peerConnection.signalingState) //should be have-local-pranswer because CLIENT2 has set its local desc to it's answer (but it won't be)
        //add the answer to the offerObj so the server knows which offer this is related to
        offerObj.answer = answer
        //emit the answer to the signaling server, so it can emit to CLIENT1
        //expect a response from the server with the already existing ICE candidates
        const offerIceCandidates = await webRtcNamespace.emitWithAck('newAnswer', offerObj)
        offerIceCandidates.forEach(c => {
            peerConnection.addIceCandidate(c);
            console.log("======Added Ice Candidate======")
        })
        console.log(offerIceCandidates)
    }

    const addAnswer = async (offerObj) => {
        //addAnswer is called in socketListeners when an answerResponse is emitted.
        //at this point, the offer and answer have been exchanged!
        //now CLIENT1 needs to set the remote
        await peerConnection.setRemoteDescription(offerObj.answer)
        console.log(peerConnection.signalingState)
    }

    const fetchUserMedia = () => {
        return new Promise(async (resolve, reject) => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true,
                    // audio: true,
                });
                localVideoEl.srcObject = stream;
                localStream = stream;
                resolve();
            } catch (err) {
                console.log(err);
                reject()
            }
        })
    }

    const createPeerConnection = (offerObj) => {
        return new Promise(async (resolve, reject) => {
            //RTCPeerConnection is the thing that creates the connection
            //we can pass a config object, and that config object can contain stun servers
            //which will fetch us ICE candidates
            peerConnection = await new RTCPeerConnection(peerConfiguration)
            remoteStream = new MediaStream()
            remoteVideoEl.srcObject = remoteStream;


            localStream.getTracks().forEach(track => {
                //add local tracks so that they can be sent once the connection is established
                peerConnection.addTrack(track, localStream);
            })

            peerConnection.addEventListener("signalingstatechange", (event) => {
                console.log(event);
                console.log(peerConnection.signalingState)
            });

            peerConnection.addEventListener('icecandidate', e => {
                console.log('........Ice candidate found!......')
                console.log(e)
                if (e.candidate) {
                    webRtcNamespace.emit('sendIceCandidateToSignalingServer', {
                        iceCandidate: e.candidate,
                        iceUserName: userName,
                        didIOffer,
                    })
                }
            })

            peerConnection.addEventListener('track', e => {
                console.log("Got a track from the other peer!! How exiting")
                console.log(e)
                e.streams[0].getTracks().forEach(track => {
                    remoteStream.addTrack(track, remoteStream);
                    console.log("Here's an exciting moment... fingers cross")
                })
            })

            if (offerObj) {
                //this won't be set when called from call();
                //will be set when we call from answerOffer()
                console.log(peerConnection.signalingState) //should be stable because no setDesc has been run yet
                await peerConnection.setRemoteDescription(offerObj.offer)
                console.log(peerConnection.signalingState) //should be have-remote-offer, because client2 has setRemoteDesc on the offer
            }
            resolve();
        })
    }

    const addNewIceCandidate = iceCandidate => {
        peerConnection.addIceCandidate(iceCandidate)
        console.log("======Added Ice Candidate======")
    }


    videoCallingBtn.addEventListener('click', call)

    // ##################################################################
    // ##################################################################

    //on connection get all available offers and call createOfferEls
    webRtcNamespace.on('availableOffers', offers => {
        console.log(offers)
        createOfferEls(offers)
    })

    //someone just made a new offer and we're already here - call createOfferEls
    webRtcNamespace.on('newOfferAwaiting', offers => {
        createOfferEls(offers)
    })

    webRtcNamespace.on('answerResponse', offerObj => {
        console.log(offerObj)
        addAnswer(offerObj)
    })

    webRtcNamespace.on('receivedIceCandidateFromServer', iceCandidate => {
        addNewIceCandidate(iceCandidate)
        console.log(iceCandidate)
    })

    function createOfferEls(offers) {
        //make green answer button for this new offer
        const answerEl = document.querySelector('#answer');
        offers.forEach(o => {
            console.log(o);
            const newOfferEl = document.createElement('div');
            newOfferEl.innerHTML = `<button class="btn btn-success col-1">Answer ${o.offererUserName}</button>`
            newOfferEl.addEventListener('click', () => {
                videoCallContainer.style.display = 'block';
                videoCallingBtn.style.display = 'none';
                answerOffer(o)
            })
            answerEl.appendChild(newOfferEl);
        })
    }


    webRtcNamespace.on('disconnect', () => console.log('Disconnected from Socket.IO server web RTC namespace'));
</script> -->
<!-- <script>
    //newwwwwwwwwwwwwwwwwwwww

    const videoCallingBtn = document.getElementById("videoCallingBtn");
    const localVideoEl = document.querySelector('#localVideo');
    const remoteVideoEl = document.querySelector('#remoteVideo');
    const callingMsg = document.querySelector('#callingMsg');

    const userName = "Rob-" + Math.floor(Math.random() * 100000)
    const password = "p";
    document.querySelector('#user-name').innerHTML = userName;

    // const host = `https://192.168.100.7`;
    // const port = 4000
    const webRtcNamespace = io.connect(`${host}:${port}/webRtc`, {
        auth: {
            userName,
            password
        }
    });

    let localStream; //a var to hold the local video stream
    let remoteStream; //a var to hold the remote video stream
    let peerConnection; //the peerConnection that the two clients use to talk
    let didIOffer = false;

    let peerConfiguration = {
        iceServers: [{
            urls: [
                'stun:stun.l.google.com:19302',
                'stun:stun1.l.google.com:19302'
            ]
        }]
    }
    webRtcNamespace.on('connect', (socket) => {
        console.log('Connected to Socket.io server on web rtc namespace');
        // ... Now you can use 'socket' for emitting and listening to events ...
    });

    webRtcNamespace.emit('joinRoom', roomId);
    webRtcNamespace.on("logCallerId", (data) => {
        console.log("Received data:", data);
        const {
            callerId
        } = data;
        // Log the caller ID only if it doesn't match the outgoing ID
        if (callerId !== outgoingID) {
            // console.log("Call request from:", callerId);
            // const modalElement = document.getElementById("incomingCallModal");
            // modalElement.style.display = "block";
            // document.getElementById("callerName").textContent = document.getElementById("Fname").innerText; // Or any other way to get caller's name
            videoCallingBtn.style.display = "none";

        }
    });

    //when a client initiates a call
    const call = async e => {
        await fetchUserMedia();

        //peerConnection is all set with our STUN servers sent over
        await createPeerConnection();

        //create offer time!
        try {
            console.log("Creating offer...")
            const offer = await peerConnection.createOffer();
            console.log(offer);
            peerConnection.setLocalDescription(offer);
            didIOffer = true;
            webRtcNamespace.emit('newOffer', offer); //send offer to signalingServer


            // Show the video call container
            videoCallContainer.style.display = 'block';
            videoCallingBtn.style.display = 'none';
            // Emit the callRequest event to initiate the call
            webRtcNamespace.emit("callRequest", {
                callerId: outgoingID,
                recipientId: incomingID,
                roomId
            });

        } catch (err) {
            console.log(err)
        }

    }

    const answerOffer = async (offerObj) => {
        await fetchUserMedia()
        await createPeerConnection(offerObj);
        const answer = await peerConnection.createAnswer({}); //just to make the docs happy
        await peerConnection.setLocalDescription(answer); //this is CLIENT2, and CLIENT2 uses the answer as the localDesc
        console.log(offerObj)
        console.log(answer)
        // console.log(peerConnection.signalingState) //should be have-local-pranswer because CLIENT2 has set its local desc to it's answer (but it won't be)
        //add the answer to the offerObj so the server knows which offer this is related to
        offerObj.answer = answer
        //emit the answer to the signaling server, so it can emit to CLIENT1
        //expect a response from the server with the already existing ICE candidates
        const offerIceCandidates = await webRtcNamespace.emitWithAck('newAnswer', offerObj)
        offerIceCandidates.forEach(c => {
            peerConnection.addIceCandidate(c);
            console.log("======Added Ice Candidate======")
        })
        console.log(offerIceCandidates)
    }

    const addAnswer = async (offerObj) => {
        //addAnswer is called in socketListeners when an answerResponse is emitted.
        //at this point, the offer and answer have been exchanged!
        //now CLIENT1 needs to set the remote
        await peerConnection.setRemoteDescription(offerObj.answer)
        // console.log(peerConnection.signalingState)
    }

    const fetchUserMedia = () => {
        return new Promise(async (resolve, reject) => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true,
                    // audio: true,
                });
                localVideoEl.srcObject = stream;
                localStream = stream;
                resolve();
            } catch (err) {
                console.log(err);
                reject()
            }
        })
    }

    const createPeerConnection = (offerObj) => {
        return new Promise(async (resolve, reject) => {
            //RTCPeerConnection is the thing that creates the connection
            //we can pass a config object, and that config object can contain stun servers
            //which will fetch us ICE candidates
            peerConnection = await new RTCPeerConnection(peerConfiguration)
            remoteStream = new MediaStream()
            remoteVideoEl.srcObject = remoteStream;


            localStream.getTracks().forEach(track => {
                //add localtracks so that they can be sent once the connection is established
                peerConnection.addTrack(track, localStream);
            })

            peerConnection.addEventListener("signalingstatechange", (event) => {
                console.log(event);
                console.log(peerConnection.signalingState)
            });

            peerConnection.addEventListener('icecandidate', e => {
                console.log('........Ice candidate found!......')
                console.log(e)
                if (e.candidate) {
                    webRtcNamespace.emit('sendIceCandidateToSignalingServer', {
                        iceCandidate: e.candidate,
                        iceUserName: userName,
                        didIOffer,
                    })
                }
            })

            peerConnection.addEventListener('track', e => {
                console.log("Got a track from the other peer!! How excting")
                console.log(e)
                e.streams[0].getTracks().forEach(track => {
                    remoteStream.addTrack(track, remoteStream);
                    console.log("Here's an exciting moment... fingers cross")
                })
            })

            if (offerObj) {
                //this won't be set when called from call();
                //will be set when we call from answerOffer()
                // console.log(peerConnection.signalingState) //should be stable because no setDesc has been run yet
                await peerConnection.setRemoteDescription(offerObj.offer)
                // console.log(peerConnection.signalingState) //should be have-remote-offer, because client2 has setRemoteDesc on the offer
            }
            resolve();
        })
    }

    const addNewIceCandidate = iceCandidate => {
        peerConnection.addIceCandidate(iceCandidate)
        console.log("======Added Ice Candidate======")
    }


    document.querySelector('#call').addEventListener('click', call, )


    // ###########################################
    // ###########################################

    //on connection get all available offers and call createOfferEls
    webRtcNamespace.on('availableOffers', offers => {
        console.log(offers)
        createOfferEls(offers)
    })

    //someone just made a new offer and we're already here - call createOfferEls
    webRtcNamespace.on('newOfferAwaiting', offers => {
        createOfferEls(offers)
    })

    webRtcNamespace.on('answerResponse', offerObj => {
        console.log(offerObj)
        addAnswer(offerObj)
    })

    webRtcNamespace.on('receivedIceCandidateFromServer', iceCandidate => {
        addNewIceCandidate(iceCandidate)
        console.log(iceCandidate)
    })

    function createOfferEls(offers) {
        //make green answer button for this new offer
        const answerEl = document.querySelector('#answer');
        offers.forEach(o => {
            console.log(o);
            const newOfferEl = document.createElement('div');
            newOfferEl.innerHTML = `<button class="btn btn-success col-1">Answer ${o.offererUserName}</button>`
            newOfferEl.addEventListener('click', () => {
                answerOffer(o);

                videoCallContainer.style.display = 'block';
                videoCallingBtn.style.display = 'none';

            })
            answerEl.appendChild(newOfferEl);
        })
    }
</script> -->
<script src="javascript/chat.js"> </script>