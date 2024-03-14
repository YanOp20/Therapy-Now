const form = document.querySelector(".typing-area"),
  incoming_id = form.querySelector(".incoming_id").value,
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
  cRec = document.getElementById("cRec");

inputField.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    sendBtn.click();
  }
});

cRec.onclick = () => {};

form.onsubmit = (e) => {
  e.preventDefault();
};

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
  console.log("sendMic clicked");
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

    const formattedTime = `${minutes
      .toString()
      .padStart(2, "0")}:${remainingSeconds.toString().padStart(2, "0")}`;
    timeSpan.innerHTML = formattedTime;
  }, 1000);

  timeSpan.innerHTML = "";
  function handlerFunction(stream) {
    rec = new MediaRecorder(stream);
    rec.start();
    rec.ondataavailable = (e) => {
      audioChunks.push(e.data);
      if (rec.state == "inactive") {
        // let blob = new Blob(audioChunks, { type: "audio/mp3" });
        let blob = new Blob(audioChunks, { type: "audio/mp3" });
        console.log(blob);
        audioElement.src = URL.createObjectURL(blob);
        inputField.type = "audio";
        inputField.src = URL.createObjectURL(blob);
      }
    };
  }

  function startusingBrowserMicrophone(boolean) {
    getUserMedia({ audio: boolean }).then((stream) => {
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
    clearInterval(intervalId);
    rec.stop();
  }
  // let audioBlob = new Blob(audioChunks, { type: "audio/mp3" });
  let audioBlob = new Blob(audioChunks, { type: "audio/wav" });

  let formData = new FormData();
  formData.append("audio", audioBlob, "audio.mp3");
  formData.append("incoming_id", incoming_id);
  formData.append("b", b);

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

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) {
          scrollToBottom();
        }
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("incoming_id=" + incoming_id);
}, 500);

