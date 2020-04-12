<?php
session_start();
require "../db/db.php";
    if(!isset($_SESSION['id'])){
        $_SESSION['error'] = "Please login to access this page";
        header("location: index.php");
        die();
    }
    $student_id = $_SESSION['id'];
    $query = mysqli_query($connection, "SELECT * FROM experiments WHERE student_id = '$student_id' ORDER BY id DESC");
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
            <div class="main-left">
                <div class="form-body">
                    <h4> Add new experiment </h4>
                    <hr>
                    <form action="utils/add-exp.php" method="post">
                        <div class="form-wrapper">
                            <label> Experiment Title </label>
                            <input type="text" name="title" required>
                        </div>
                        <div class="form-wrapper">
                            <label> Experiment Description </label>
                            <textarea name="description" required></textarea>
                        </div>
                        <div class="form-wrapper">
                            <input type="submit" value="SUBMIT">
                        </div>
                    </form>
                </div>
            </div>
            <div class="main-right">
                <table>
                    <thead>
                    <tr class="table100-head">
                        <th class="column1"> S/N </th>
                        <th class="column2"> Experiment Title </th>
                        <th class="column3"> Approval Status </th>
                        <th class="column4"> Date Added </th>
                        <th class="column5"> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; while($row = mysqli_fetch_array($query)){?>
                        <tr>
                            <td class="column1"><?php echo $i++;?></td>
                            <td class="column2"><?php echo $row['title'];?></td>
                            <td class="column3">
                                <?php
                                $status = $row['approval_status'];
                                if($status == 1){
                                    echo "Approved";
                                }elseif($status == 2) {
                                    echo "Rejected";
                                }elseif($status == 3){ ?>

                                    Submitted for approval <br>
                                    <a href="edit-approval.php?id=<?php echo $row['id']?>">Edit approval request</a>

                                <?php
                                    }else{ ?>
                                        <a href="submit.php?id=<?php echo $row['id'];?>"> Submit for approval </a>
                                <?php } ?>
                            </td>
                            <td class="column4"><?php echo $row['created_at'];?></td>
                            <td class="column5"> <a href="utils/delete-exp.php?id=<?php echo $row['id'];?>">delete</a> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </main>
        <footer>
            Copyright <?php echo date('Y'); ?> All Rights Reserved.
        </footer>
    </body>
</html>
