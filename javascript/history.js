const hisform = document.querySelector(".hisform"),
  continueBtn = form.querySelector(".submit"),
  hisBox = document.querySelector(".history"),
  showHis = document.querySelector(".showHis"),
  hideHis = document.querySelector(".hideHis"),
  user_id = document.querySelector(".user_id").value,
  addHis = document.querySelector(".addHis");


form.onsubmit = (e) => {
  e.preventDefault();
};


showHis.addEventListener("click", () => {
  hideHis.style.display = "block";
  showHis.style.display = "none";
  hisBox.style.display = "block";
  hisform.style.display = "none";
  hisBox.scrollTop = hisBox.scrollHeight;
});
addHis.addEventListener("click", () => {
  hisform.style.display = "block";
  hisBox.style.display = "none";
});
hideHis.addEventListener("click", () => {
  hideHis.style.display = "none";
  hisform.style.display = "none";
  hisBox.style.display = "none";
  showHis.style.display = "block";
});


continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-history.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success") {
          location.href = "profile.php?user_id="+user_id+"&link=user_profile";
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

// console.log("profile.php?user_id="+1231+"&link=user_profile");