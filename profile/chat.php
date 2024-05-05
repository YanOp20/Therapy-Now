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
/* Styling for the video calling button */
#videoCallingBtn, #muteVideoBtn, #header button, #callControls button{
  background: none; 
  border: none;    
  padding: 10px;   
  cursor: pointer; 
  transition: transform 0.2s ease-in-out;
  margin-right: 2%;
}
#header *, #callControls *{
    color: white;
}

#muteVideoBtn:hover, #videoCallingBtn:hover, #header button:hover, #callControls button:hover{
  transform: scale(1.1); 
}

#videoCallingBtn .fa-video{
  color: #007bff; 
  font-size: 2em;  
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
            <?php if (isset($_GET['b'])) : ?>
                <?php $b = 'b'; ?>

                <button id="videoCallingBtn">
                    <i class="fas fa-duotone fa-video fa-2xl "></i>
                </button>


            <?php endif; ?>

            <div id="incomingCallModal" class="modal">
                <div class="modal-content">
                    <div class="callerInfo">
                        <img id="callerImg" src="" alt="">
                        <p id="callerName"> </p>
                    </div>
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
<style>
    /* Initial styling */
    /* .videoCallContainer * {
        border: solid 1px white;
    } */

    .videoCallContainer {
        /*display: none;*/
        visibility: hidden;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index: 2;
        /* Ensure it's on top */
    }

    .remoteVideoContainer {
        /* border: solid 1px red; */
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

    .localVideoContainer {
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

    #callControls #hangUpBtn i{
        color: red;
    }
    #callControls {
        position: absolute;
        bottom: 5%;
        left: 20%;
        z-index: 10;
        width: 100%;
    }

    #callingMsg p{
        /* font-weight: 500; */
        color: white;
        /* font: 1em; */
    }
    #callingMsg {
        display: none;
        position: absolute;
        bottom: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
    }

    /* Minimized styles (add these later) */
    .minimized {
        width: 25%;
        height: 25%;
        top: 37.5%;
        left: 37.5%;
        border-radius: 10px;
    }
    .local-minimized{
        position: absolute;
        bottom: 10%;
        right: 5%;
        width: 5vw;
        height: 5vw;
        border-radius: 50%;
        overflow: hidden;
        z-index: 10;
    }

    .circle {
        position:absolute ;
        width: 5vw;
        height: 5vw;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background:#721c24;
    }

    /* Header Styles */
    #header {
        display: flex;
        justify-content: flex-end;
        position: absolute;
        top: 0.5%;
        right: 0.5%;
        z-index: 10;
    }

    #header button {
        margin-left: 10px;
    }

     #uNmuteBtn, #circle, #maximizeBtn, #maximizeBtn, #maximizeBtn2 {
        display: none;
    }
</style>

<div id="videoCallContainer" class="videoCallContainer">

    <div id="header">
        <button id="minimizeBtn1"><i class="fas fa-window-minimize"></i></button>
        <button id="minimizeBtn2"><i class="fas fa-window-maximize"></i></button>
        <button id="maximizeBtn"><i class='fas fa-expand'></i></button>
    </div>

    <div id="remoteVideoContainer" class="remoteVideoContainer">
        <video id="remoteVideo" autoplay playsinline></video>
    </div>

    <div id="localVideoContainer" class="localVideoContainer">
        <video id="localVideo" autoplay playsinline muted></video>
    </div>
    <div id="callingMsg">
        <p>calling...</p>
    </div>

    <div id="callControls">
        <button id="muteVideoBtn"><i class="fas fa-video-slash"></i></i></button>
        <button id="muteBtn"><i class="fas fa-microphone-slash"></i></button>
        <button id="uNmuteBtn"><i class="fas fa-microphone"></i></button>
        <button id="hangUpBtn"><i class="fa fa-phone"></i>
</button>
    </div>
</div>
<div id="circle" class="circle">

</div>
<script> // video container 
    const videoCallContainer = document.getElementById("videoCallContainer");
    const localVideoContainer = document.getElementById("localVideoContainer");
    const remoteVideoContainer = document.getElementById("videoCallContainer");
    const minimizeBtn1 = document.getElementById("minimizeBtn1");
    const minimizeBtn2 = document.getElementById("minimizeBtn2");
    const maximizeBtn = document.getElementById("maximizeBtn");
    const circle = document.getElementById("circle");

    minimizeBtn2.addEventListener("click",()=>{
        videoCallContainer.classList.add("minimized");
        localVideoContainer.classList.add("local-minimized");
        minimizeBtn2.style.display = "none";
        maximizeBtn.style.display = "block";
    });

    maximizeBtn.addEventListener('click', ()=>{
        videoCallContainer.classList.remove("minimized");
        localVideoContainer.classList.remove("local-minimized");
        minimizeBtn2.style.display = "block";
        maximizeBtn.style.display = "none";
    });

    minimizeBtn1.addEventListener('click', ()=>{
        videoCallContainer.style.visibility = "hidden";
        circle.style.display = "block";
    });
    circle.addEventListener('click', ()=>{
        videoCallContainer.style.visibility = "visible";
        circle.style.display = "none";
    });


</script>



<!-- <script src="./Server/socket.io.min.js"></script>-->
<script src="https://cdn.socket.io/4.7.5/socket.io.min.js" integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO" crossorigin="anonymous"></script>

<script> // host and port
    const host = `https://${window.location.hostname}`;
    const port = 3000;
    // const socket = io.connect(`${host}:${port}`);
</script>
    <!--  this was for chat -->
<script>    // chat
    const outgoingID = document.querySelector('.outgoing_id').value;
    const incomingID = document.querySelector('.incoming_id').value;
    const roomId = [outgoingID, incomingID].sort().join('-');

    const chatNamespace = io.connect(`${host}:${port}/chat`,{ secure: true, rejectUnauthorized: false });
    
    chatNamespace.on('connect', () => {
        console.log('Connected to Socket.IO server chatNamespace');
    });
    chatNamespace.on('connect_error', (error) => {
        console.error('Connection error:', error);
    });
    chatNamespace.on('disconnect', () => {
        console.log('Disconnected from Socket.IO server chatnamespace');
    });
    chatNamespace.emit('get messages by user IDs', {
        outgoingID,
        incomingID
    });
    
    
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


</script>

<!-- this was for video calling  -->
<script>
    const videoCallingBtn = document.getElementById('videoCallingBtn');
    const incomingCallModal = document.getElementById('incomingCallModal');
    const callerName = document.getElementById('callerName');
    const callerImg = document.getElementById('callerImg');
    const acceptCallBtn = document.getElementById('acceptCallBtn');
    const callingMsg = document.querySelector('#callingMsg');
    const localVideoEl = document.querySelector('#localVideo');
    const remoteVideoEl = document.querySelector('#remoteVideo');
    const userName = document.getElementById('Fname').value + "-" + outgoingID;
    const Fname = document.getElementById('Fname').value
    const lname = document.getElementById('lname').value
    const img = document.getElementById('img').value

    // document.querySelector('#user-name').innerHTML = userName;

    const webRtcNamespace = io.connect(`${host}:${port}/webRtc`, { auth: { userName, roomId } });

    webRtcNamespace.on('connect', () => {
        console.log('Connected to Socket.IO server webRtcNamespace');
    });
    webRtcNamespace.on('connect_error', (error) => {
        console.error('Connection error:', error);
    });
    webRtcNamespace.on('disconnect', () => {
        console.log('Disconnected from Socket.IO server webRtcNamespace');
    });
    // ##########################################
    // ##########################################

    webRtcNamespace.emit('rtcRoom', roomId)

    // ##########################################
    // ##########################################



    let localStream; //a var to hold the local video stream
    let remoteStream; //a var to hold the remote video stream
    let peerConnection; //the peerConnection that the two clients use to talk
    let didIOffer = false;

    let peerConfiguration = {
        iceServers:[
            {
                urls:[
                'stun:stun.l.google.com:19302',
                'stun:stun1.l.google.com:19302'
                ]
            }
        ]
    }

    //when a client initiates a call
    const call = async e=>{
        await fetchUserMedia();
        console.log(e.message);
        console.log("call button clicked")
        //peerConnection is all set with our STUN servers sent over
        await createPeerConnection();

        //create offer time!
        try{
            console.log("Creating offer...")
            const offer = await peerConnection.createOffer();
            console.log(offer);
            peerConnection.setLocalDescription(offer);
            didIOffer = true;
            webRtcNamespace.emit('newOffer',offer, roomId); //send offer to signalingServer
            videoCallContainer.style.visibility = 'visible';
            callingMsg.style. display = 'block';

            webRtcNamespace.emit('calling',{ name: Fname + " "+ lname, img: `php/images/${img}`})

        }catch(err){
            console.log(err)
        }

    }

    const answerOffer = async(offerObj)=>{
        await fetchUserMedia()
        await createPeerConnection(offerObj);
        const answer = await peerConnection.createAnswer({}); //just to make the docs happy
        await peerConnection.setLocalDescription(answer); //this is CLIENT2, and CLIENT2 uses the answer as the localDesc
        console.log("offerObj: ", offerObj)
        console.log("answer: ", answer)
        // console.log(peerConnection.signalingState) //should be have-local-pranswer because CLIENT2 has set its local desc to it's answer (but it won't be)
        //add the answer to the offerObj so the server knows which offer this is related to
        offerObj.answer = answer 
        //emit the answer to the signaling server, so it can emit to CLIENT1
        //expect a response from the server with the already existing ICE candidates
        const offerIceCandidates = await webRtcNamespace.emitWithAck('newAnswer',offerObj)
        offerIceCandidates.forEach(c=>{
            peerConnection.addIceCandidate(c);
            console.log("======Added Ice Candidate======")
        })
        console.log("offerIceCandidates: " + offerIceCandidates)
    }

    const addAnswer = async(offerObj)=>{
        //addAnswer is called in socketListeners when an answerResponse is emitted.
        //at this point, the offer and answer have been exchanged!
        //now CLIENT1 needs to set the remote
        await peerConnection.setRemoteDescription(offerObj.answer)
        // console.log(peerConnection.signalingState)
    }

    const fetchUserMedia = ()=>{
        return new Promise(async(resolve, reject)=>{
            try{
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true,
                    // audio: true,
                });
                localVideoEl.srcObject = stream;
                localStream = stream;    
                resolve();    
            }catch(err){
                console.log(err);
                reject()
            }
        })
    }

    const createPeerConnection = (offerObj)=>{
        return new Promise(async(resolve, reject)=>{
            //RTCPeerConnection is the thing that creates the connection
            //we can pass a config object, and that config object can contain stun servers
            //which will fetch us ICE candidates
            peerConnection = await new RTCPeerConnection(peerConfiguration)
            remoteStream = new MediaStream()
            remoteVideoEl.srcObject = remoteStream;


            localStream.getTracks().forEach(track=>{
                //add localtracks so that they can be sent once the connection is established
                peerConnection.addTrack(track,localStream);
            })

            peerConnection.addEventListener("signalingstatechange", (event) => {
                console.log("signalingstatechange event ",event);
                console.log(peerConnection.signalingState)
            });

            peerConnection.addEventListener('icecandidate',e=>{
                console.log('........Ice candidate found!......')
                console.log("icecandidate", e)
                if(e.candidate){
                    webRtcNamespace.emit('sendIceCandidateToSignalingServer',{
                        iceCandidate: e.candidate,
                        iceUserName: userName,
                        didIOffer,
                    })    
                }
            })
            
            peerConnection.addEventListener('track',e=>{
                console.log("Got a track from the other peer!! How exiting")
                console.log("track e: ", e)
                e.streams[0].getTracks().forEach(track=>{
                    remoteStream.addTrack(track,remoteStream);
                    console.log("Here's an exciting moment... fingers cross")
                })
            })

            if(offerObj){
                //this won't be set when called from call();
                //will be set when we call from answerOffer()
                // console.log(peerConnection.signalingState) //should be stable because no setDesc has been run yet
                await peerConnection.setRemoteDescription(offerObj.offer)
                // console.log(peerConnection.signalingState) //should be have-remote-offer, because client2 has setRemoteDesc on the offer
            }
            resolve();
        })
    }

    const addNewIceCandidate = iceCandidate=>{
        peerConnection.addIceCandidate(iceCandidate)
        console.log("======Added Ice Candidate======")
    }

    videoCallingBtn.addEventListener('click', call)


    // ###########################################
    // ###########################################

    //on connection get all available offers and call createOfferEls
    // webRtcNamespace.on('availableOffers',offers=>{
    //     console.log("availableOffers ",offers)
    //     createOfferEls(offers)
    // })

    //someone just made a new offer and we're already here - call createOfferEls
    webRtcNamespace.on('newOfferAwaiting',offers=>{
        createOfferEls(offers)
    })

    webRtcNamespace.on('answerResponse',offerObj=>{
        console.log('answerResponse ',offerObj)
        addAnswer(offerObj)
    })

    webRtcNamespace.on('receivedIceCandidateFromServer',iceCandidate=>{
        addNewIceCandidate(iceCandidate)
        console.log('receivedIceCandidateFromServer ',iceCandidate)
    })

    function createOfferEls(offers){
        //make green answer button for this new offer
        // const answerEl = document.querySelector('#answer');
        
        offers.forEach(o=>{

            console.log('offers ',o);
            // s
                // const newOfferEl = document.createElement('div');
                // newOfferEl.innerHTML = `<button class="btn btn-success col-1">Answer ${o.offererUserName}</button>`

                // newOfferEl.addEventListener('click',()=>{

                //     answerOffer(o);

                //     videoCallContainer.style.visibility = 'visible';
                //     console.log("answer button clicked")
                //     webRtcNamespace.emit('answerBtnClicked', 'you know what are you doing')
                // });
                // answerEl.appendChild(newOfferEl);

            acceptCallBtn.addEventListener('click', () =>{
                answerOffer(o);
                videoCallContainer.style.visibility = 'visible';
                console.log("answer button clicked")
                webRtcNamespace.emit('answerBtnClicked', 'you know what are you doing')
                incomingCallModal.style.display = 'none';

            });
            webRtcNamespace.on('receivedCall', a => {
                incomingCallModal.style.display = 'block';
                callerName.textContent = a.name;
                callerImg.src = a.img;
            });

        })
    }
    webRtcNamespace.on('answerBtnClicked2', a => {
        console.log("sssssssssss",a)
        callingMsg.style. display = 'none';
    })
</script>

<script src="javascript/chat.js"> </script>