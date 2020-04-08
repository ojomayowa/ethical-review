<?php
session_start();
require "../db/db.php";
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Please login to access this page";
    header("location: index.php");
    die();
}
$id = $_GET['id'];
$query = mysqli_query($connection, "SELECT * FROM experiments WHERE id = '$id'");
?>
<html>
<head>
    <title> Student - EXPERIMENT ETHICAL APPROVAL </title>
    <link rel="stylesheet" href="../css/app.css">
</head>

<body>
<header>
    <div class="left">
        EXPERIMENT ETHICAL APPROVAL WEB APPLICATION
    </div>
    <div class="right">
        <?php
        echo strtoupper($_SESSION['name']);
        ?>
        <a href="logout.php"> Logout </a>
    </div>
    <div class="clear"></div>
</header>
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
<main>
    <div class="main-left">
        <?php while ($row = mysqli_fetch_array($query)) { ?>
            <div class="form-body">
                <p>
                    <h4> Submit experiment for approval </h4>
                    <hr>

                    <b> Experiment Title</b> <br>
                    <?php echo $row['title']; ?> <br>

                    <b> Experiment Description</b> <br>
                    <?php echo $row['description']; ?>
                </p>
            </div>
        <?php } ?>
    </div>
    <div class="main-right">
        <div class="form-body" style="width: 400px; border: none">
            <h4> ADD NEW EXPERIMENT APPROVAL REQUEST </h4>
            <hr>
            <form action="utils/submit-exp.php" method="post" enctype="multipart/form-data">
                <div class="form-wrapper">
                    <label> <b>Reason why experiment should be approved (required)</b> </label>
                    <textarea name="reasons" required style="height: 200px;"></textarea>
                    <input type="hidden" name="experiment_id" value="<?php echo $_GET['id']; ?>">
                </div>
                <div class="form-wrapper">
                    <label> <b>Upload Backing Document (Allowed formats: pdf, doc, docx, xls, xlsx)</b> </label>
                    <input type="file" name="file" required>
                </div>
                <div class="form-wrapper">
                    <input type="submit" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</main>
<footer>
    Copyright <?php echo date('Y'); ?> All Rights Reserved.
</footer>
</body>
</html>
