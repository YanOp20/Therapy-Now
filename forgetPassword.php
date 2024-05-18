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
        <section class="form login forgetPassword">
            <header class="input-header">Please enter your email to search for your account.</header>
            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="email-input field input">
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                
                <div id="password-field">

                </div>

                <div class="field button">
                    <input type="submit" name="search" value="search" </div>

            </form>
        </section>
    </div>
    <?php require_once "footer.php"; ?>

    <script src="javascript/forgetPassword.js"></script>

</body>

</html>