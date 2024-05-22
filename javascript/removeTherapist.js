document.addEventListener("DOMContentLoaded", () => {
  const errorText = document.querySelector(".e-t");

  setInterval(() => {
    const removeButtons = document.querySelectorAll(".users-list button");

    console.log("removeButtons");
    console.log(removeButtons);

    removeButtons.forEach((button) => {
      button.addEventListener("click", (event) => {
        const therapistId = button.getAttribute("data-id");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/removeTherapist.php", true);

        xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              let data = xhr.responseText.trim();

              if (data === "success") {
                errorText.textContent = "Therapist removed successfully";
                errorText.style.display = "block";
                errorText.style.color = "green";

                setTimeout(() => {
                  errorText.style.display = "none";
                }, 3000);

                chatNamespace.emit("add remove therapist", "remove therapist");
              } else {
                errorText.style.display = "block";
                errorText.style.color = "red";
                errorText.textContent = data;
                console.error(data);
              }
            }
          }
        };

        let formData = new FormData();
        formData.append("therapist_id", therapistId);
        xhr.send(formData);
      });
    });
  }, 2500);
});
