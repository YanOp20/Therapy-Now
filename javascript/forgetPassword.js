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
        let data = JSON.parse(xhr.response); 

        if (data.message === "success") {

          location.href = "profile.php";

        } else if (data.message === "email") {



          errorText.style.display = "none";

          inputHeader.textContent = "Enter your new password ";

          emailInput.innerHTML = `
          <div class="user-email">
                    <img src="php/images/${data.img}" alt="" srcset="">
                    <p>${data.first_name}  ${data.last_name}</p>
                </div>`;

          passwordField.innerHTML = `<div class="field input">
                                      <label>Password</label>
                                      <input id="pswrdField" type="password" name="password" placeholder="Enter your password" required>
                                      <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="field input">
                                      <label>Conform Password</label>
                                      <input id="pswrdField" type="password" name="c-password" placeholder="Enter your conform password" required>
                                      <i class="fas fa-eye"></i>
                                    </div>
                  `;
          continueBtn.value = "change password";


          let pswrdFields = document.querySelectorAll(".form input[type='password']");
          let toggleIcons = document.querySelectorAll(".form .field i");
          
          toggleIcons.forEach((toggleIcon, index) => {
              toggleIcon.onclick = () => {
                  if(pswrdFields[index].type === "password"){
                      pswrdFields[index].type = "text";
                      toggleIcon.classList.add("active");
                  } else {
                      pswrdFields[index].type = "password";
                      toggleIcon.classList.remove("active");
                  }
              }
          });       



        } else {
          errorText.style.display = "block";
          errorText.textContent = data.message;
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
