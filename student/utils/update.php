<?php
session_start();
require "../../db/db.php";
if($_POST){
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);
    $id = $_SESSION['reset_id'];

    if(empty($password) || empty($confirm)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../update-password.php");
        die();
    }

    if(strlen($password) < 7){
        $_SESSION['error'] = "Password length must be upto 7 characters";
        header("location: ../update-password.php");
        die();
    }

    if($password != $confirm){
        $_SESSION['error'] = "Passwords do not match";
        header("location: ../update-password.php");
        die();
    }
    $password = md5($password);
    $query = mysqli_query($connection, "UPDATE students SET password = '$password' WHERE id = '$id'");


    if($query){
        unset($_SESSION['reset_id']);
        $_SESSION['success'] = "Password has been reset. Please login below";
        header("location: ../index.php");
        die();
    }else{
        $_SESSION['error'] = "Unable to reset password. Please try again";
        header("location: ../reset.php");
        die();
    }

}
?>