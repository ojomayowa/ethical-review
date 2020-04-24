<?php
session_start();
require "../../db/db.php";
if($_POST){
    $name = trim($_POST['full_name']);
    $student_id = trim($_POST['student_id']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);


    if(empty($name) || empty($student_id) || empty($email) || empty($password) || empty($confirm)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../register.php");
        die();
    }

    if(strlen($student_id) < 7){
        $_SESSION['error'] = "Student ID length length must be upto 7 characters";
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

    $query = mysqli_query($connection, "SELECT * FROM students WHERE student_id = '$student_id' OR email = '$email'");
    $count = mysqli_num_rows($query);

    if($count > 0){
        $_SESSION['error'] = "Student account already exists";
        header("location: ../register.php");
        die();
    }
    $password = md5($password);
    $query = mysqli_query($connection, "INSERT INTO students (fullname, student_id, email, password) VALUES ('$name', '$student_id', '$email', '$password')");
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
?>