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
            <form action="utils/update-exp.php" method="post">
                <div class="form-wrapper">
                    <label> Experiment Title </label>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="title" required value="<?php echo $row['title']; ?>">
                </div>
                <div class="form-wrapper">
                    <label> Experiment Description </label>
                    <textarea name="description" required><?php echo $row['description']; ?></textarea>
                </div>
                <div class="form-wrapper">
                    <input type="submit" value="UPDATE">
                </div>
            </form>
        <?php } ?>
    </div>

    <div class="clear"></div>
</main>
<footer>
    Copyright <?php echo date('Y'); ?> All Rights Reserved.
</footer>
</body>
</html>
