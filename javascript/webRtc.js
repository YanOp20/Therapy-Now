    const videoCallingBtn = document.getElementById('videoCallingBtn');
    const incomingCallModal = document.getElementById('incomingCallModal');
    const callerName = document.getElementById('callerName');
    const callerImg = document.getElementById('callerImg');
    const acceptCallBtn = document.getElementById('acceptCallBtn');
    const declineCallBtn = document.getElementById('declineCallBtn');
    const hangUpBtn = document.getElementById('hangUpBtn');
    const callingMsg = document.querySelector('#callingMsg');
    const localVideoEl = document.querySelector('#localVideo');
    const remoteVideoEl = document.querySelector('#remoteVideo');
    const userName = document.getElementById('Fname').value + "-" + outgoingID;
    const Fname = document.getElementById('Fname').value;
    const lname = document.getElementById('lname').value;
    const img = document.getElementById('img').value;


    const webRtcNamespace = io.connect(`${host}:${port}/webRtc`, { auth: { userName, roomId } });

    webRtcNamespace.on('connect', console.log('Connected to Socket.IO server webRtcNamespace'));
    webRtcNamespace.on('connect_error', error => console.error('Connection error:', error) );
    webRtcNamespace.on('disconnect', console.log('Disconnected from Socket.IO server webRtcNamespace'));
    
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

    webRtcNamespace.emit('rtcRoom', roomId)

    const call = async e => {

        await fetchUserMedia();
        console.log(e.message);
        console.log("call button clicked")
        //peerConnection is all set with our STUN servers sent over
        await createPeerConnection();

        //create offer time!
        try {
            console.log("Creating offer...")
            const offer = await peerConnection.createOffer();
            console.log(offer);
            peerConnection.setLocalDescription(offer);
            didIOffer = true;
            webRtcNamespace.emit('newOffer', offer, roomId); //send offer to signalingServer
            videoCallContainer.style.visibility = 'visible';
            callingMsg.style.display = 'block';

            webRtcNamespace.emit('calling', {
                name: Fname + " " + lname,
                img: `php/images/${img}`
            })

        } catch (err) {
            console.log(err)
        }

    }

    const answerOffer = async (offerObj) => {
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
        const offerIceCandidates = await webRtcNamespace.emitWithAck('newAnswer', offerObj)
        offerIceCandidates.forEach(c => {
            peerConnection.addIceCandidate(c);
            console.log("======Added Ice Candidate======")
        })
        console.log("offerIceCandidates: " + offerIceCandidates)
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
                    audio: false,
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
                console.log("signalingstatechange event ", event);
                console.log(peerConnection.signalingState)
            });

            peerConnection.addEventListener('icecandidate', e => {
                console.log('........Ice candidate found!......')
                console.log("icecandidate", e)
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
                console.log("track e: ", e)
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

    videoCallingBtn.addEventListener('click', call)


    // ###########################################
    // ###########################################

    //on connection get all available offers and call createOfferEls
    // webRtcNamespace.on('availableOffers',offers=>{
    //     console.log("availableOffers ",offers)
    //     createOfferEls(offers)
    // })

    //someone just made a new offer and we're already here - call createOfferEls
    webRtcNamespace.on('newOfferAwaiting', offers => {
        createOfferEls(offers)
    })

    webRtcNamespace.on('answerResponse', offerObj => {
        console.log('answerResponse ', offerObj)
        addAnswer(offerObj)
    })

    webRtcNamespace.on('receivedIceCandidateFromServer', iceCandidate => {
        addNewIceCandidate(iceCandidate)
        console.log('receivedIceCandidateFromServer ', iceCandidate)
    })

    function createOfferEls(offers) {
        //make green answer button for this new offer
        // const answerEl = document.querySelector('#answer');

        offers.forEach(o => {

            console.log('offers ', o);
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

            acceptCallBtn.addEventListener('click', () => {
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
        console.log("sssssssssss", a)
        callingMsg.style.display = 'none';
    })



    let callerSocketId = null;


    // ... (Your existing code to get DOM elements, userName, roomId, etc.) ...

// Function to handle ending a call (from hang up or decline)
const endCall = (reason) => { 
    console.log(reason); 
    if (peerConnection) {
        peerConnection.close();
        peerConnection = null;
        webRtcNamespace.emit('userDisconnected', roomId, callerSocketId); 
    }
    localStream?.getTracks().forEach(track => track.stop());
    localVideoEl.srcObject = null;
    remoteVideoEl.srcObject = null;
    videoCallContainer.style.visibility = 'hidden';
    callingMsg.style.display = 'none'; 
};

// Event Listeners for Decline and Hang Up
declineCallBtn.addEventListener('click', () => {
    webRtcNamespace.emit('declineCall', { userName, roomId, callerSocketId });
    incomingCallModal.style.display = 'none';
    endCall('Call declined'); // End the call after declining
});

hangUpBtn.addEventListener('click', () => endCall('Hanging up call'));

// Handle 'callEnded' event (when other user ends call)
webRtcNamespace.on('callEnded', () => endCall('Call ended'));

// ... (Your existing WebRTC logic - fetchUserMedia, createPeerConnection, etc.) 

// Handle receiving an incoming call 
webRtcNamespace.on('receivedCall', (callData) => {
    callerSocketId = callData.socketId;
    // ... (Your code to display the incoming call modal) ...
});



// Function to handle mute/unmute video
let videoMuted = false;
muteVideoBtn.addEventListener('click', () => {
    videoMuted = !videoMuted;
    localStream.getVideoTracks()[0].enabled = !videoMuted; // Toggle video track 
    muteVideoBtn.innerHTML = videoMuted 
        ? '<i class="fas fa-video"></i>' 
        : '<i class="fas fa-video-slash"></i>'; // Update button icon
});


const muteBtn = document.getElementById('muteBtn');
let audioMuted = false; // Start with audio unmuted

// Function to handle mute/unmute audio
muteBtn.addEventListener('click', () => {
    audioMuted = !audioMuted; // Toggle mute state
    localStream.getAudioTracks()[0].enabled = !audioMuted; 
    muteBtn.innerHTML = audioMuted 
        ? '<i class="fas fa-microphone-slash"></i>' // Muted icon
        : '<i class="fas fa-microphone"></i>';    // Unmuted icon
});
