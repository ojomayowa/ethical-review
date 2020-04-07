<?php
session_start();
require "../../db/db.php";
if($_POST){

    $student_id = $_SESSION['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if(empty($description) || empty($title)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../home.php");
        die();
    }


    $query = mysqli_query($connection, "INSERT INTO experiments (student_id, title, description) VALUES ('$student_id', '$title', '$description')");
    if($query){
        $_SESSION['success'] = "Experiment added successfully";
        header("location: ../home.php");
        die();
    }else{
        $_SESSION['error'] = "Experiment addition failed";
        header("location: ../home.php");
        die();
    }
}
?>