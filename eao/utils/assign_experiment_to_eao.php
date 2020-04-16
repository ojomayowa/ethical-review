<?php
session_start();
require "../../db/db.php";
if($_POST){

    $eao_id = $_SESSION['eao_staff_id'];
    $experiment_id = $_POST['experiment_id'];
    $feedback = $_POST['feedback'];
    $request_id = $_POST['request_id'];

    $query = mysqli_query($connection, "INSERT INTO eao_feedback (request_id, eao_id, feedback) VALUES ('$request_id', '$eao_id')");
    $_SESSION['error'] = "Experiment has been assigned the selected officers";
    header("location: ../details.php?experiment_id=$experiment_id");

}
?>