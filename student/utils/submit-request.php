<?php
session_start();
require "../../db/db.php";
if ($_POST) {

    $student_id = $_SESSION['id'];
    $reasons = trim($_POST['reasons']);
    $experiment_id = $_POST['experiment_id'];

    if (empty($reasons)) {
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../submit.php?id=${$experiment_id}");
        die();
    }


    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];


    $file_info = pathinfo($file_name);
    $file_ext = $file_info['extension'];

    $extensions = array("pdf", "docx", "doc", "xls", "xlsx");

    if (in_array($file_ext, $extensions) === false) {
        $_SESSION['error'] = "File extension not allowed, please choose a JPEG or PNG file.";
        header("location: ../submit.php?id=${$experiment_id}");
        die();
    }

    if ($file_size > 2097152) {
        $_SESSION['error'] = "File size must be less than 2 MB";
        header("location: ../submit.php?id=${$experiment_id}");
        die();
    }

    move_uploaded_file($file_tmp, "../../documents/" . $file_name);

    $query = mysqli_query($connection, "INSERT INTO submitted_requests (student_id, experiment_id, reasons, file_location) VALUES ('$student_id', '$experiment_id', '$reasons', '$file_name')");

    //update experiment approval status to submitted
    mysqli_query($connection, "UPDATE experiments SET approval_status = 3 WHERE id = '$experiment_id'");

    if ($query) {
        $_SESSION['success'] = "Experiment approval request submitted successfully";
        header("location: ../home.php");
        die();
    }else{
        $_SESSION['error'] = "Unable to submit your experiment approval request";
        header("location: ../submit.php?id=${$experiment_id}");
        die();
    }
}
?>