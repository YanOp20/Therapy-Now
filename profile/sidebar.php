<div class="left">

    <?php

    $sql = mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id ={$_SESSION['unique_id']} ");
    if (mysqli_num_rows($sql) > 0) {
        // echo "this is doctor";
    ?>
    <a href="profile.php?link=profile">
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <span class="icon-name">profile</span>
        <p><?= $row['fname'] . " " . $row['lname'] ?></p>
    </a>

    <a href="profile.php?link=patient">
        <span><i class="fas fa-solid fa-users"></i></span>
        <span class="icon-name" Patients></span>
        <p>Patients</p>
    </a>

    <?php
    } else {
    ?>
    <a href="profile.php?link=profile">
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <span class="icon-name">profile</span>
        <p><?= $row['fname'] . " " . $row['lname'] ?></p>
    </a>

    <a href="profile.php?link=appointment">
        <span><i class="fas fa-calendar-plus"></i></span>
        <!-- <span class="icon-name">Dr</span> -->
        <p>Add appointment</p>
    </a>
    <?php
    }
    ?>

    <a href="profile.php?link=message">
        <span><i class="fas fa-solid fa-comment-dots"></i></span>
        <!-- <span class="icon-name">Messages</span> -->
        <p>Messenger</p>
    </a>
    <a href="profile.php?link=schedule">
        <span><i class="fas fa-solid fa-calendar-alt"></i></span>
        <!-- <span class="icon-name">Schedule</span> -->
        <p>Schedules</p>
    </a>



</div>