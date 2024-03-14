<?php 
// session_start(); ?>

<style>
    #div {
        background-color: #97BC62;
        display: flex;
        align-items: center;
        justify-content: space-around;
        display: flex;
        width: 100%;
        height: 120px;
        position: sticky;
        top: 0;
        left: 0;
        flex-direction: column;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    #btn {
        display: flex;
        height: auto;
        width: auto;
        display: none;
        margin-right: 1%;
    }

    header {
        display: flex;
        align-items: center;
        justify-content: space-around;
        display: flex;
        width: 100%;
        height: auto;
        flex-grow: 1;

    }

    .menu {
        flex-grow: 0.5;
        width: 100%;
        margin-left: 2em;
    }

    a {
        margin: 1%;
    }

    .d {
        display: flex;
        flex-wrap: nowrap;
        width: 40%;
    }
    /* *{border: solid red 2px;} */
    .c a {
        text-align: center;
        cursor: pointer;
        text-decoration: none;
        color: #000;
        background: #fff;
        margin: 10px;
        border-radius: 10%;
        padding: 0.2em;
        font-size: 0.9em;
        font-weight: 500;
        box-shadow: rgb(255, 198, 0) -2px -2px 0px 2px, rgb(246, 84, 174) 0px 0px 0px 4px, rgba(0, 0, 0, 0.05) 0px 0px 2px 7px;
        transition: all 0.2s;
    }
    
    .c a:hover {
        box-shadow: rgb(246, 84, 174) -2px -2px 0px 2px, rgb(255, 198, 0) 0px 0px 0px 4px, rgba(0, 0, 0, 0.05) 0px 0px 2px 7px;
        transform: scale(1.01);
    }
    
    #h button:hover {
        box-shadow: rgb(246, 84, 174) -2px -2px 0px 2px, rgb(255, 198, 0) 0px 0px 0px 4px, rgba(0, 0, 0, 0.05) 0px 0px 2px 7px;
        transform: scale(1.01);
    }
    .c a.pro_link {
            display: flex;
        align-items: center;
        background: none;
        bottom: none;
        box-shadow: none;
        min-width: 150px;
        max-width: 150px;
        margin-left: 0;
    }
    
    
    
    
    #h button {
        border: 0;
        cursor: pointer;
        text-decoration: none;
        color: #000;
        background: #fff;
        margin: 5px;
        line-height: 10px;
        /* border-radius: 40px; */
        padding: 10px;
        font-size: 20px;
        /* font-weight: 100; */
        box-shadow: rgb(255, 198, 0) -2px -2px 0px 2px, rgb(246, 84, 174) 0px 0px 0px 4px, rgba(0, 0, 0, 0.05) 0px 0px 2px 7px;
        transition: all 0.2s;
    }
    
    .pLog {
        display: flex;
        width: 50%;
        align-items: center;
        justify-content: flex-end;
        margin-right: 3em;
        
    }
    
    .pLog img {
        object-fit: cover;
        border-radius: 50%;
        height: 50px;
        width: 50px;
    }
    
    .pLog span {
    font-size: 18px;
    font-weight: 500;
    color: #000;
    margin-left: 5%;
    /* margin-right: 5%; */
}

.logo a {
    margin: 0;
    padding: 0;
    display: flex;
    color: #333;
}
.link a{
    color: #333;
    
}

/* a {color:aqua;} */
/* * {
    border: red solid 1px;
} */
/* * {
    background-image: linear-gradient(to left, violet, indigo, blue);, green, black, orange
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
} */
</style>
<div id="div">
    <div class="logo">
        <a href="index.php" >
            <img src="img/logo.png" alt="" style="width: 50px;">
            <h1 style="color: #4E6BA4;">Therapy Now</h1>
        </a>

    </div>
    <header id="h">

        <div class="menu">
            <div class="links">
                <a href="index.php">Home</a>
                <a href="blog.php">Blog</a>
                <a href="#">Link 3</a>
                <a href="#">Link 3</a>
                <a href="#">Link 3</a>
            </div>
        </div>

        <?php
        include_once "php/config.php";
        if (!isset($_SESSION['unique_id'])) {
        ?>
            <div class="btns c d">
                <a href="signup.php">Sign up</a>
                <a href="login.php">Log in</a>
            </div>

            <!-- <div class="content" style="  display: flex;  align-items: center;"> -->
        <?php
        } else {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            }else{
                $sql = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$_SESSION['unique_id']}");
                $row = mysqli_fetch_assoc($sql);
            }
        ?>
            <div class="btns pLog c">

                <a href="profile.php" class="pro_link">
                    <img src="php/images/<?php echo $row['img']; ?>" alt="">
                    <span><?php echo $row['fname'] ?></span>
                </a>
                <!-- <div class="details" style=""> -->
                <!-- </div> -->
                <!-- </div> -->
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
            </div>

        <?php } ?>




        <button id="btn" class="menu-button"><i class="fa fa-bars"></i></button>
        <button id="cbtn" class="c-menu-button" style="display: none;"><i class="fa fa-times"> </i></button>
    </header>
</div>
<script>
    const body = document.querySelector('body');
    const btn = document.getElementById("btn");
    const cbtn = document.getElementById("cbtn");
    const menu = document.querySelector(".menu");
    const btns = document.querySelector(".btns");
    const links = document.querySelector(".links");
    const div = document.getElementById("div");
    const h = document.getElementById("h");
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

