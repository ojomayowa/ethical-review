<?php
session_start();
require "../db/db.php";
    if(!isset($_SESSION['eao_staff_id'])){
        $_SESSION['error'] = "Please login to access this page";
        header("location: index.php");
        die();
    }
    $eao_id = $_SESSION['eao_staff_id'];
    $submitted_requests = mysqli_query($connection, "SELECT students.id AS sid, submitted_requests.id AS srid, experiments.id AS eid, approval_request_eao.id AS are_id, approval_request_eao.*, students.*, experiments.*, submitted_requests.* FROM `submitted_requests` LEFT JOIN experiments ON submitted_requests.experiment_id = experiments.id LEFT JOIN students ON submitted_requests.student_id = students.student_id LEFT JOIN approval_request_eao ON submitted_requests.id = approval_request_eao.request_id WHERE approval_request_eao.eao_id = '$eao_id' ORDER BY submitted_requests.id") or die(mysqli_error($connection));
?>
<html>
    <head>
        <title> ADMINISTRATOR - EXPERIMENT ETHICAL APPROVAL  </title>
        <link rel="stylesheet" href="../css/app.css">
    </head>

    <body>
        <header>
            <div class="left">
                EXPERIMENT ETHICAL APPROVAL WEB APPLICATION - EXPERIMENT APPROVAL OFFICER
            </div>
            <div class="right">
                <?php
                    echo strtoupper($_SESSION['eao_name']);
                ?>
                <a href="logout.php"> Logout </a>
            </div>
            <div class="clear"></div>
        </header>
        <nav>
            <ul>
                <li> <a href="home.php"> Home </a> </li>
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
            <h4 style="margin: 0"> Approval Requests </h4>
            <table style="margin: 0">
                <thead>
                    <tr class="table100-head">
                        <th class="column1"> S/N </th>
                        <th class="column2"> Student Name </th>
                        <th class="column3"> Experiment Title </th>
                        <th class="column5"> Your Response</th>
                        <th class="column4">  </th>
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
                                $request_id = $row['srid'];
                                $eao_id = $_SESSION['eao_staff_id'];
                                $q = mysqli_query($connection, "SELECT * FROM eao_feedbacks WHERE request_id = '$request_id' AND eao_id = '$eao_id'");
                                $fetch = mysqli_fetch_array($q);
                                if(mysqli_num_rows($q) == 1){
                                    if($fetch['status']){
                                        echo 'Approved by you';
                                    }else{
                                        echo 'Rejected by you';
                                    }
                                }else{
                                    echo 'Not yet reviewed by you';
                                }


                                ?>


                            </td>
                            <td>
                                <a href="details.php?experiment_id=<?php echo $row['eid'];?>">View details </a>
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
