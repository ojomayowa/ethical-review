<?php
session_start();
require "../../db/db.php";
if($_GET){

    $id = $_GET['id'];
    $query = mysqli_query($connection, "DELETE FROM experiment_approval_officers WHERE id = '$id'");

    $_SESSION['success'] = "Experiment Approval Officer deleted successfully";
    header("location: ../eaos.php");
    die();
}
?>