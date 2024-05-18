<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        require_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

        if(isset($logout_id)){
            if($logout_id === 'admin'){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }else{
                $status = "Offline now";
                $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");
                $sql = mysqli_query($conn, "UPDATE therapist SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");
                
                if($sql){
                    session_unset();
                    session_destroy();
                    header("location: ../login.php");
                }
            }
        }else{
            header("location: ../profile.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>