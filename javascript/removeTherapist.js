document.addEventListener("DOMContentLoaded", () => {
    const removeButtons = document.querySelectorAll(".users-list button[type='submit']");
    const errorText = document.querySelector(".e-t");

    
    if (!errorText) {
        console.error("Error: .error-text element not found in the DOM.");
        return;
    }

    removeButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            
            
            const formR = this.closest("form");
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/removeTherapist.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.responseText.trim(); // Ensure to use responseText and trim any whitespace
                        if (data === "success") {

                            errorText.textContent = "Therapist removed successfully";
                            errorText.style.display = "block";
                            errorText.style.color = "green";
                            
                            setTimeout(() => { errorText.style.display = "none"}, 3000);

                            
                            chatNamespace.emit("add remove therapist", "remove therapist")                

                        } else {
                            errorText.style.display = "block";
                            errorText.style.color = "red";
                            errorText.textContent = data;
                            console.error(data); // Log error message to console for debugging
                        }
                    }
                }
            };

            let formData = new FormData(formR);
            xhr.send(formData);
        });
    });
});

