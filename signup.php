<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: profile.php");
}
?>

<?php require_once "head.php"; ?>


<body>

  <?php require_once "header.php"; ?>

  <div class="wrapper">
    <section class="form signup">

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
          <label for="relationship">Relationship Status</label>
          <select id="relationship" name="relationship" required>
            <option value="" class="unbold"> select relationship</option>
            <option value="Single">Single</option>
            <option value="In a Relationship">In a Relationship</option>
            <option value="Engaged">Engaged</option>
            <option value="Married" >Married</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
          </select>
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
          <input type="submit" name="submit" value="Sign Up">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <?php require_once "footer.php"; ?>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>

</html>