<?php
session_start();
require "../../db/db.php";
if($_POST){

    $approval = $_POST['status'];
    $experiment_id = $_POST['experiment_id'];

    $query = mysqli_query($connection, "UPDATE experiments SET approval_status = '$approval' WHERE id = '$experiment_id'");

    if($approval){
        $_SESSION['success'] = "Experiment approval request was approved";
    }else{
        $_SESSION['success'] = "Experiment approval request was rejected";
    }

    header("location: ../home.php");

}
?>