<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>

<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>  
    <!-- title --> 
    <title>Assigned Blanks</title>
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
                <li><a href="assignedBlanks.php" class="present">Assigned Blanks</a></li>
                <li><a href="tickets.php" >Sell Tickets</a></li>
                <li><a href="soldticket.php" >Sold Tickets</a></li>
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
                    
                    <div id="container" style="max-width: 90%;  overflow:auto;  ">
                    <div class="form-wrap" style="max-width: 100rem;text-align: center; height:800px;overflow:auto;">
                    <?php
                        //db connection
                        $connection = mysqli_connect("localhost","root","","ats");
                        //selects all from assignblank where the staffid is equal to the username currently logged in
                        $query = "SELECT * FROM assignblank WHERE staffid = '".$_SESSION['username2']."'";
                        $query_run = mysqli_query($connection,$query);
                        ?>
                        <!-- Assigned Blank Title -->
                        <h1 style="text-align: center; ">Blanks Assigned</h1>
                        <!-- Table -->
                        <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="border: 1px solid black; padding: 10px ">Blank Type and Number</th>
                                <th style="border: 1px solid black;  padding: 10px">Assigned By</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                        if(mysqli_num_rows($query_run) > 0) {
                            while($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                            <tr>
                                 <!-- Retreives data from assignblank and puts it in row -->
                                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['blanktypeandno'] ?> </td>
                                <td style="border: 1px solid black; text-align: center;   padding: 10px"><?php echo $row['email'] ?> </td>
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
