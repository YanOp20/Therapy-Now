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
</style>

<body>
    <?php include_once "header.php";  ?>
    <div class="profile-container">
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


</body>
<script>
    
        // Get the value of the 'link' parameter from the current URL
    function getQueryParam(paramName) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(paramName);
    }
    
    // Example usage:
    const linkValue = getQueryParam('link');
    // console.log(linkValue); // Print the value of the 'link' parameter
  
    const us = document.querySelector('.user')
    if( linkValue =="chat")
        us.classList.add('hidee')


    // console.log("helllllllllllllllll")
    // const user = document.querySelector('.user .users .users-list')
    // console.log(user)
    // user.addEventListener('click', () =>{
    //     console.log(" i am clicking my self")
    // })
    // const userSection = document.querySelector('.user');


</script>

</html>