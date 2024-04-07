const form = document.querySelector(".typing-area"),
b = form.querySelector(".b").value,
inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("#sendBtn"),
    sendMic = form.querySelector("#sendMic"),
    chatBox = document.querySelector(".chat-box"),
    micButton = document.getElementById("mic"),
    stopButton = document.getElementById("stop"),
    audioElement = document.getElementById("audioElement"),
    timeSpan = document.getElementById("time"),
    isRecording = document.getElementById("isRecording"),
    cRec = document.getElementById("cRec"),
    incoming_id = form.querySelector(".incoming_id").value,
    outgoing_id = form.querySelector(".outgoing_id").value,
    formV = document.querySelector(".formV"), //new added for video
    videoCallingBtn = formV.querySelector("#videoCallingBtn");
    
    inputField.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
        sendBtn.click();
    }
});

cRec.onclick = () => {};

form.onsubmit = (e) => {
    e.preventDefault();
};

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
};

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}

inputField.focus();

let rec;
let audioChunks = [];
sendMic.classList.add("active");

inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
        micButton.style.display = "none";
    } else {
        sendBtn.classList.remove("active");
        micButton.style.display = "block";
    }
};

sendBtn.onclick = () => {
    console.log("sendBtn clicked");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
    micButton.style.display = "block";
    cRec.style.display = "none";
    sendBtn.classList.remove("active");
    // Get the message from the input field
    const message = document.getElementById("input-field").value;

    // Emit a Socket.IO event with the message data
    socket.emit("formSubmission", {
        incomingId: incoming_id,
        outgoingId: outgoing_id,
        b: b,
        message: message,
        audioDataUrl: '',
        roomId: [outgoing_id, incoming_id].sort().join('-')
    });
};


micButton.addEventListener("click", initFunction);
let intervalId;

function initFunction() {
    audioChunks = [];
    async function getUserMedia(constraints) {
        if (window.navigator.mediaDevices) {
            return window.navigator.mediaDevices.getUserMedia(constraints);
        }
        let legacyApi =
        navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia;
        if (legacyApi) {
            return new Promise(function (resolve, reject) {
            legacyApi.bind(window.navigator)(constraints, resolve, reject);
            });
        } else {
            alert("user api not supported");
        }
    }


    timeSpan.innerHTML = "";

    function handlerFunction(stream) {
        rec = new MediaRecorder(stream);
        rec.start();
        rec.ondataavailable = (e) => {
            audioChunks.push(e.data);
            if (rec.state == "inactive") {
                let blob = new Blob(audioChunks, { type: "audio/mp3" });
                console.log(blob);
                audioElement.src = URL.createObjectURL(blob);
                inputField.type = "audio";
                inputField.src = URL.createObjectURL(blob);
            }
        };

        sendMic.style.display = "block";
        stopButton.style.display = "block";
        micButton.style.display = "none";
        timeSpan.style.display = "block";
        isRecording.style.display = "block";
        inputField.style.display = "none";
        isRecording.textContent = "Recording...";
        sendBtn.style.display = "none";
        let totalSeconds = 0;

        intervalId = setInterval(function () {
            totalSeconds++;

            const minutes = Math.floor(totalSeconds / 60);
            const remainingSeconds = totalSeconds % 60;

            const formattedTime = `
                ${minutes.toString().padStart(2, "0")}:
                ${remainingSeconds.toString().padStart(2, "0")}
            `;
            timeSpan.innerHTML = formattedTime;
        }, 1000);

    }

    function startusingBrowserMicrophone(boolean) {
        getUserMedia({ audio: boolean })
            .then((stream) => {
                    handlerFunction(stream);    
                });
    }
    startusingBrowserMicrophone(true);

    stopButton.addEventListener("click", (e) => {
        console.log("stopButton clicked");
        clearInterval(intervalId);
        rec.stop();

        stopButton.style.display = "none";
        micButton.style.display = "none";
        audioElement.style.display = "block";
        timeSpan.innerHTML = "";
        isRecording.style.display = "none";
        cRec.style.display = "block";
    });
}

sendMic.onclick = () => {
    console.log("sendMic clicked");

    if (rec) { 
        clearInterval(intervalId); // Stop the timer
        rec.stop(); // Stop recording
    }
    // let audioBlob = new Blob(audioChunks, { type: "audio/mp3" });
    let audioBlob = new Blob(audioChunks, { type: "audio/wav" });
    let formData = new FormData();
    const timestamp = Date.now();
    formData.append("audio", audioBlob, `audio_${timestamp}.mp3`);
    // formData.append("audio", audioBlob, "audio.mp3");
    formData.append("incoming_id", incoming_id);
    formData.append("b", b);

    console.log(formData.audio)

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = "";
                scrollToBottom();
            }
        }
    };

    xhr.send(formData);
    
    stopButton.style.display = "none";
    micButton.style.display = "block";
    audioElement.style.display = "none";
    timeSpan.innerHTML = "";
    isRecording.style.display = "none";
    isRecording.textContent = "";
    inputField.style.display = "block";
    sendBtn.style.display = "block";
    sendMic.style.display = "none";
    cRec.style.display = "none";
    // ######################################
    socket.emit("formSubmission", {
        incomingId: incoming_id,
        outgoingId: outgoing_id,
        b: b,
        message: '',
        audioDataUrl: `audio_${timestamp}.mp3`,
        roomId: [outgoing_id, incoming_id].sort().join('-')
    });
    // ######################################
};


cRec.onclick = () => {
    stopButton.style.display = "none";
    micButton.style.display = "block";
    audioElement.style.display = "none";
    timeSpan.innerHTML = "";
    isRecording.style.display = "none";
    inputField.style.display = "block";
    cRec.style.display = "none";
    sendBtn.classList.remove("active");
    sendBtn.style.display = "block";
    sendMic.style.display = "none";
};
// new added for video call

// Vbtn.onclick = () => {
//   console.log("video call button clicked");
//   let xhr = new XMLHttpRequest();
//   xhr.open("POST", "php/insert-chat-video-call.php", true);
//   xhr.onload = () => {
//     if (xhr.readyState === XMLHttpRequest.DONE) {
//       if (xhr.status === 200) {
//         inputField.value = "";
//         scrollToBottom();
//       }
//     }
//   };
//   let formData = new FormData(formV);
//   xhr.send(formData);
// }

