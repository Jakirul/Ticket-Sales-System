<?php
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php');
//this is the code for the refund log
$fh = fopen('refundlog.txt', 'w');
//db connection
$con = mysqli_connect("localhost","root","","ats");
//selects everything from refund table
$result = "SELECT fullname1,amount1,blanktypeandno1,refundedby FROM refunds ";  
$query_run = mysqli_query($con,$result);
//code to make the refund log work
while ($row = mysqli_fetch_array($query_run)) {          
    $last = end($row);          
    $num = mysqli_num_fields($query_run) ;    
    for($i = 0; $i < $num; $i++) {            
        fwrite($fh, $row[$i]);                      
        if ($row[$i] != $last)
           fwrite($fh, ", ");
    }                                                                 
    fwrite($fh, "\n");
}
fclose($fh);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <!-- Title -->  
    <title>Refunded Tickets</title>
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
                <!-- Navigation bar -->
                <li><a href="assignBlank.php">Assign Blank</a></li>
                <li><a href="assignedBlanks.php" >Assigned Blank</a></li>
                <li><a href="viewtickets.php">View Tickets</a></li>
                <li><a href="refundedticket.php"  class="present">Refunded Tickets</a></li>
            </ul>
            <?php 
                //this is the connection to the database
                $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                //this selects the information from the database
                $result = $connection->query("SELECT a.othername,a.fullname1,b.fullname from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY < NOW() AND a.datepaid = '0') ");
                // The php code is for the late payment notification. If there's a late payment, a notification pops up in the nav. if there's not, nothing will appear
                if ($result->num_rows != 0) { 
                $quantity = $result->num_rows;  ?>
                            <div class="item" style=" padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute; top: 10px; right: 90px;">
                            <a href="latepayment0.php" ><i style="color: #a00000;  font-size: 50px;" class="fas fa-bell"></i></a>
                            <h3 style="color: #800000; font-weight: bold; margin: 0 50px;"><?php echo $quantity;?> LATE Payment<?php echo $quantity > 1 ? "s": ""; ?> </h3>
                            </div>
                <?php } else { ?>
                    <div class="item" style=" padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute; top: 10px; right: 90px;">
                </div>
                    <?php 
                }
            ?>
            </div>
            <!-- log out button  --> 
            <form action="../logout2.php" method="POST">                 
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
    <div class="form-wrap" style="text-align: center;">
    <?php
        //Database connection
        $connection = mysqli_connect("localhost","root","","ats");
        //search feature
        $search = mysqli_real_escape_string($connection, @$_POST['search']);
        $query = "SELECT * FROM refunds WHERE (fullname1 LIKE '%$search%' OR amount1 LIKE '%$search%' OR blanktypeandno1 LIKE '%$search%') ";
        $query_run = mysqli_query($connection,$query);
        ?>
    </table>
    <!-- Title -->
    <h1 style="text-align: center; font-family: 'Roboto Slab', serif;">Tickets Refunded By All Advisors</h1>
  <form action="" method="get" style="margin-top:-30px; margin-bottom: 30px;">
  <!-- Refund log button that downloads the refund log txt file -->
 <a style=" background: #49c1a2; padding: 5px; " download href="refundlog.txt">Refund Log</a>

  </form>
  <!-- search button -->
    <form action="refundedticket.php" method="POST">
    <input type="text" name="search" placeholder="Search by Full Name or Amount Refunded">
    <button type="submit" name="submit-search">Search</button>
    </form>

    <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
           
            
            <?php
        if(mysqli_num_rows($query_run) > 0) {
            ?>
            <tbody>
             <thead>
            <tr>
                <th style="border: 1px solid black; padding: 10px ">Full Name</th>
                <th style="border: 1px solid black;  padding: 10px">Amount Refunded</th>
                <th style="border: 1px solid black;  padding: 10px">Blank Number</th>
            </tr>
            </thead>
            <?php
            while($row = mysqli_fetch_assoc($query_run)) {
                ?>
            <tr>
                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['fullname1'] ?> </td>
                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['amount1'] ?> </td>
                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['blanktypeandno1'] ?> </td>
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
