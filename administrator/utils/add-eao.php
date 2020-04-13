<?php
session_start();
require "../../db/db.php";
if($_POST){
    $name = trim($_POST['name']);
    $staff_id = trim($_POST['staff_id']);
    $email = trim($_POST['email']);
    $password = md5(trim($_POST['password']));

    if(empty($name) || empty($staff_id) || empty($email) || empty($password)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../add-eao.php");
        die();
    }

    $query = mysqli_query($connection, "SELECT * FROM experiment_approval_officers WHERE staff_id = '$staff_id' OR email = '$email'");
    $count = mysqli_num_rows($query);

    if($count > 0){
        $_SESSION['error'] = "Account already exists";
        header("location: ../add-eao.php");
        die();
    }

    $query = mysqli_query($connection, "INSERT INTO experiment_approval_officers (staff_id, name, email, password) VALUES ('$staff_id', '$name', '$email', '$password')");
    if($query){
        $_SESSION['success'] = "Registration successful. Login below";
        header("location: ../eaos.php");
        die();
    }else{
        $_SESSION['error'] = "Registration failed";
        header("location: ../add-eao.php");
        die();
    }
}
?>