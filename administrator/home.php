<?php
session_start();
require "../db/db.php";
    if(!isset($_SESSION['staff_id'])){
        $_SESSION['error'] = "Please login to access this page";
        header("location: index.php");
        die();
    }
?>
<html>
    <head>
        <title> ADMINISTRATOR - EXPERIMENT ETHICAL APPROVAL  </title>
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

        </main>
        <footer>
            Copyright <?php echo date('Y'); ?> All Rights Reserved.
        </footer>
    </body>
</html>
