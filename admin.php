<?php
include_once "php/config.php";
require_once "php/feachToDisplayData.php";


if (isset($_POST['submit']) && isset($_POST['remove'])) {
    $therapist_id = $_POST['remove'];

    // Check if the therapist has associated appointments
    $query_check_appointments = "SELECT * FROM Appointment WHERE therapist_id = :therapist_id";
    $stmt_check_appointments = $pdo->prepare($query_check_appointments);
    $stmt_check_appointments->execute(array(':therapist_id' => $therapist_id));
    $appointments = $stmt_check_appointments->fetchAll();

    if (count($appointments) > 0) {
        // Provide feedback to the user that the therapist has associated appointments
        echo "Cannot remove therapist as there are associated appointments.";
    } else {
        // No associated appointments, proceed with deletion
        $query_remove_therapist = "DELETE FROM therapist WHERE unique_id = :therapist_id";
        $stmt_remove_therapist = $pdo->prepare($query_remove_therapist);
        $stmt_remove_therapist->execute(array(':therapist_id' => $therapist_id));

        // Provide feedback to the user
        echo "Therapist removed successfully.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .right-section>div {
            display: none;
        }

        .container {
            display: flex;
            gap: 1em;
        }

        .container .left-section {
            display: flex;
            flex-direction: row;
            gap: 3em;
        }
    </style>
    <style>
        .right-section .search button.active {
            background: #333;
            color: #fff;
            }
        .right-section .search button{
            position: relative;
  z-index: 1;
  width: 47px;
  height: 42px;
  font-size: 17px;
  cursor: pointer;
  border: none;
  background: #fff;
  color: #333;
  outline: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.2s ease;
}
        .right-section .search{
            margin: 0px 20px;
            margin-bottom: 20px;
            display: flex;
            position: relative;
            align-items: center;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <section class="left-section">

            <div class="client">
                <h2>Clients</h2>
                <div class="online-clients-number row">
                    <span>online Clients</span>
                    <span class="count-number"> <?= countRows($conn, 'users', "WHERE status = 'Active now'")?></span>
                    <button id="show-online-client">show</button>
                </div>
                <div class="all-clients-number row">
                    <span>All Clients</span>
                    <span class="count-number"><?= countRows($conn, 'users')?></span>
                    <button id="show-all-client">show</button>
                </div>

            </div>

            <div class="therapist">

                <h2>Therapist</h2>

                <div class="row online-therapist-number">
                    <span>online Therapist</span>
                    <span class="count-number"><?= countRows($conn, 'therapist', "WHERE status = 'Active now'")?></span>
                    <button id="show-online-therapist">show</button>
                </div>

                <div class="all-therapist-number row">
                    <span>All Therapist</span>
                    <span class="count-number"><?= countRows($conn, 'therapist')?></span>
                    <button id="show-all-therapist">show</button>
                </div>
                <div class="row button">
                    <button id="show-shedules">show schedules</button>
                </div>
                <div class="row button">
                    <button id="show-add-therapist-form">Add therapist</button>
                </div>
                <div class="row button">
                    <button id="show-therapist-remove">Remove therapist</button>
                </div>

            </div>
        </section>

        <section class="right-section">
            <div class="online-client show">
                <h2>online clients</h2>
                <div class="search">
                    <input id="search-online-clients" type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list" id="online-clients-list">
                <?php displayUsers($onlineUsers) ?>
                </div>
            </div>
            <div class="all-client show">
                <h2>clients</h2>
                <div class="search">
                    <input id="search-all-clients" type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list" id="all-clients-list">
                    <?php displayUsers($users) ?>
                </div>
            </div>
            <div class="online-therapist show">
                <h2>online therapist</h2>
                <div class="search">
                    <input id="search-online-therapist" type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list" id="online-therapist-list">
                    <?php displayUsers($onlineTherapists) ?>
                </div>
            </div>
            <div class="all-therapist show">
                <h2>Therapist</h2>
                <div class="search">
                    <input id="search-all-therapist" type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list" id="all-therapist-list">
                    <?php displayUsers($therapists) ?>
                </div>
            </div>
            <div class="schedules show">
                <h2>Shedules</h2>
                <div class="search">
                    <input id="search-all-schedules" type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list" id="all-schedules-list">
                <?php
                foreach ($schedules as $s) {                    
    
                    $user_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$s['user_id']}'"));
                    $therapist_row = mysqli_fetch_assoc( mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = '{$s['therapist_id']}'"));
                    echo"<div>
                            <div class='users-img-name'>
                                <img src='php/images/{$user_row['img']}' alt='img'>
                                <p>{$user_row['fname']} {$user_row['lname']}</p>
                            </div>
                            <div class='date'><span>{$s['date']}</span></div>
                            <div class='time'><span>{$s['start_time']} - {$s['end_time']}</span></div>
                            <div class='therapist-img-name'>
                                <img src='php/images/{$therapist_row['img']}' alt='img'>
                                <p>{$therapist_row['fname']} {$therapist_row['lname']}</p>
                            </div>
                        </div>";
                }?>
                </div>
            </div>
            <div class="add-therapist show">
                <h2>Adding therapist</h2>
                <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div class="name-details">
                        <div class="field input">
                            <label>First Name</label>
                            <input type="text" name="fname" placeholder="First name" required>
                        </div>
                        <div class="field input">
                            <label>Last Name</label>
                            <input type="text" name="lname" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="gender_and_birthdate">
                        <div class="field input gender">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" required>
                                <option value="" class="unbold">select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="field input">
                            <label>Birth Date</label>
                            <input type="date" name="birthDate" required>
                        </div>
                    </div>
                    <div class="field input">
                        <label for="specialization">Specialization</label>
                        <select id="specialization" name="specialization" required>
                            <option value="" class="unbold"> select Specialization</option>
                            <option value="Cognitive-behavioral therapy">Cognitive-behavioral therapy</option>
                            <option value="Dialectical behavior therapy">Dialectical behavior therapy</option>
                            <option value="Family therapy">Family therapy</option>
                            <option value="Psychodynamic therapy">Psychodynamic therapy</option>
                            <option value="Play therapy">Divorced</option>
                            <option value="other">Widowed</option>
                        </select>
                    </div>
                    <div class="field input">
                        <label>Phone number</label>
                        <input type="number" name="phone" placeholder="Enter your Phone" required>
                    </div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter new password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label>Select Image</label>
                        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                    </div>
                    <div class="field button">
                        <input type="submit" name="submit" value="Add">
                    </div>
                </form>
            </div>
            <div class="remove-therapist show">
                <h2>Removing Therapist</h2>
                <div class="search">
                    <input id="search-all-therapist-remove" type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list" id="all-therapist-list-remove">
                    <div>
                        <?php displayUsers($therapists, 'therapist') ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
<script>


    const leftSection = document.querySelector('.container .left-section');

    const online_client = document.querySelector('.container .right-section .online-client');
    const all_client = document.querySelector('.container .right-section .all-client');
    const online_therapist = document.querySelector('.container .right-section .online-therapist');
    const all_therapist = document.querySelector('.container .right-section .all-therapist');
    const schedules = document.querySelector('.container .right-section .schedules');
    const add_therapist = document.querySelector('.container .right-section .add-therapist');
    const remove_therapist = document.querySelector('.container .right-section .remove-therapist');

    const showOnlineClient = document.getElementById('show-online-client');
    const showAllClient = document.getElementById('show-all-client');
    const showOnlineTherapist = document.getElementById('show-online-therapist');
    const showAllTherapist = document.getElementById('show-all-therapist');

    const showSchedule = document.getElementById('show-shedules');
    const addTherapist = document.getElementById('show-add-therapist-form');
    const showTherapistToRemove = document.getElementById('show-therapist-remove');

    function foo(column, block) {
        column.style.flexDirection = 'column';

        online_client.style.display = 'none';
        all_client.style.display = 'none';
        online_therapist.style.display = 'none';
        all_therapist.style.display = 'none';
        schedules.style.display = 'none';
        add_therapist.style.display = 'none';
        remove_therapist.style.display = 'none';
        block.style.display = 'block';
    }

    showOnlineClient.addEventListener('click', () => {
        foo(leftSection, online_client)

    })
    showAllClient.addEventListener('click', () => {
        foo(leftSection, all_client)
    })
    showOnlineTherapist.addEventListener('click', () => {
        foo(leftSection, online_therapist)
    })
    showAllTherapist.addEventListener('click', () => {
        foo(leftSection, all_therapist)
    })
    showSchedule.addEventListener('click', () => {
        foo(leftSection, schedules)
    })
    addTherapist.addEventListener('click', () => {
        foo(leftSection, add_therapist)
    })
    showTherapistToRemove.addEventListener('click', () => {
        foo(leftSection, remove_therapist)
    })
</script>
<script src="javascript/pass-show-hide.js"></script>
<script src="javascript/addTherapist.js"></script>


</html>