<?php session_start(); ?>
<?php include_once "head.php"; ?>


<body>
    <?php include_once "header.php"; ?>
    <div class="wrapper contact">
        <section class="form signup">
            <header class="contact"> Have question and need to talk to us? Please complete this form and we will get in
                touch as
                soon
                as
                possible.</header>
            <form class="app-form" action=" #" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="field input">
                    <input type="text" name="name" placeholder="Name" required>
                </div>
                <div class="field input">
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="field input">
                    <textarea  name="textarea" id="" cols="30" rows="10" placeholder="Message"></textarea>
                </div>

                <div class="field button">
                    <input class="submit" type="submit" name="submit" value="Send">
                </div>
            </form>
        </section>
    </div>
    <?php include_once "footer.php"; ?>

</body>
<script src="javascript/contact.js"></script>
</html>