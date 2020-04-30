<?php
session_start();
require "../../db/db.php";
if($_POST){
    $name = trim($_POST['full_name']);
    $staff_id = trim($_POST['staff_id']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);


    if(empty($name) || empty($staff_id) || empty($password) || empty($confirm)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../register.php");
        die();
    }

    if(strlen($staff_id) < 7){
        $_SESSION['error'] = "Staff ID length must be upto 7 characters";
        header("location: ../register.php");
        die();
    }

    if(strlen($password) < 7){
        $_SESSION['error'] = "Password length must be upto 7 characters";
        header("location: ../register.php");
        die();
    }

    if($password != $confirm){
        $_SESSION['error'] = "Passwords do not match";
        header("location: ../register.php");
        die();
    }

    $query = mysqli_query($connection, "SELECT * FROM administrators WHERE staff_id = '$staff_id'");
    $count = mysqli_num_rows($query);

    if($count > 0){
        $_SESSION['error'] = "Staff account already exists";
        header("location: ../register.php");
        die();
    }
    $password = md5($password);
    $query = mysqli_query($connection, "INSERT INTO administrators (name, staff_id, password) VALUES ('$name', '$staff_id', '$password')");
    if($query){
        $_SESSION['success'] = "Registration successful. Login below";
        header("location: ../index.php");
        die();
    }else{
        $_SESSION['error'] = "Registration failed";
        header("location: ../register.php");
        die();
    }
}
?><?php
