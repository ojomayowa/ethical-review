<?php
session_start();
require "../db/db.php";
    if(!isset($_SESSION['administrator_id'])){
        $_SESSION['error'] = "Please login to access this page";
        header("location: index.php");
        die();
    }

    $submitted_requests = mysqli_query($connection, 'SELECT * FROM experiment_approval_officers ORDER BY name ASC')
?>
<html>
    <head>
        <title> ADMINISTRATOR - EXPERIMENT ETHICAL APPROVAL  </title>
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
                <li> <a href="home.php"> Home </a> </li>
                <li> <a href="eaos.php"> Experiment Approval Officers </a> </li>
                <li> <a href="logout.php"> Logout </a> </li>
            </ul>
        </nav>
        <div class="status">
            <?php
            if(isset($_SESSION['success'])){
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }
            ?>

            <?php
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>
        </div>
        <main>
            <h4> Add Experiment Approval Officers </h4>
            <form action="utils/add-eao.php" method="post">
                <div class="main-left">
                    <form action="utils/add-eao.php" method="post">
                            <div class="form-wrapper">
                                <label> Staff ID </label>
                                <input type="text" name="staff_id" required >
                            </div>
                            <div class="form-wrapper">
                                <label> Name </label>
                                <input type="text" name="name" required >
                            </div>
                        <div class="form-wrapper">
                            <label> Email Address </label>
                            <input type="text" name="email" required >
                        </div>
                        <div class="form-wrapper">
                            <label> Password </label>
                            <input type="password" name="password" required >
                        </div>

                            <div class="form-wrapper">
                                <input type="submit" value="ADD EAO TO DATABASE">
                            </div>
                        </form>
                </div>
                <div class="clear"></div>
            </form>
        </main>
        <footer>
            Copyright <?php echo date('Y'); ?> All Rights Reserved.
        </footer>
    </body>
</html>
