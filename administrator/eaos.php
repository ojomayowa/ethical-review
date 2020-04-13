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
                <li> <a href="requests.php"> Approval Requests </a> </li>
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
            <h4> Experiment Approval Officers - <a href="add-eaO.php">add new</a></h4>
            <table>
                <thead>
                    <tr class="table100-head">
                        <th class="column1"> S/N </th>
                        <th class="column2"> Name </th>
                        <th class="column3"> Email </th>
                        <th class="column5"> Date Added </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while($row = mysqli_fetch_array($submitted_requests)){?>
                        <tr>
                            <td> <?php echo $i++;?></td>
                            <td> <?php echo $row['name']?></td>
                            <td> <?php echo $row['email']?></td>
                            <td> <?php echo $row['created_at']?>
                                <br>
                                <a href="utils/delete-eao.php?id=<?php echo $row['id']?>">delete</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </main>
        <footer>
            Copyright <?php echo date('Y'); ?> All Rights Reserved.
        </footer>
    </body>
</html>
