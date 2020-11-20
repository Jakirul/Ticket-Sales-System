<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');

//allows the refund log to work
$fh = fopen('refundlog.txt', 'w');
//db connection
$con = mysqli_connect("localhost","root","","ats");

//sql statement
$result = "SELECT fullname1,amount1,blanktypeandno1,refundedby FROM refunds WHERE refundedby = '".$_SESSION['username2']."'";  
$query_run = mysqli_query($con,$result);
//code to make the log work
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
    <!-- google font -->  
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <!-- title -->  
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
                <!-- Nav Bar -->
                <li><a href="assignedBlanks.php">Assigned Blanks</a></li>
                <li><a href="tickets.php"  >Sell Tickets</a></li>
                <li><a href="soldticket.php" >Sold Tickets</a></li>
                <li><a href="cancelTicket.php">Cancel Ticket</a></li>
                <li><a href="refundTicket.php" class="present">Refund Ticket</a></li>
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
    <div class="form-wrap" style="text-align: center;">
    <?php
        //db connection
        $connection = mysqli_connect("localhost","root","","ats");
        //search feature
        $search = mysqli_real_escape_string($connection, @$_POST['search']);
        //searches based on the refund table
        $query = "SELECT * FROM refunds WHERE (fullname1 LIKE '%$search%' OR amount1 LIKE '%$search%' OR blanktypeandno1 LIKE '%$search%') AND (refundedby = '".$_SESSION['username2']."')";
        $query_run = mysqli_query($connection,$query);
        ?>
    </table>
    <!-- Title that changes based on whose logged in -->
    <h1 style="text-align: center; font-family: 'Roboto Slab', serif;">Tickets Refunded By: <?php echo $_SESSION['username2'] ?></h1>
  <form action="" method="get" style="margin-top:-30px; margin-bottom: 30px;">
      <!-- Refund log button -->
 <a style=" background: #49c1a2; padding: 5px; " download href="refundlog.txt">Refund Log</a>

  </form>
    <!-- search button -->
    <form action="refundedticket.php" method="POST">
    <input type="text" name="search" placeholder="Search by Full Name or Amount Refunded">
    <button type="submit" name="submit-search">Search</button>
    </form>
    <!-- table -->   
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
                <!-- data retreived from tables and it places it in the rows -->
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
