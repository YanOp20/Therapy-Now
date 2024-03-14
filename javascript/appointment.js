const form = document.querySelector(".app-form"),
  continueBtn = form.querySelector(".submit"),
  app_s = form.querySelector(".appointment-success"),
  errorText = form.querySelector(".error-text"),
  dateInput = form.querySelector("#date"),
  timeInput = form.querySelector("#time");

form.onsubmit = (e) => {
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
          app_s.innerHTML = "Success appointment";
          location.href = "profile.php?link=appointment";
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
