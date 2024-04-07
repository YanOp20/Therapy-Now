const appointmentForm = document.querySelector(".app-form"),
  continueBtn = appointmentForm.querySelector(".submit"),
  appointmentSuccessMessage = appointmentForm.querySelector(".appointment-success"),
  errorText = appointmentForm.querySelector(".error-text"),
  dateInput = appointmentForm.querySelector("#date"),
  timeInput = appointmentForm.querySelector("#time");

appointmentForm.onsubmit = (e) => {
  e.preventDefault();
};

//
window.onload = function() {
  // your JS code here

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


//

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-appointment.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success") {
          appointmentSuccessMessage.innerHTML = "Success appointment";
          location.href = "profile.php?link=appointment";
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