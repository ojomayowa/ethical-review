<?php
session_start();
require "../../db/db.php";
if($_POST){
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));

    if(empty($username) || empty($password)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../index.php");
        die();
    }

    $query = mysqli_query($connection, "SELECT * FROM students WHERE (student_id = '$username' OR email = '$username') AND password = '$password' ");
    $count = mysqli_num_rows($query);

    if($count === 1){
        $fetch = mysqli_fetch_array($query);
        $_SESSION['id'] = $fetch['student_id'];
        $_SESSION['name'] = $fetch['fullname'];
        $_SESSION['success'] = "Login successful";
        header("location: ../home.php");
        die();
    }else{
        $_SESSION['error'] = "Login failed";
        header("location: ../index.php");
        die();
    }

}
?>