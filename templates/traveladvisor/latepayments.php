<?php 
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
     <!-- title -->  
    <title>Late Payments</title>
</head>
<body style=" background: #344a72; ">

   <!-- Navigation -->
   <nav id="main-nav">
    <div class="contain" style="padding: 1.8rem;">
            
            <a href="home.php">
                 <!-- This is the logo that appears on the top left -->
                    <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <ul>
                <!-- Nav Bar -->
                <li><a href="assignedBlanks.php">Assigned Blanks</a></li>
                <li><a href="tickets.php">Sell Tickets</a></li>
                <li><a href="soldticket.php" class="present">Sold Tickets</a></li>
                <li><a href="cancelTicket.php">Cancel Ticket</a></li>
                <li><a href="refundTicket.php">Refund Ticket</a></li>
            </ul>
           

            <form action="../logout2.php" method="POST">  
             <!-- log out button  -->                    
            <div class="item" style="padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 5px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn2">Log Out</button>
                    </div>
            </form> 
        </div>
    </nav>

    <header id="showcase">
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                    <div id="container" style="max-width: 90%;">
                    <div class="form-wrap" style="max-width: 100rem;text-align: center;">
                    <?php
                    //db connection
        $connection = mysqli_connect("localhost","root","","ats"); 
        $query = "SELECT a.fullname1,b.fullname1,a.amount1,a.datepaid1,b.soldby FROM latepayments a LEFT JOIN soldticket b ON a.fullname1 = b.fullname1 WHERE b.soldby = '".$_SESSION['username2']."'";
        $query_run = mysqli_query($connection,$query);
        ?>
    </table>
    <!-- Late Payments Made Title -->
    <h1 style="text-align: center; ">Late Payments Made</h1>
    <!-- Table -->
    <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <?php
        if(mysqli_num_rows($query_run) > 0) { ?> 
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 10px ">Full Name</th>
                <th style="border: 1px solid black;  padding: 10px">Amount Paid</th>
                <th style="border: 1px solid black;  padding: 10px">Date Paid</th>
                <th style="border: 1px solid black;  padding: 10px">Assigned By</th>
            </tr>
            </thead>
            <tbody>
        <?php
            while($row = mysqli_fetch_assoc($query_run)) {
                ?>
            <tr>
                <!-- data retreived from tables and it places it in the rows -->
                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['fullname1'] ?> </td>
                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['amount1'] ?> </td>
                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['datepaid1'] ?> </td>
                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['soldby'] ?> </td>
            </tr>
            <?php
            }}
            else {
                echo "No record found";

            }
    ?>
        </table>
                        </div>
                        </div>


                </div>
            </div>
        </div>
    </header>


       
    
</body>
</html>
