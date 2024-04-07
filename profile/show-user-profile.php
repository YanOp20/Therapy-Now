<?php
if (isset($_GET['user_id'])) {
$user_id = $_GET['user_id'];
$sql_p = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_GET['user_id']}");

if (mysqli_num_rows($sql_p) > 0) {
while ($row = mysqli_fetch_array($sql_p)) {

?>
<div class="right">
    <style>

    </style>
    <?php
$birthdate = new DateTime($row['birthdate']);
// Create a DateTime object for today
$today = new DateTime('today');
// Calculate the difference between the two dates and get the years
$age = $birthdate->diff($today)->y;

?>
    <img src="php/images/<?php echo $row['img']; ?>" alt="">
    <!-- <h2><?= $row['fname'] . '  ' . $row['lname'] ?></h2> -->
    <ul>
        <br><br>
        <li><strong>First
                Name:
            </strong>
            <span><?= $row['fname'] ?>
            </span>
        </li>
        <li><strong>Last
                Name:
            </strong>
            <span><?= $row['lname'] ?></span>
        </li>
        <li><strong>Gender:
            </strong>
            <span><?= $row['gender'] ?></span>
        </li>
        <li><strong>Age:
            </strong>
            <span><?= $age ?></span>
        </li>
        <li><strong>Email:
            </strong>
            <span><?= $row['email'] ?></span>
        </li>
        <li><strong>Relationship
                status:
            </strong>
            <span><?= $row['relationship'] ?></span>
        </li>
    </ul>
</div>

<?php
}
}
} else {
echo 'users in prolbe';
}