<?php
session_start();
require_once "config.php";

// Function to fetch user or therapist data based on email
function fetchUserOrTherapist($conn, $email) {
    // Use prepared statements for security
    // First, check the users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['data' => $result->fetch_assoc(), 'table' => 'users'];
    }

    // Check the therapist table
    $stmt = $conn->prepare("SELECT * FROM therapist WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['data' => $result->fetch_assoc(), 'table' => 'therapist'];
    }

    // Return null if no match found
    return null;
}

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $_SESSION['email'] = $email;

    if (!empty($email)) {
        $result = fetchUserOrTherapist($conn, $email);
        
        header('Content-Type: application/json');

        if ($result) {
            $row = $result['data'];
            echo json_encode([
                'message' => 'email',
                'first_name' => $row['fname'],
                'last_name' => $row['lname'],
                'email' => $row['email'],
                'img' => $row['img']
            ]);
        } else {
            // Email does not exist
            echo json_encode([
                'message' => "$email - This email does not exist!"
            ]);
        }
    } else {
        // Email field is empty
        echo json_encode([
            'message' => 'Please enter your email address!'
        ]);
    }
}

// Handle password and confirm password
if (isset($_POST['password']) && isset($_POST['c-password'])) {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c-password']);

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $result = fetchUserOrTherapist($conn, $email);
        $row = $result['data'];
        $table = $result['table'];
    }

    header('Content-Type: application/json');

    if (!empty($password) && !empty($c_password)) {
        if ($password === $c_password) {
            // Passwords match
            $status = "Active now";

            if (isset($row)) {
                // Update password in users or therapist table based on user data
                $stmt = $conn->prepare("UPDATE $table SET status = ?, password = ? WHERE unique_id = ?");
                $stmt->bind_param("ssi", $status, $password, $row['unique_id']);

                if ($stmt->execute()) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo json_encode([
                        'message' => 'success'
                    ]);
                } else {
                    echo json_encode([
                        'message' => "Something went wrong. Please try again! Unique ID: " . $row['unique_id']
                    ]);
                }
            } else {
                echo json_encode([
                    'message' => "No user or therapist data available to update."
                ]);
            }
        } else {
            // Passwords do not match
            echo json_encode([
                'message' => 'Passwords do not match.'
            ]);
        }
    } else {
        // Missing password or confirm password fields
        echo json_encode([
            'message' => 'You must fill all the fields.'
        ]);
    }
}
?>
