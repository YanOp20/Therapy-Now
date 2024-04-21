<?php
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sql_p2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
}
$sql_d = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$_SESSION['unique_id']}");
$sql_p = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");

$_doc = false;
$_user = false;
$user_profile = false;

if (mysqli_num_rows($sql_d) > 0) {
    $_doc = true;
    $_user = false;
    if (isset($_GET['link']) and $_GET['link'] == 'user_profile') {
        $user_profile = true;
    } else {
        $user_profile = false;
    }
} else {
    $_doc = false;
    $_user = true;
}


if ($_doc and !$user_profile) {
?>
    <div class="right">
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <h2><?= $row['fname'] . '  ' . $row['lname'] ?></h2>
        <ul>
            <li><strong>Specialty:</strong> Psychiatrist</li>
            <li><strong>Location:</strong> Addis Ababa</li>
            <li><strong>Rating:</strong> 4.9/5</li>
            <li><strong>Bio:</strong> <?= $row['fname'] . '  ' ?> is a licensed and experienced psychiatrist who provides
                compassionate and effective mental health care to his patients. He specializes in treating anxiety,
                depression, bipolar disorder, and PTSD. He also offers online counseling and telemedicine services.</li>
        </ul>
    </div>


<?php

} elseif ($_user or $_doc) {
    if ($_doc) {
        $row = mysqli_fetch_assoc($sql_p2);
    }
?>
    <div class="right prof">
        <style>
            .profile-container .right .rightleft span {
                margin-left: 2vmin;
                color: #542B53;
                font-weight: 700;

            }

            .profile-container .prof {
                display: flex;
                flex-direction: row;
            }

            .profile-container .right .righright div {
                margin-bottom: 1em;
            }

            .profile-container .right .righright .history {
                /* border:solid red 1px;      */
                padding-right: 0.5em;
                overflow-y: auto;
                /* box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%), inset 0 -32px 32px -32px rgb(0 0 0 / 5%); */
                background: rgba(190, 247, 206, .2);
                padding: 1em;
                height: 70vh;
            }

            .profile-container .right .righright {
                /* border: red solid 1px; */
                /* flex-basis: 60%; */
                /* max-width: 50%; */
                /* width: 100px; */
            }

            .profile-container .right .rightleft {
                /* flex-basis: 40%; */
            }

            .right .buttons {
                display: flex;
                gap: 1em;
                flex-direction: row-reverse;
                /* justify-content: space-evenly; */
                /* margin-bottom: 2em; */
            }

            .right .buttons button,
            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 0.5em;
                font-size: 1em;
                cursor: pointer;

            }
        </style>
        <?php
        $birthdate = new DateTime($row['birthdate']);
        // Create a DateTime object for today
        $today = new DateTime('today');
        // Calculate the difference between the two dates and get the years
        $age = $birthdate->diff($today)->y;

        ?>
        <div class="rightleft">

            <img src="php/images/<?php echo $row['img']; ?>" alt="">
            <!-- <h2><?= $row['fname'] . '  ' . $row['lname'] ?></h2> -->
            <ul>
                <br><br>
                <li><strong>First Name: </strong> <span><?= $row['fname'] ?> </span></li>
                <li><strong>Last Name: </strong> <span><?= $row['lname'] ?></span></li>
                <li><strong>Gender: </strong> <span><?= $row['gender'] ?></span></li>
                <li><strong>Age: </strong> <span><?= $age ?></span></li>
                <li><strong>Email: </strong> <span><?= $row['email'] ?></span></li>
                <li><strong>Relationship status: </strong> <span><?= $row['relationship'] ?></span></li>
            </ul>
        </div>

        <?php if (mysqli_num_rows($sql_d) > 0) { ?>
                <div class="righright">
                    <?php
                $o = "";
                $his_query = mysqli_query($conn, "SELECT * FROM history WHERE user_id = {$user_id} ORDER BY date ");
                if (mysqli_num_rows($his_query) > 0) {
                    while ($row = mysqli_fetch_assoc($his_query)) {
                        $o .= '<div class="his"><p>' . $row['date'] . '</p><p>' . $row['his'] . '</p></div>';
                    }
                }
            ?>
                <div class="buttons">
                    <button class="addHis">Add History</button>
                    <button class="showHis">Show User History</button>
                    <button style="display: none" class="hideHis">Hide User History</button>
                </div>
                <div class="history" style="display: none;">
                    <?= nl2br($o) ?>
                </div>
                <form class="hisform" style="display: none;" action="#" class="" method="POST">
                    <div class="error-text"></div>
                    <input type="text" name="therapist_id" value="<?= $_SESSION['unique_id']; ?>" hidden>
                    <input class="user_id" type="text" name="user_id" value="<?= $user_id; ?>" hidden>
                    <textarea class="" name="text" rows="6" cols="40" placeholder="write a text..." required></textarea>
                    <input class="submit m" type="submit" name="submit" value="ADD to History">
                </form>

            </div>
            <?php    } ?>
    </div>
    <?php
    if (isset($_POST['submit'])) {

        $therapist_id = mysqli_real_escape_string($conn, $_POST['therapist_id']);
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $his = mysqli_real_escape_string($conn, $_POST['text']);

        if (!empty($his)) {
            $sql = mysqli_query($conn, "INSERT INTO history (user_id, therapist_id, his)
                VALUES ({$user_id}, {$therapist_id}, '{$his}')") or die();
        }
    }



    ?>
    <!-- <script src="../javascript/history.js"></script> -->
    <script>
        const hisBox = document.querySelector(".history"),
            showHis = document.querySelector(".showHis"),
            hideHis = document.querySelector(".hideHis"),
            hisform = document.querySelector(".hisform"),
            addHis = document.querySelector(".addHis");

        showHis.addEventListener("click", () => {
            hideHis.style.display = "block";
            showHis.style.display = "none";
            hisBox.style.display = "block";
            hisform.style.display = "none";
            hisBox.scrollTop = hisBox.scrollHeight;
        });
        addHis.addEventListener("click", () => {
            hisform.style.display = "block";
            hisBox.style.display = "none";
        });
        hideHis.addEventListener("click", () => {
            hideHis.style.display = "none";
            hisform.style.display = "none";
            hisBox.style.display = "none";
            showHis.style.display = "block";
        });
    </script>
<?php
}
?>