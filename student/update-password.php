<?php
session_start();
?>
<html>
    <head>
        <title> Student - Ethical Approver </title>
        <link rel="stylesheet" href="../css/main.css">
    </head>

    <body>
        <main>
            <section id="wrapper">

                    <form action="utils/update.php" method="post">
                        <div class="form-wrapper">
                            <h3> EXPERIMENT ETHICAL APPROVAL <br> WEB APPLICATION </h3>
                            <h4> STUDENT PASSWORD UPDATE PAGE </h4>
                        </div>
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
                        <div class="form-wrapper">
                            <label> Password </label>
                            <input type="password" name="password" required>
                        </div>

                        <div class="form-wrapper">
                            <label> Confirm Password </label>
                            <input type="password" name="confirm" required>
                        </div>

                        <div class="form-wrapper">
                            <input type="submit" required value="UPDATE PASSWORD">
                        </div>
                        <div class="form-wrapper">
                            Login <a href="index.php">here</a>
                        </div>
                    </form>
            </section>
        </main>
    </body>
</html>