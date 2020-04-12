<?php
session_start();
require "../../db/db.php";
if($_POST){

    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if(empty($description) || empty($title)){
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../edit-experiment.php?id=$id");
        die();
    }


    $query = mysqli_query($connection, "UPDATE experiments SET title = '$title', description = '$description' WHERE id = '$id'");
    if($query){
        $_SESSION['success'] = "Experiment edition successfully";
        header("location: ../home.php");
        die();
    }else{
        $_SESSION['error'] = "Experiment edition failed";
        header("location: ../edit-experiment.php?id=$id");
        die();
    }
}
?>