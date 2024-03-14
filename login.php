<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: profile.php");
  }
?>


<?php include_once "head.php"; ?>
<body>
<?php include_once "header.php"; ?>



  <div class="wrapper">
    <section class="form login">
      <!-- <header>Talky</header> -->
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Log In">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="signup.php">Signup now</a></div>
    </section>
  </div>
  <?php include_once "footer.php"; ?>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
