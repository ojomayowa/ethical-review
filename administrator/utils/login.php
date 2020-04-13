<?php
session_start();
require "../../db/db.php";
if($_POST){
    $staff_id = trim($_POST['staff_id']);
    $password = md5(trim($_POST['password']));

    if(empty($staff_id) || empty($password)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../INDEX.php");
        die();
    }

    $query = mysqli_query($connection, "SELECT * FROM administrators WHERE staff_id = '$staff_id'  AND password = '$password' ");
    $count = mysqli_num_rows($query);

    if($count === 1){
        $fetch = mysqli_fetch_array($query);
        $_SESSION['administrator_id'] = $fetch['staff_id'];
        $_SESSION['name'] = $fetch['name'];
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