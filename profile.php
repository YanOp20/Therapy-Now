<?php
include_once 'head.php';
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
} else {
    $outgoing_id = $_SESSION['unique_id'];
}
if (isset($_GET['b'])) {
    $_SESSION['b'] = $_GET['b'];
} else {
    $_SESSION['b'] = "";
}
?>
<style>
/* *{border: solid 2px red;} */
/* body{overflow: hidden;} */
.doctor {
    /* border: solid red 1px; */
    height: 90vh;
    width: 100%;
    display: flex;
    gap: 1em;
    box-sizing: border-box;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    justify-content: space-between;
    /* flex-wrap: wrap;
        overflow: hidden; */
}

.doctor .left {

    /* flex-basis: 20%; */
    height: 86vh;
    margin: 1em 0em 1em 0em;
    padding: 1em;
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 25px;
    box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1), 0 32px 64px -48px rgba(0, 0, 0, 0.5);
}

.doctor .left a .icon-name {
    display: none;
    font-size: 14px;
    margin-top: 5px;
    position: absolute;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
}

a:hover .icon-name {
    display: block;
}

.doctor .left a {
    /* border: solid darkblue 1px; */
    text-decoration: none;
    font-size: medium;
    margin-top: 2em;
    font-weight: bold;
    width: 100%;
    border-radius: 16px;
    display: flex;
    align-items: center;
    /* justify-content: center; */
    padding-right: 1em;
    gap: 1em;
}

.doctor .left a :first-child {
    border-radius: 50%;
    height: 45px;
    width: 45px;
    font-size: 1.5em;

}




.doctor .right {

    /* border: solid darkblue 1px;  */
    flex-basis: 75%;
    margin: 1em 1em 1em 0em;
    padding: 2em;
    display: flex;
    flex-direction: column;
    gap: 1em;
    border-radius: 25px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1), 0 32px 64px -48px rgba(0, 0, 0, 0.5);
}

.doctor .right img {
    border-radius: 16%;
    width: 25%;
    height: auto;

}

.doctor .right ul {
    list-style-type: none;
    flex-grow: 2;
}

.doctor .right li {
    margin-bottom: 10px;
}

.doctor .user {
    height: 86vh;
    margin-top: 1em;
    border-radius: 25px;
    max-width: 500px;
}

.doctor .chatt {
    height: 86vh;
    margin: 1em;
    min-width: 300px;
    max-width: 700px;
    flex-grow: 1;
}

.doctor .chatt header a i {

    font-size: 40px;
}

/* Define some basic styles for the table */
.doctor .patient table,
.doctor .schedule table {
    border-collapse: collapse;
    width: 100%;
}

.doctor .schedule table td.name {
    max-width: 250px;
}

.doctor .schedule table a {
    font-size: medium;

    width: 100%;
    display: flex;
    align-items: center;
    gap: 1em;
}


.doctor .patient table th,
.doctor .patient table td,
.doctor .schedule table th,
.doctor .schedule table td {
    border: 1px solid black;
    padding: 10px;
    text-align: left;
}

.doctor .patient table th,
.doctor .schedule table th {
    background-color: lightblue;
}

.doctor .table-container {
    /* height: 85vh; Set the height as per your requirement */
    overflow: auto;
    /* background:  red; */
}

.doctor .right span {
    margin-left: 2vmin;
    color: #542B53;
    font-weight: 700;

}

@media screen and (max-width: 768px) {}

@media (max-width: 800px) {
    .doctor .left a p {
        display: none;
    }

    .doctor .user .users .search input {
        width: 100px;
    }

    .doctor .user .users .search span,
    .doctor .user .users .search input {
        font-size: .75em;
        /* width: 10%; */
    }

    .doctor .user .users .search {
        display: flex;
        flex-direction: column;
    }

    .doctor .user .users .users-list a .content .details {
        display: none;
    }

    .users .search button.active {
        background: none;
        color: black;
    }
}
</style>

<body>
    <?php include_once "header.php";  ?>
    <div class="doctor">
        <?php
        include_once "profile/sidebar.php";
        if (isset($_GET['link'])) {
            $link = $_GET['link'];
            switch ($link) {
                case "profile":
                    include_once "profile/profile.php";
                    break;
                case "user-profile":
                    include_once "profile/show-user-profile.php";
                    break;
                case "schedule":
                    include_once "profile/schedule.php";
                    break;
                case "appointment":
                    include_once "profile/appointment.php";
                    break;
                case "patient":
                    include_once "profile/patients.php";
                    break;
                case "message":
                    include_once "profile/users.php";
                    break;
                case "chat":
                    include_once "profile/chat.php";
                    include_once "profile/users.php";
                    break;
                default:
                    include_once "profile/profile.php";
                    break;
            }
        } else
            include_once "profile/profile.php";

        ?>

    </div>

    <?php include_once "footer.php" ?>
    <script src="javascript/appointment.js"></script>

</body>

</html>