const form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".button input"),
  inputHeader = document.querySelector(".input-header"),
  emailInput = document.querySelector(".email-input"),
  userEmail = document.querySelector(".user-email"),
  passwordField = document.querySelector("#password-field"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault();
};

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/forgetPassword.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = JSON.parse(xhr.response); // Parse the JSON response

        if (data.message === "success") {
          // Check if message is 'success'
          location.href = "profile.php";
        } else if (data.message === "email") {

          inputHeader.textContent = "Enter your new password ";
          emailInput.innerHTML = `
          <div class="user-email">
                    <img src="php/images/${data.img}" alt="" srcset="">
                    <p>${data.first_name}  ${data.last_name}</p>
                </div>`;
          passwordField.innerHTML = `<div class="field input">
                                      <label>Password</label>
                                      <input type="password" name="password" placeholder="Enter your password" required>
                                      <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="field input">
                                      <label>Conform Password</label>
                                      <input type="password" name="c-password" placeholder="Enter your conform password" required>
                                      <i class="fas fa-eye"></i>
                                    </div>
                  `;
          continueBtn.value = "change password";
        } else {
          errorText.style.display = "block";
          errorText.textContent = data.message; // Display the message
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
