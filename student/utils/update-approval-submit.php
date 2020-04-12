<?php
session_start();
require "../../db/db.php";
if ($_POST) {

    $student_id = $_SESSION['id'];
    $reasons = trim($_POST['reasons']);
    $experiment_id = $_POST['experiment_id'];

    //echo $experiment_id; die();
    $id = $_POST['id'];

    if (empty($reasons)) {
        $_SESSION['error'] = "One or more field is empty";
        header("location: ../edit-approval.php?id=$experiment_id");
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
        header("location: ../edit-approval.php?id=$experiment_id");
        die();
    }

    if ($file_size > 2097152) {
        $_SESSION['error'] = "File size must be less than 2 MB";
        header("location: ../edit-approval.php?id=$experiment_id");
        die();
    }

    move_uploaded_file($file_tmp, "../../documents/" . $file_name);


    $query = mysqli_query($connection, "UPDATE submitted_requests SET reasons = '$reasons', file_location = '$file_name' WHERE id = '$id'") or die(mysqli_error($connection));

    if ($query) {
        $_SESSION['success'] = "Experiment approval request edited successfully";
        header("location: ../home.php");
        die();
    } else {
        $_SESSION['error'] = "Unable to edit your experiment approval request";
        header("location: ../edit-approval.php?id=$experiment_id");
        die();
    }
}
?>