<?php
$style = "";
include_once "php/config.php";

    $sql_p = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if(mysqli_num_rows($sql_p) > 0) $style = "style='display: none;'";

?>


<div class="wrapper user">
    <section class="users" >
            <div class="search" <?= $style ?>>
                <span class="text">Select and start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
        <div class="users-list">
            
        </div>
    </section>
</div>
<script src="javascript/users.js"></script>