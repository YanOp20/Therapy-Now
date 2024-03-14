<?php session_start(); ?>
<?php include_once "head.php"; ?>


<body>
    <?php include_once "header.php"; ?>
    <p>- Have question and need to talk to us? Please complete this form and we will get in touch as soon as possible.
</p>
    <div class="wrapper contact">
        <section class="form signup">
            <!-- <header> Therapy</header> -->
            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="field input">
                    <input type="text" name="fname" placeholder="Name" required>
                </div>
                <div class="field input">
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="field input">
                    <textarea name="textarea" id="" cols="30" rows="10" placeholder="Message"></textarea>
                </div>

                <div class="field button">
                    <input type="submit" name="submit" value="Send">
                </div>
            </form>
        </section>
    </div>
    <?php include_once "footer.php"; ?>

</body>

</html