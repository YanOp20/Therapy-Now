<div id="header-container">
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="" style="width: 50px;">
            <h1 style="color: #4E6BA4;">Therapy Now</h1>
        </a>
    </div>
    <header>
        <div class="navigation-menu">
            <div class="navigation-links">
                <a href="index.php">Home</a>
                <a href="blog.php">Blog</a>
                <a href="#">Link 3</a>
                <a href="#">Link 3</a>
                <a href="#">Link 3</a>
            </div>
        </div>
        <?php include_once "php/config.php";
        if (!isset($_SESSION['unique_id'])) { ?>
        <div class="user-buttons c d">
            <a href="signup.php">Sign up</a>
            <a href="login.php">Log in</a>
        </div>
        <?php } else {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            } else {
                $sql = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$_SESSION['unique_id']}");
                $row = mysqli_fetch_assoc($sql);
            } ?>
        <div class="user-buttons user-profile c">
            <a href="profile.php" class="pro_link">
                <img src="php/images/<?php echo $row['img']; ?>" alt="">
                <span><?php echo $row['fname'] ?></span>
            </a>
            <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
        </div>
        <?php } ?>
        <button id="mobile-menu-button" class="menu-button"><i class="fa fa-bars"></i></button>
        <button id="mobile-menu-close-button" class="c-menu-button" style="display: none;"><i
                class="fa fa-times"></i></button>
    </header>
</div>
<script>
const body = document.querySelector('body');
const btn = document.getElementById("mobile-menu-button");
const cbtn = document.getElementById("mobile-menu-close-button");
const menu = document.querySelector(".navigation-menu");
const btns = document.querySelector(".user-buttons");
const links = document.querySelector(".navigation-links");
const div = document.getElementById("header-container");
const h = document.querySelector("header");


var initialHeight = div.offsetHeight;
window.addEventListener("scroll", function() {
    var scrollY = window.scrollY;

    if (scrollY > 0) {
        if (window.innerWidth <= 850) {
            div.style.height = "auto";
        } else {
            div.style.height = (initialHeight / 2) + "px";
            // body.style.marginTop = "200px";
            div.style.flexDirection = "row";
            h.style.width = "30%";
        }

    } else {
        if (window.innerWidth <= 850) {
            div.style.height = "auto";
        } else {
            div.style.height = initialHeight + "px";
            // body.style.marginTop = "500px";
            div.style.flexDirection = "column";
            h.style.width = "100%";
        }
    }
});

// buttons menu

const m = () => {
    div.style.height = "auto";
    menu.style.display = "block";
    btns.style.display = "block";
    div.style.flexDirection = "column";
    h.style.flexDirection = "column";
    btns.style.display = "flex";
    btns.style.flexDirection = "column";
    links.style.display = "flex";
    links.style.flexDirection = "column";
    cbtn.style.display = "block";
    btn.style.display = "none";

};
// chancel button
const c = () => {
    div.style.height = "auto";
    menu.style.display = "none";
    btns.style.display = "none";
    div.style.flexDirection = "row";
    h.style.flexDirection = "row";
    btns.style.display = "none";
    links.style.display = "flex";
    links.style.flexDirection = "row";
    cbtn.style.display = "none";
    btn.style.display = "block";

};

// checking windows size
// button showing....

function toggleButton() {
    let windowWidth = window.innerWidth;

    if (windowWidth <= 850) {
        btn.style.display = "block";
        menu.style.display = "none";
        btns.style.display = "none";
        div.style.flexDirection = "row";
        h.style.width = "30%";

    } else {
        btn.style.display = "none";
        menu.style.display = "block";
        btns.style.display = "flex";
        div.style.flexDirection = "column";
        h.style.width = "100%";
    }
}

btn.addEventListener("click", m);
cbtn.addEventListener("click", c);


window.onresize = toggleButton;
</script>