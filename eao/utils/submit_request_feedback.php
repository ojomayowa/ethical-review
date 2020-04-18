<?php
session_start();
require "../../db/db.php";
if($_POST){

    $eao_id = $_SESSION['eao_staff_id'];
    $experiment_id = $_POST['experiment_id'];
    $feedback = $_POST['feedback'];
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    mysqli_query($connection, "DELETE FROM eao_feedbacks WHERE request_id = '$request_id' AND eao_id = '$eao_id'");
    $query = mysqli_query($connection, "INSERT INTO eao_feedbacks (request_id, eao_id, feedback, status) VALUES ('$request_id', '$eao_id', '$feedback', '$status')");
    $_SESSION['error'] = "Your feedback has been recorded successfully";
    header("location: ../details.php?experiment_id=$experiment_id");

}
?>