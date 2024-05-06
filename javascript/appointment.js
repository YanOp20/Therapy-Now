const appointmentForm = document.querySelector(".app-form"),
  continueBtn = appointmentForm.querySelector(".submit"),
  appointmentSuccessMessage = appointmentForm.querySelector(
    ".appointment-success"
  ),
  errorText = appointmentForm.querySelector(".error-text"),
  dateInput = appointmentForm.querySelector("#date"),
  timeInput = appointmentForm.querySelector("#time");

appointmentForm.onsubmit = (e) => {
  e.preventDefault();
};

//
window.onload = function () {
  // your JS code here
  let dates = new Date();

  for (var i = 0; i < dates.length; i++) {
    var dateValue = dates[i]["date"];
    var timeValue = dates[i]["start_time"];
    console.log(dateValue, timeValue);
    if (dateValue == dateInput.value) {
      for (var j = 0; j < timeInput.options.length; j++) {
        var optionValue = timeInput.options[j].value;

        if (optionValue == timeValue) {
          timeInput.options[j].setAttribute("disabled", true);
        }
      }
    }
  }
};

// Function to convert 24-hour time format to 12-hour format with AM/PM
function formatTime(hours, minutes) {
  const period = hours >= 12 ? "PM" : "AM";
  hours = hours % 12 || 12;
  return `${String(hours).padStart(2, "0")}:${String(minutes).padStart(2, "0")} ${period}`;
}

// Function to add 45 minutes to a given time
function add45Minutes(time) {
  let [hours, minutes] = time.split(":").map(Number);
  minutes += 45;
  hours += Math.floor(minutes / 60);
  minutes %= 60;
  hours %= 24;
  return { hours, minutes };
}
// Function to convert 24-hour time format to 12-hour format with AM/PM
function FormatTime(hours, minutes) {
  const period = hours >= 12 ? "PM" : "AM";
  hours = hours % 12 || 12; // Convert hours to 12-hour format
  return `${String(hours).padStart(2, "0")}:${String(minutes).padStart(2, "0")} ${period}`;
}
//

continueBtn.onclick = () => {
  console.log(dateInput.value, timeInput.value);
  // Get the input time value
  // let [h, m] = timeInput.value.split(":").map(Number);
  const inputTime = timeInput.value;

  // Parse the input time and convert it to 24-hour format
  let [inputHours, inputMinutes] = inputTime.split(":").map(Number);
  const start_time = FormatTime(inputHours, inputMinutes);

  // const start_time = timeInput.value
  // Add 45 minutes to the input time
  const { hours, minutes } = add45Minutes(inputTime);

  // Convert the updated time to 12-hour format with AM/PM
  const formattedTime = formatTime(hours, minutes);
  console.log("sssssssssssss", start_time + " - " + formattedTime);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-appointment.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success") {
          document.querySelector(".app-form .form").style.display = "none";
          document.querySelector("#payment").style.visibility = "visible";
          document.querySelector("#p-date").textContent = dateInput.value;
          document.querySelector("#p-time").textContent = start_time + " - " + formattedTime;

          document.getElementById("processToPayButton").addEventListener("click", () => {

              document.querySelector("#payment").style.display = "none";
              document.getElementById("processPayment").style.visibility ="visible";
              appointmentSuccessMessage.textContent = "Success appointment";
              
              document.querySelector(".payment-code").textContent =  Math.floor(100000 + Math.random() * 900000);

              // location.href = "profile.php?link=appointment";
              setTimeout(() => {  location.href = "profile.php?link=appointment";}, 50000);
            });
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  };
  let formData = new FormData(appointmentForm);
  xhr.send(formData);
};
