<?php
session_start();
    if(!isset($_SESSION['id'])){
        $_SESSION['error'] = "Please login to access this page";
        header("location: index.php");
        die();
    }

?>
<html>
    <head>
        <title> Student - EXPERIMENT ETHICAL APPROVAL  </title>
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
        <main>

        </main>
        <footer>

        </footer>
    </body>
</html>
