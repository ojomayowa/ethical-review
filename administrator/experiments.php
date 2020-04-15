<?php
session_start();
require "../db/db.php";
    if(!isset($_SESSION['administrator_id'])){
        $_SESSION['error'] = "Please login to access this page";
        header("location: index.php");
        die();
    }

    $submitted_requests = mysqli_query($connection, 'SELECT students.id AS sid, submitted_requests.id AS srid, experiments.id AS eid, students.*, experiments.*, submitted_requests.* FROM `submitted_requests` LEFT JOIN experiments ON submitted_requests.experiment_id = experiments.id LEFT JOIN students ON submitted_requests.student_id = students.student_id ORDER BY submitted_requests.id');
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
            <h4> Home </h4>
            <table>
                <thead>
                    <tr class="table100-head">
                        <th class="column1"> S/N </th>
                        <th class="column2"> Student Name </th>
                        <th class="column3"> Experiment Title </th>
                        <th class="column5"> Request Status </th>
                        <th class="column4"> Experiment Approval Officer </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while($row = mysqli_fetch_array($submitted_requests)){?>
                        <tr>
                            <td> <?php echo $i++;?></td>
                            <td> <?php echo $row['fullname']?></td>
                            <td> <?php echo $row['title']?></td>
                            <td>
                                <?php
                                $status = $row['approval_status'];
                                if($status == 1){
                                    echo "Approved";
                                }elseif($status == 2) {
                                    echo "Rejected";
                                }else{ ?>
                                    Not yet assigned
                                <?php } ?>

                            </td>
                            <td>
                                
                                <?php echo $row['eao_id']?>
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
