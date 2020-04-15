<?php
session_start();
require "../../db/db.php";
if($_POST){

    $officers = $_POST['eao'];
    $experiment_id = $_POST['experiment_id'];
    $count = count($officers);

    if($count < 2){
        $_SESSION['error'] = "Experiment must be assigned to atleast Two Experiment Approval Officers";
        header("location: ../details.php?experiment_id=$experiment_id");
        die();
    }

    $request_id = $_POST['request_id'];

    foreach($officers as $officer){
        $query = mysqli_query($connection, "INSERT INTO eao_request_officer (request_id, eao_id) VALUES ('$request_id', '$officer')");
    }


    $_SESSION['error'] = "Experiment has been assigned the selected officers";
    header("location: ../details.php?experiment_id=$experiment_id");

}
?>