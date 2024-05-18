<?php
require_once 'head.php';
session_start();
require_once "php/config.php";
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
    <?php require_once "header.php";  ?>
    <div class="profile-container">
        <?php
        require_once "profile/sidebar.php";
        if (isset($_GET['link'])) {
            $link = $_GET['link'];
            switch ($link) {
                case "profile":
                    require_once "profile/profile.php";
                    break;
                case "user-profile":
                    require_once "profile/show-user-profile.php";
                    break;
                case "schedule":
                    require_once "profile/schedule.php";
                    break;
                case "appointment":
                    require_once "profile/appointment.php";
                    break;
                case "patient":
                    require_once "profile/patients.php";
                    break;
                case "message":
                    require_once "profile/users.php";
                    break;
                case "chat":
                    require_once "profile/chat.php";
                    require_once "profile/users.php";
                    break;
                default:
                    require_once "profile/profile.php";
                    break;
            }
        } else
            require_once "profile/profile.php";

        ?>

    </div>

    <?php require_once "footer.php" ?>


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