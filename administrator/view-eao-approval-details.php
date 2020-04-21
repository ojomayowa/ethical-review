<?php
session_start();
require "../db/db.php";
if (!isset($_SESSION['administrator_id'])) {
    $_SESSION['error'] = "Please login to access this page";
    header("location: index.php");
    die();
}
$id = $_GET['experiment_id'];
$request_id = $_GET['id'];
$submitted_requests = mysqli_query($connection, "SELECT students.id AS sid, submitted_requests.id AS srid, experiments.id AS eid, students.*, experiments.*, submitted_requests.* FROM `submitted_requests` LEFT JOIN experiments ON submitted_requests.experiment_id = experiments.id LEFT JOIN students ON submitted_requests.student_id = students.student_id WHERE experiments.id = '$id'");
$eaos = mysqli_query($connection, 'SELECT * FROM experiment_approval_officers ORDER BY name ASC');


$query = mysqli_query($connection, "SELECT * FROM approval_request_eao LEFT JOIN experiment_approval_officers ON approval_request_eao.eao_id = experiment_approval_officers.staff_id LEFT JOIN eao_feedbacks ON approval_request_eao.request_id = eao_feedbacks.request_id WHERE approval_request_eao.request_id = '$request_id'");

?>
<html>
<head>
    <title> ADMINISTRATOR - EXPERIMENT ETHICAL APPROVAL </title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/app.css">
</head>

<body>
<header>
    <div class="left">
        EXPERIMENT ETHICAL APPROVAL WEB APPLICATION - ADMINISTRATOR
    </div>
    <div class="right">
        <?php
        echo strtoupper($_SESSION['name']);
        ?>
        <a href="logout.php"> Logout </a>
    </div>
    <div class="clear"></div>
</header>
<nav>
    <ul>
        <li><a href="home.php"> Home </a></li>
        <li><a href="eaos.php"> Experiment Approval Officers </a></li>
        <li><a href="logout.php"> Logout </a></li>
    </ul>
</nav>
<div class="status">
    <?php
    if (isset($_SESSION['success'])) {
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    }
    ?>

    <?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
</div>
<main style="margin-top: 60px">
    <?php while ($row = mysqli_fetch_array($submitted_requests)) { ?>
        <div class="main-left">
            <h5 style="font-weight: bold;"><b>Experiment Details</b></h5>
            <p><b>Title:</b> <br>
                <?php echo $row['title']; ?>
            </p>
            <hr>
            <p><b>Description:</b> <br>
                <?php echo $row['description']; ?>
            </p>

            <h5 style="font-weight: bold;"><b>Approval Request Details</b></h5>
            <p><b> Reasons :</b> <br>
                <?php echo $row['reasons']; ?>
            </p>
            <hr>
            <p><b>Backing Documents:</b> <br>
                <?php echo $row['file_location']; ?> <br> <a href="../documents/<?php echo $row['file_location'] ?>">
                    Download </a>
            </p>
        </div>
        <div class="main-right">
            <b>Experiment Approval Feedbacks</b>
            <hr>
            <?php while($p = mysqli_fetch_array($query)){?>
                <b>EAO Name</b>: <?php echo $p['name']; ?> <br>
                <b>FEEDBACK</b>: <?php echo $p['feedback']; ?><br>
                <b>APPROVAL STATUS</b> <?php echo $p['status'] ? 'Approved' : 'Rejected'; ?>
                <br><br>
            <?php }?>

            <b>Administrator Final Approval</b>
            <form action="utils/final-approval.php" method="post">
                <input type="hidden" name="experiment_id" value="<?php echo $id?>">
                <select name="status" required>
                    <option value="" selected></option>
                    <option value="1"> Approve </option>
                    <option value="2"> Reject </option>
                </select> <br>
                <input type="submit" value="SUBMIT">
            </form>
            <hr>
        </div>

    <?php } ?>
    <div class="clear"></div>
</main>
<footer>
    Copyright <?php echo date('Y'); ?> All Rights Reserved.
</footer>
</body>
</html>
