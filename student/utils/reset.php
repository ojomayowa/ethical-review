<?php
session_start();
require "../../db/db.php";
if($_POST){
    $username = trim($_POST['username']);

    if(empty($username)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../reset.php");
        die();
    }

    $query = mysqli_query($connection, "SELECT * FROM students WHERE (student_id = '$username' OR email = '$username')");
    $count = mysqli_num_rows($query);

    if($count === 1){
        $fetch = mysqli_fetch_array($query);
        $_SESSION['reset_id'] = $fetch['id'];
        $_SESSION['success'] = "Reset your password below";
        header("location: ../update-password.php");
        die();
    }else{
        $_SESSION['error'] = "Invalid student id or email";
        header("location: ../reset.php");
        die();
    }

}
?>