<?php
require_once 'head.php';

session_start();
require_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
} else {
  $outgoing_id = $_SESSION['unique_id'];
}
require_once "php/config.php";
require_once "php/feachToDisplayData.php";

?>
<style>
  .right-section>div {
    display: none;
  }

  .admin {
    display: flex;
    gap: 1em;
  }

  .admin .left-section {
    display: flex;
    flex-direction: row;
    gap: 3em;
  }
</style>
<!-- comes form goo -->
<style>
  /* General Styles */
  /* body {
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
  } */

  .admin {
    display: flex;
    min-height: 80vh;
    width: 100vw;
    padding: 20px;
    justify-content: center;
  }

  /* Left Section */
  .admin .left-section {
    width: max-content;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-right: 20px;
    flex-wrap: wrap;
  }

  .admin .left-section h2 {
    margin-bottom: 20px;
    color: #333;
  }

  .admin .row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }


  .admin .row span {
    font-size: 16px;
    color: #555;
    width: 200px;
  }

  .admin .row span.count-number {
    width: 50px !important;

  }

  .admin .count-number {
    font-weight: bold;
    color: #007bff;
  }

  .admin .button button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .admin .remove-therapist .remove-button {
    width: 100%;
  }

  .admin .remove-therapist .users-list p {
    white-space: nowrap;
  }

  .admin .remove-therapist form button {
    padding: 8px;
    background-color: red;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  /* Show Button Styles */
  .left-section .row button {
    padding: 8px 16px;
    background-color: #007bff;
    /* Blue background color */
    color: #fff;
    /* White text color */
    border: none;
    /* Remove border */
    border-radius: 5px;
    /* Rounded corners */
    cursor: pointer;
    /* Change cursor to pointer on hover */
    font-size: 14px;
    /* Adjust font size as needed */
    transition: background-color 0.3s ease;
    /* Smooth transition for hover effect */
  }

  /* Hover Effect */
  .left-section .row button:hover {
    background-color: #0056b3;
    /* Darker blue on hover */
  }

  /* Optional: Disabled State */
  .left-section .row button[disabled] {
    background-color: #ccc;
    /* Grayed out background */
    cursor: not-allowed;
    /* Disable pointer cursor */
  }

  /* Right Section */
  .right-section {
    width: 75%;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: none;
  }

  .show {
    display: none;
    /* Initially hide all right sections */
    padding: 20px;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }

  .right-section h2 {
    margin-bottom: 20px;
    color: #333;
  }

  .search {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .search input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
    width: 100%;
  }

  .search button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
  }

  .users-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .users-list .row-schedule {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
  }

  .users-list div {
    width: calc(25% - 10px);
    /* Adjust width for 4 items per row */
    margin-bottom: 10px;
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    min-width: 200px;
  }

  .users-list img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
  }

  .users-list p {
    margin: 0;
    font-size: 14px;
    color: #333;
  }

  /* Add Therapist Form */
  .add-therapist {
    display: flex;
    max-width: 600px;
    justify-content: space-between;
  }

  .add-therapist form {
    display: flex;
    flex-direction: column;
  }

  .add-therapist .error-text {
    color: red;
    margin-bottom: 10px;
  }

  .add-therapist .field {
    margin-bottom: 15px;
  }

  .add-therapist label {
    margin-bottom: 5px;
    font-weight: bold;
  }

  .add-therapist input,
  .add-therapist select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
  }

  .add-therapist .field input[type="password"] {
    position: relative;
  }

  .add-therapist .field input[type="password"] i {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
  }

  .add-therapist .field button {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .add-therapist .name-details {
    display: flex;
  }

  .add-therapist .name-details .field {
    margin-right: 10px;
    width: calc(50% - 15px);
  }

  .add-therapist .gender_and_birthdate {
    display: flex;
  }

  .add-therapist .gender_and_birthdate .field {
    margin-right: 10px;
    width: calc(50% - 15px);
  }

  .add-therapist .gender_and_birthdate .gender select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
  }


  /* .remove-therapist div.therapist div{
      width:400px;
    }  */
  .remove-therapist div.therapist {
    display: flex;
    align-items: center;

    flex-wrap: wrap;
    width: auto;
    /* flex-direction: column; */
  }

  .remove-therapist .search {
    margin-bottom: 10px;
  }

  .remove-therapist .e-t {
    color: red;
    margin-bottom: 10px;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .admin {
      flex-direction: column;
    }

    .admin .left-section {
      width: 100%;
      margin-bottom: 20px;
    }

    .admin .right-section {
      width: 100%;
    }

    .admin .users-list div {
      width: calc(50% - 10px);
      /* Adjust width for 2 items per row */
    }
  }
</style>

<style>
  .admin .right-section .admin .search button.active {
    background: #333;
    color: #fff;
  }

  .admin .right-section .admin .search button {
    position: relative;
    z-index: 1;
    width: 47px;
    height: 42px;
    font-size: 17px;
    cursor: pointer;
    border: none;
    background: #fff;
    color: #333;
    outline: none;
    border-radius: 0 5px 5px 0;
    transition: all 0.2s ease;
  }

  .admin .right-section .search {
    margin: 0px 20px;
    margin-bottom: 20px;
    display: flex;
    position: relative;
    align-items: center;
    justify-content: space-between;
  }
</style>

<body>
  <?php require_once "header.php"; ?>
  <div class="container admin">
    <section class="left-section">

      <div class="client">
        <h2>Clients</h2>
        <div class="online-clients-number row">
          <span>online Clients</span>
          <span id="count-online-clients" class="count-number"> <?= countRows($conn, 'users', "WHERE status = 'Active now'") ?></span>
          <button id="show-online-client">show</button>
        </div>
        <div class="all-clients-number row">
          <span>All Clients</span>
          <span id="count-all-clients" class="count-number"><?= countRows($conn, 'users') ?></span>
          <button id="show-all-client">show</button>
        </div>

      </div>

      <div class="therapist">

        <h2>Therapist</h2>

        <div class="row online-therapist-number">
          <span>online Therapist</span>
          <span id="count-online-therapist" class="count-number"><?= countRows($conn, 'therapist', "WHERE status = 'Active now'") ?></span>
          <button id="show-online-therapist">show</button>
        </div>

        <div class="all-therapist-number row">
          <span>All Therapist</span>
          <span id="count-all-therapist" class="count-number"><?= countRows($conn, 'therapist') ?></span>
          <button id="show-all-therapist">show</button>
        </div>
        <div class="row button">
          <button id="show-shedules">show schedules</button>
        </div>
        <div class="row button">
          <button id="show-add-therapist-form">Add therapist</button>
        </div>
        <div class="row button">
          <button id="show-therapist-remove">Remove therapist</button>
        </div>

      </div>
    </section>

    <section class="right-section">
      <div class="online-client show">
        <h2>online clients</h2>
        <div class="search">
          <input id="search-online-clients" type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list" id="online-clients-list">
          <?php displayUsers($onlineUsers) ?>
        </div>
      </div>
      <div class="all-client show">
        <h2>clients</h2>
        <div class="search">
          <input id="search-all-clients" type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list" id="all-clients-list">
          <?php displayUsers($users) ?>
        </div>
      </div>
      <div class="online-therapist show">
        <h2>online therapist</h2>
        <div class="search">
          <input id="search-online-therapist" type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list" id="online-therapist-list">
          <?php displayUsers($onlineTherapists) ?>
        </div>
      </div>
      <div class="all-therapist show">
        <h2>Therapist</h2>
        <div class="search">
          <input id="search-all-therapist" type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list" id="all-therapist-list">
          <?php displayUsers($therapists) ?>
        </div>
      </div>
      <div class="schedules show">
        <h2>Shedules</h2>
        <div class="search">
          <input id="search-all-schedules" type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list" id="all-schedules-list">
          <?php
          foreach ($schedules as $s) {

            $user_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$s['user_id']}'"));
            $therapist_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = '{$s['therapist_id']}'"));
            echo "<div class='row-schedule'>
                            <div class='users-img-name'>
                                <img src='php/images/{$user_row['img']}' alt='img'>
                                <p>{$user_row['fname']} {$user_row['lname']}</p>
                            </div>
                            <div class='date'><span>{$s['date']}</span></div>
                            <div class='time'><span>{$s['start_time']} - {$s['end_time']}</span></div>
                            <div class='therapist-img-name'>
                                <img src='php/images/{$therapist_row['img']}' alt='img'>
                                <p>{$therapist_row['fname']} {$therapist_row['lname']}</p>
                            </div>
                        </div>";
          } ?>
        </div>
      </div>
      <div class="add-therapist show">
        <h2>Adding therapist</h2>
        <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="error-text"></div>
          <div class="name-details">
            <div class="field input">
              <label>First Name</label>
              <input type="text" name="fname" placeholder="First name" required>
            </div>
            <div class="field input">
              <label>Last Name</label>
              <input type="text" name="lname" placeholder="Last name" required>
            </div>
          </div>
          <div class="gender_and_birthdate">
            <div class="field input gender">
              <label for="gender">Gender</label>
              <select id="gender" name="gender" required>
                <option value="" class="unbold">select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="field input">
              <label>Birth Date</label>
              <input type="date" name="birthDate" required>
            </div>
          </div>
          <div class="field input">
            <label for="specialization">Specialization</label>
            <select id="specialization" name="specialization" required>
              <option value="" class="unbold"> select Specialization</option>
              <option value="Cognitive-behavioral therapy">Cognitive-behavioral therapy</option>
              <option value="Dialectical behavior therapy">Dialectical behavior therapy</option>
              <option value="Family therapy">Family therapy</option>
              <option value="Psychodynamic therapy">Psychodynamic therapy</option>
              <option value="Play therapy">Play therapy</option>
              <option value="other">other</option>
            </select>
          </div>
          <div class="field input">
            <label>Phone number</label>
            <input type="number" name="phone" placeholder="Enter your Phone" required>
          </div>
          <div class="field input">
            <label>Email Address</label>
            <input type="text" name="email" placeholder="Enter your email" required>
          </div>
          <div class="field input">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter new password" required>
            <i class="fas fa-eye"></i>
          </div>
          <div class="field image">
            <label>Select Image</label>
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
          </div>
          <div class="field button">
            <input type="submit" name="submit" value="Add">
          </div>
        </form>
      </div>
      <div class="remove-therapist show">
        <h2>Removing Therapist</h2>
        <div class="search">
          <input id="search-all-therapist-remove" type="text" placeholder="Enter name to search...">
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="e-t" style="display: none;"></div>
        <div class="users-list" id="all-therapist-list-remove">
          <div class="therapist" id="therapist-remove-t">
            <?php displayUsers($therapists, 'therapist') ?>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php require_once "footer.php"; ?>
</body>
<script>
  const leftSection = document.querySelector('.container .left-section');
  const rightSection = document.querySelector('.container .right-section');



  const online_client = document.querySelector('.container .right-section .online-client');
  const all_client = document.querySelector('.container .right-section .all-client');
  const online_therapist = document.querySelector('.container .right-section .online-therapist');
  const all_therapist = document.querySelector('.container .right-section .all-therapist');
  const schedules = document.querySelector('.container .right-section .schedules');
  const add_therapist = document.querySelector('.container .right-section .add-therapist');
  const remove_therapist = document.querySelector('.container .right-section .remove-therapist');

  const showOnlineClient = document.getElementById('show-online-client');
  const showAllClient = document.getElementById('show-all-client');
  const showOnlineTherapist = document.getElementById('show-online-therapist');
  const showAllTherapist = document.getElementById('show-all-therapist');

  const showSchedule = document.getElementById('show-shedules');
  const addTherapist = document.getElementById('show-add-therapist-form');
  const showTherapistToRemove = document.getElementById('show-therapist-remove');

  function foo(column, block) {
    column.style.flexDirection = 'column';

    online_client.style.display = 'none';
    all_client.style.display = 'none';
    online_therapist.style.display = 'none';
    all_therapist.style.display = 'none';
    schedules.style.display = 'none';
    add_therapist.style.display = 'none';
    remove_therapist.style.display = 'none';
    block.style.display = 'block';
    rightSection.style.display = 'block';
  }

  showOnlineClient.addEventListener('click', () => {
    foo(leftSection, online_client)

  })
  showAllClient.addEventListener('click', () => {
    foo(leftSection, all_client)
  })
  showOnlineTherapist.addEventListener('click', () => {
    foo(leftSection, online_therapist)
  })
  showAllTherapist.addEventListener('click', () => {
    foo(leftSection, all_therapist)
  })
  showSchedule.addEventListener('click', () => {
    foo(leftSection, schedules)
  })
  addTherapist.addEventListener('click', () => {
    foo(leftSection, add_therapist)
  })
  showTherapistToRemove.addEventListener('click', () => {
    foo(leftSection, remove_therapist)
  })
</script>
<script src="javascript/pass-show-hide.js"></script>
<script src="javascript/addTherapist.js"></script>
<script src="javascript/removeTherapist.js"></script>

</html>