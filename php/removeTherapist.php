<?php
require_once 'config.php'; // Include your database connection file

if (!empty($_POST['remove'])) {
    $therapist_id = $_POST['remove'];
    if($therapist_id == '40000') return "false";
    error_log("Remove request received: Therapist ID = " . $therapist_id); // Log the received ID
    // Check if the therapist has associated appointments
    $check_sql = "SELECT * FROM appointment WHERE therapist_id = '{$therapist_id}'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if ($check_result) {
        if (mysqli_num_rows($check_result) > 0) {
            echo "Cannot remove therapist as there are associated appointments.";
        } else {
            // Attempt to delete the therapist
            $delete_sql = "DELETE FROM therapist WHERE unique_id = '{$therapist_id}'";
            $delete_result = mysqli_query($conn, $delete_sql);
            
            if ($delete_result) {
                if (mysqli_affected_rows($conn) > 0) {
                    echo "success";
                } else {
                    echo "Error: Therapist not found or already removed.";
                }
            } else {
                echo "Error removing therapist: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error querying appointments: " . mysqli_error($conn);
    }
} else {
    echo "Something went wrong.";
}
?>
