<?php
session_start();
require "../../db/db.php";
if($_GET){

    $id = $_GET['id'];
    $query = mysqli_query($connection, "DELETE FROM experiments WHERE id = '$id'");

    $_SESSION['success'] = "Experiment deleted successfully";
    header("location: ../home.php");
    die();
}
?>