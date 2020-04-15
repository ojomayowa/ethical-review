<?php
session_start();
require "../db/db.php";
if (!isset($_SESSION['administrator_id'])) {
    $_SESSION['error'] = "Please login to access this page";
    header("location: index.php");
    die();
}
$id = $_GET['experiment_id'];
$submitted_requests = mysqli_query($connection, "SELECT students.id AS sid, submitted_requests.id AS srid, experiments.id AS eid, students.*, experiments.*, submitted_requests.* FROM `submitted_requests` LEFT JOIN experiments ON submitted_requests.experiment_id = experiments.id LEFT JOIN students ON submitted_requests.student_id = students.student_id WHERE experiments.id = '$id'");

$eaos = mysqli_query($connection, 'SELECT * FROM experiment_approval_officers ORDER BY name ASC')
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
        </div>
        <div class="main-right">
            <h5 style="font-weight: bold;"><b>Approval Request Details</b></h5>
            <p><b> Reasons :</b> <br>
                <?php echo $row['reasons']; ?>
            </p>
            <hr>
            <p><b>Upload Documents:</b> <br>
                <?php echo $row['file_location']; ?> <br> <a href="../documents/<?php echo $row['file_location'] ?>">
                    Download </a>
            </p>
            <br>
            <br>
            <hr>
            <b>Select at least 2 officers and assign to them</b>
            <table style="margin-top: 20px;">
                <thead>
                    <tr class="table100-head">
                        <th class="column1">  </th>
                        <th class="column2"> Name </th>
                        <th class="column3"> Email </th>
                    </tr>
                </thead>
                <tbody>
                    <form action="utils/assign_experiment_to_eao.php" method="post">
                        <?php $i = 1; while($row1 = mysqli_fetch_array($eaos)){?>
                            <tr>
                                <td> <input type="checkbox" name="eao[]" value="<?php echo $row1['id'];?>"> </td>
                                <td> <?php echo $row1['name']?></td>
                                <td> <?php echo $row1['email']?></td>
                            </tr>
                        <?php }?>
                        <tr>
                            <td colspan="3">
                                <input type="hidden" name="request_id" value="<?php echo $row['srid']; ?>">
                                <input type="hidden" name="experiment_id" value="<?php echo $id; ?>">
                                <input type="submit" value="ASSIGN" style="width: 100px;">
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>

    <?php } ?>
    <div class="clear"></div>
</main>
<footer>
    Copyright <?php echo date('Y'); ?> All Rights Reserved.
</footer>
</body>
</html>
