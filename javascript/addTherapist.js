// for searching
const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");

searchIcon.onclick = ()=>{
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if(searchBar.classList.contains("active")){
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}
// Function to handle search for a specific section
function handleSearch(searchInputId, usersListId) {
  const searchBar = document.getElementById(searchInputId);
  const usersList = document.getElementById(usersListId);

  searchBar.onkeyup = () => {
    let searchTerm = searchBar.value.trim(); // Trim whitespace

    // Show/hide search active class based on searchTerm
    searchBar.classList.toggle("active", searchTerm !== ""); 

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/searchForAdmin.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        let data = xhr.response;
        usersList.innerHTML = data; 
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm + "&whereToSearch=" + usersListId); 
  };
}
handleSearch("search-online-clients", "online-clients-list");
handleSearch("search-all-clients", "all-clients-list");
handleSearch("search-online-therapist", "online-therapist-list");
handleSearch("search-all-therapist", "all-therapist-list");

handleSearch("search-all-schedules", "all-schedules-list");
handleSearch("search-all-therapist-remove", "all-therapist-list-remove");


// form submission
const form = document.querySelector(".add-therapist form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/addTherapist.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                errorText.style.display = "block";
                errorText.style.color = "green";
                errorText.style.backgroundColor = "white";
                errorText.style.border='none';
                errorText.textContent = "Therapist added successfully";
                setTimeout(() => {errorText.style.display = "none";}, 2000);
                form.reset(); 

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