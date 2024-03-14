<div class="right patient table-container">
  <h1>Patient List</h1>
  <table>
    <tr>
      <th>Name</th>
      <th>Gender</th>
      <th>Age</th>
      <th>Email</th>
      <th>Relationship status</th>
      <th>Registered Date</th>
      <th>Symptom</th>
    </tr>

    <?php
    $output = "";
    $id = "";
    $sql = "SELECT * FROM users";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
      while ($row = mysqli_fetch_assoc($query)) {
        $birthdate = new DateTime($row['birthdate']);
        $today = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        $age = $age > 0 ? $age : '';
        $user_id = $row['unique_id'];
        $sql2 = "SELECT symptom FROM appointment WHERE user_id = $user_id";
        $query2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($query2) > 0) {
          while ($row2 = mysqli_fetch_assoc($query2)) {
            $symptom =  $row2['symptom'];
          }
        } else {
          $symptom = "";
        }

        $output .= '
          <tr>
            <td>
              <a href="profile.php?user_id=' . $row['unique_id'] . '&link=user_profile">' 
                . $row['fname'] . ' ' . $row['lname'] . '</td>
              </a>
            <td>' . $row['gender'] . '</td>
            <td>' . $age . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['relationship'] . '</td>
            <td>' . $row['r_date'] . '</td>
            <td>' . $symptom . '</td>
          </tr>';
      }
    }
    ?>
    <?php
    echo $output;
    ?>

  </table>

</div>