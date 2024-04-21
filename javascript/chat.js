const form = document.querySelector(".typing-area"),
  b = form.querySelector(".b").value,
  inputField = form.querySelector(".input-field"),
  chatBox = document.querySelector(".chat-box"),
  sendTextButton = form.querySelector("#sendBtn"),
  sendAudioButton = form.querySelector("#sendMic"),
  recordButton = document.getElementById("mic"),
  stopRecordingButton = document.getElementById("stop"),
  audioElement = document.getElementById("audioElement"),
  timeSpan = document.getElementById("time"),
  isRecording = document.getElementById("isRecording"),
  cancelRecordingButton = document.getElementById("cRec"),
  incoming_id = form.querySelector(".incoming_id").value,
  outgoing_id = form.querySelector(".outgoing_id").value;
  // formV = document.querySelector(".formV"), //new added for video
  // videoCallingBtn = document.getElementById("videoCallingBtn");

inputField.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    sendTextButton.click();
  }
});

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

sendAudioButton.classList.add("active");

inputField.onkeyup = () => {
  if (inputField.value != "") {
    sendTextButton.classList.add("active");
    recordButton.style.display = "none";
  } else {
    sendTextButton.classList.remove("active");
    recordButton.style.display = "block";
  }
};

sendTextButton.onclick = () => {
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
  manageUI("send text");
  // Get the message from the input field
  const message = document.getElementById("input-field").value;

  // Emit a Socket.IO event with the message data
  chatNamespace.emit("formSubmission", {
    incomingId: incoming_id,
    outgoingId: outgoing_id,
    b: b,
    message: message,
    audioDataUrl: "",
    roomId: [outgoing_id, incoming_id].sort().join("-"),
  });
};

recordButton.addEventListener("click", initializeRecorder);

let rec;
let audioChunks = [];
let internal;

// Function to initialize the audio recorder
async function initializeRecorder() {
  audioChunks = []; // Reset audio chunks

  try {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    handleAudioStream(stream);
  } catch (error) {
    console.error("Error accessing microphone:", error);
  }
}

function handleAudioStream(stream) {
  rec = new MediaRecorder(stream);
  rec.ondataavailable = handleAudioDataAvailable;
  rec.start();

  // Update UI for recording state recordButton
  manageUI("start recording");
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
    timeSpan.textContent = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
  }, 1000);
}

// Function to initialize the audio recorder
async function initializeRecorder() {
  audioChunks = []; // Reset audio chunks

  try {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    handleAudioStream(stream);
  } catch (error) {
    console.error("Error accessing microphone:", error);
  }
}

async function handleRecordingStop() {
  if (rec.state === "inactive") {
    const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
    const timestamp = Date.now();
    const formData = new FormData();
    formData.append("audio", audioBlob, `audio_${timestamp}.mp3`);
    formData.append("incoming_id", incoming_id);
    formData.append("b", b);

    try {
      const response = await fetch("php/insert-chat.php", {
        method: "POST",
        body: formData,
      });

      if (response.ok) {
        inputField.value = "";
        scrollToBottom();
      } else {
        console.error("Error sending audio:", response.statusText);
      }
    } catch (error) {
      console.error("Error sending audio:", error);
    }

    manageUI("send recording");

    chatNamespace.emit("formSubmission", {
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

// Function to display an error message to the user (implementation depends on your UI)
function displayErrorMessage(message) {
  console.log(message);
}

// Event listener for the stop button
stopRecordingButton.addEventListener("click", () => {
  console.log("stopRecordingButton clicked");
  clearInterval(intervalId); // Stop the timer
  rec.stop(); // Stop the recording

  // Update UI elements stopRecordingButton
  manageUI("stop recording");
});

// Sending audio data logic within sendAudioButton.onclick
sendAudioButton.addEventListener("click", () => {
  console.log("sendAudioButton clicked");
  handleRecordingStop();
  if (rec) {
    if (rec.state !== "inactive") {
      clearInterval(intervalId);
      rec.stop();
    }
  }
});


function manageUI(state) {
  const show = (element) => (element.style.display = "block");
  const hide = (element) => (element.style.display = "none");

  switch (state) {
    case "send text":
      show(recordButton);
      hide(cancelRecordingButton);
      sendTextButton.classList.remove("active");
      break;
    case "start recording":
      show(sendAudioButton);
      show(stopRecordingButton);
      hide(recordButton);
      show(timeSpan);
      show(isRecording);
      hide(inputField);
      isRecording.textContent = "Recording...";
      hide(sendTextButton);
      break;
    case "stop recording":
      hide(stopRecordingButton);
      hide(recordButton);
      show(audioElement);
      timeSpan.textContent = "";
      hide(isRecording);
      show(cancelRecordingButton);
      show(sendAudioButton);
      break;
    case "send recording":
      hide(stopRecordingButton);
      show(recordButton);
      hide(audioElement);
      timeSpan.textContent = "";
      hide(isRecording);
      isRecording.textContent = "";
      show(inputField);
      show(sendTextButton);
      hide(sendAudioButton);
      hide(cancelRecordingButton);
      break;
    case "Cancel recording":
      hide(stopRecordingButton);
      show(recordButton);
      hide(audioElement);
      timeSpan.textContent = "";
      hide(isRecording);
      show(inputField);
      hide(cancelRecordingButton);
      sendTextButton.classList.remove("active");
      show(sendTextButton);
      hide(sendAudioButton);
      break;
    default:
      console.error("Invalid UI state:", state);
  }
}

// Function to display an error message (update as needed for your UI)
function displayErrorMessage(message) {
  // Example: Display error message in a designated area on the page
  const errorContainer = document.getElementById("error-message");
  errorContainer.textContent = message;
  errorContainer.style.display = "block";

  // Optionally, you can hide the error message after a timeout
  setTimeout(() => {
    errorContainer.style.display = "none";
  }, 5000); // Adjust timeout as needed
}

cancelRecordingButton.onclick = () => manageUI("Cancel recording");

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

// @@@@@@@@@@@@@@@@@@@@@@@################!!!!!!!!!!!!!!!
// @@@@@@@@@@@@@@@@@@@@@@@################!!!!!!!!!!!!!!!
// @@@@@@@@@@@@@@@@@@@@@@@################!!!!!!!!!!!!!!!
// @@@@@@@@@@@@@@@@@@@@@@@################!!!!!!!!!!!!!!!
