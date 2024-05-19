<footer>
    <div>
        <a href="index.php">
            <img src="img/logo.png" alt="" style="width: 50px;">
            <h3>Therapy Now</h3>
        </a>
    </div>
    <div class="one">
        <!-- <h3><a href="index.php">Home</a></h3> -->
        <!-- <h3><a href="blog.php">Blog</a></h3> -->
        <!-- <h3><a href="users.php">chat</a></h3>
        <h3><a href="profile.php">Dr.</a></h3> -->
        <h3><a href="about.php">About Us</a></h3>
        <h3><a href="Terms&Conditions.php">Terms and Conditions</a></h3>

    </div>
    <div class="two">
        <h3><a href="contact.php
        ">Contact Us</a></h3>
        <p><i class="fas fa-phone"></i> +1 251 567 890</p>
        <p><i class="fas fa-envelope"></i> info@onlinetherapy.com</p>
    </div>
    <div class="three">
        <h3>Follow Us</h3>
        <ul class="social-icons">
            <li><a target="_blank" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
            <li><a target="_blank" href="https://twitter.com/">                    <i class="fas fa-times"></i>
                </a></li>
            <li><a target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
    </div>
    <div class="four">
        <p class="copy">© 2023 Online Therapy. All rights reserved.</p>
    </div>
</footer>
<script src="javascript/webRtc.js"> </script>

<script>
    const countOnlineTherapist = document.getElementById("count-Online-therapist")
const countAllTherapist = document.getElementById("count-all-therapist")
const countOnlineClients = document.getElementById("count-online-clients")
const countAllClients = document.getElementById("count-all-clients")

const allTherapistList = document.getElementById("all-therapist-list")
const allClientsList = document.getElementById("all-clients-list")

const removeContainer = document.getElementById('therapist-remove-t')
console.log(removeContainer)


chatNamespace.on("counting therapist", (count) => {
  countAllTherapist.textContent = count;
});

chatNamespace.on("online Therapists", (count) => {
  countOnlineTherapist.textContent = count;
  console.log("online Therapist", count);
});

chatNamespace.on("online clients", (count) => {
  countOnlineClients.textContent = count;
  console.log("online clients", count);

});

chatNamespace.on("list therapist", (a) => {
  allTherapistList.innerHTML = a;


});
chatNamespace.on("therapist list for remove", (a) => {
    console.log("getting therapist remove lists")
    removeContainer.innerHTML = a;
    console.log(removeContainer)

  });
  
</script>