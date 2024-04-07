const form = document.querySelector(".typing-area"),
  b = form.querySelector(".b").value,
  inputField = form.querySelector(".input-field"),
  chatBox = document.querySelector(".chat-box"),
  sendBtn = form.querySelector("#sendBtn"),
  sendMic = form.querySelector("#sendMic"),
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
    audioDataUrl: "",
    roomId: [outgoing_id, incoming_id].sort().join("-"),
  });
};

// micButton.addEventListener("click", initFunction);
micButton.addEventListener("click", initializeRecorder);

let rec;
let audioChunks = [];
let internal;

// Function to initialize the audio recorder
function initializeRecorder() {
  audioChunks = []; // Reset audio chunks

  try {
    navigator.mediaDevices
      .getUserMedia({ audio: true })
      .then(handleAudioStream)
      .catch(handleGetUserMediaError);
  } catch (error) {
    console.error("Error accessing microphone:", error);
  }
}

function handleAudioStream(stream) {
  rec = new MediaRecorder(stream);
  rec.ondataavailable = handleAudioDataAvailable;
  rec.start();

  // Update UI for recording state
  sendMic.style.display = "block";
  stopButton.style.display = "block";
  micButton.style.display = "none";
  timeSpan.style.display = "block";
  isRecording.style.display = "block";
  inputField.style.display = "none";
  isRecording.textContent = "Recording...";
  sendBtn.style.display = "none";

  // Start the recording timer
  startTimer();
}

// Function to handle available audio data chunks
function handleAudioDataAvailable(event) {
  audioChunks.push(event.data);

  if (rec.state === "inactive") {
    const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
    audioElement.src = URL.createObjectURL(audioBlob);
    inputField.type = "audio";
    inputField.src = URL.createObjectURL(audioBlob);
  }
}

// Function to handle getUserMedia errors
function handleGetUserMediaError(error) {
  console.error("Microphone access error:", error);
}

// Function to start the recording timer
function startTimer() {
  let totalSeconds = 0;
  intervalId = setInterval(() => {
    totalSeconds++;
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    timeSpan.innerHTML = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
  }, 1000);
}

// Function to display an error message to the user (implementation depends on your UI)
function displayErrorMessage(message) {
  console.log(message);
}

// Event listener for the stop button
stopButton.addEventListener("click", () => {
  console.log("stopButton clicked");
  clearInterval(intervalId); // Stop the timer
  rec.stop(); // Stop the recording

  // Update UI elements
  stopButton.style.display = "none";
  micButton.style.display = "none"; // Keep mic button hidden
  audioElement.style.display = "block"; // Show audio playback element
  timeSpan.innerHTML = "";
  isRecording.style.display = "none";
  cRec.style.display = "block"; // Show cancel recording button
  sendMic.style.display = "block"; // Show send
});

// Sending audio data logic within sendMic.onclick
sendMic.onclick = () => {
  console.log("sendMic clicked");
  handleRecordingStop();
  if (rec) {
    if (rec.state !== "inactive") {
      clearInterval(intervalId);
      rec.stop();
    }
  }
};
// function to handle recording stop and send audio data
function handleRecordingStop() {
  if (rec.state === "inactive") {
    const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
    const timestamp = Date.now();
    const formData = new FormData();
    formData.append("audio", audioBlob, `audio_${timestamp}.mp3`);
    formData.append("incoming_id", incoming_id);
    formData.append("b", b);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          inputField.value = "";
          scrollToBottom();
        } else {
          console.error("Error sending audio:", xhr.statusText);
        }
      }
    };
    xhr.send(formData);

    // Reset UI elements
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

    socket.emit("formSubmission", {
      incomingId: incoming_id,
      outgoingId: outgoing_id,
      b: b,
      message: "",
      audioDataUrl: `audio_${timestamp}.mp3`,
      roomId: [outgoing_id, incoming_id].sort().join("-"),
    });

    audioChunks = [];
  }
}

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
