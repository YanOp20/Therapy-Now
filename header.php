<div id="header-container">
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="">
            <h1>Therapy Now</h1>
        </a>
    </div>
    <header>
        <div class="navigation-menu">
            <div class="navigation-links">
                <a href="index.php">Home</a>
                <a href="blog.php">Blog</a>
                <!-- <a href="#">Link 3</a>
                <a href="#">Link 3</a>
                <a href="#">Link 3</a> -->
            </div>
        </div>
        <?php require_once "php/config.php";
        if (!isset($_SESSION['unique_id'])) { ?>
            <div class="user-buttons c d">
                <a href="signup.php">Sign up</a>
                <a href="login.php">Log in</a>
            </div>
<?php } else if(isset($_SESSION['unique_id']) and $_SESSION['unique_id'] == 'admin'){?>
                <div class="user-buttons user-profile c">
                    <a href="admin.php" class="pro_link">
                        <img src="php/images/admin-icon.png" alt="">
                        <span>admin</span>
                    </a>
                    <a href="php/logout.php?logout_id=<?php echo $_SESSION['unique_id'] ?>" class="logout">Logout</a>
                </div>
       <?php }else {
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
        <button id="mobile-menu-close-button" class="c-menu-button"><i class="fa fa-times"></i></button>
    </header>
</div>





<!-- new comes form chat.php -->






<div id="incomingCallModal" class="modal">
    <div class="modal-content">
        <div class="callerInfo">
            <img id="callerImg" src="" alt="">
            <p id="callerName"> </p>
        </div>
        <button id="acceptCallBtn">Accept</button>
        <button id="declineCallBtn">Decline</button>
    </div>
</div>

<!-- videoCallContainer -->
<div>
    <div id="videoCallContainer" class="videoCallContainer">
        <div id="header">
            <button id="minimizeBtn1"><i class="fas fa-window-minimize"></i></button>
            <button id="minimizeBtn2"><i class="fas fa-window-maximize"></i></button>
            <button id="maximizeBtn"><i class='fas fa-expand'></i></button>
        </div>

        <div id="remoteVideoContainer" class="remoteVideoContainer">
            <video id="remoteVideo" autoplay playsinline></video>
        </div>

        <div id="localVideoContainer" class="localVideoContainer">
            <video id="localVideo" autoplay playsinline muted></video>
        </div>
        <div id="callingMsg">
            <p>calling...</p>
        </div>

        <div id="callControls">
            <button id="muteVideoBtn"><i class="fas fa-video-slash"></i></i></button>
            <button id="muteBtn"><i class="fas fa-microphone-slash"></i></button>
            <!-- <button id="uNmuteBtn"><i class="fas fa-microphone"></i></button> -->
            <button id="hangUpBtn"><i class="fa fa-phone"></i></button>
        </div>
    </div>
    <div id="circle" class="circle"></div>
</div>

<script>
    // video container 
    const videoCallContainer = document.getElementById("videoCallContainer");
    const localVideoContainer = document.getElementById("localVideoContainer");
    const remoteVideoContainer = document.getElementById("videoCallContainer");
    const minimizeBtn1 = document.getElementById("minimizeBtn1");
    const minimizeBtn2 = document.getElementById("minimizeBtn2");
    const maximizeBtn = document.getElementById("maximizeBtn");
    const circle = document.getElementById("circle");

    minimizeBtn2.addEventListener("click", () => {
        videoCallContainer.classList.add("minimized");
        localVideoContainer.classList.add("local-minimized");
        minimizeBtn2.style.display = "none";
        maximizeBtn.style.display = "block";
    });

    maximizeBtn.addEventListener('click', () => {
        videoCallContainer.classList.remove("minimized");
        localVideoContainer.classList.remove("local-minimized");
        minimizeBtn2.style.display = "block";
        maximizeBtn.style.display = "none";
    });

    minimizeBtn1.addEventListener('click', () => {
        videoCallContainer.style.visibility = "hidden";
        circle.style.display = "block";
    });
    circle.addEventListener('click', () => {
        videoCallContainer.style.visibility = "visible";
        circle.style.display = "none";
    });
</script>


<!-- new comes form chat.php end -->

<!-- <script src="./Server/socket.io.min.js"></script>-->
<script src="https://cdn.socket.io/4.7.5/socket.io.min.js" integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO" crossorigin="anonymous"></script>

<script>
    // host and port
    const host = `https://${window.location.hostname}`;
    const port = 3000;
    // const socket = io.connect(`${host}:${port}`);
    // const outgoingID = document.getElementById('outgoingID').value;
    // const incomingID = document.getElementById('incoming_id').value;
    // const roomId = [outgoingID, incomingID].sort().join('-');

    // const userName = document.getElementById('Fname').value + "-" + outgoingID;

    // const webRtcNamespace = io.connect(`${host}:${port}/webRtc`, { auth: { userName, roomId } });
    // const webRtcNamespace = io.connect(`${host}:${port}/webRtc`);


</script>





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

    // if(window.innerWidth < 600 ){
    //     if (window.innerWidth <= 850) {
    //             div.style.height = "auto";
    //         } else {
    //             div.style.height = (initialHeight / 2) + "px";
    //             // body.style.marginTop = "200px";
    //             div.style.flexDirection = "row";
    //             h.style.width = "30%";
    //         }
    // }

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

    toggleButton()
    window.onresize = toggleButton;
</script>