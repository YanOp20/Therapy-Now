const contactForm = document.querySelector(".app-form"),
  continueBtn = contactForm.querySelector(".submit"),
  success = contactForm.querySelector(".contact-success");
contactForm.onsubmit = (e) => {
  e.preventDefault();
};

form.onsubmit = (e)=>{
  e.preventDefault();
}

continueBtn.onclick = ()=>{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/contact.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            if(data === "success"){
              success.textContent = "thanks for your message";
              success.style.color = "green";
              setTimeout(() => {location.href ="contact.php"}, 5000);
            }else{
              errorText.style.display = "block";
              errorText.textContent = data;
            }
        }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}