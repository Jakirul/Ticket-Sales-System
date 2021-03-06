<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
    <!-- title -->
    <title>Used Blanks</title>
</head>
<!-- table styling -->
<style>
th, td {
    padding: 5px;
}
</style>
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
                <li><a href="blankstock.php">Blank Stock</a></li>
                <li><a href="assignBlank.php">Assign Blank</a></li>
                <li><a href="assignedBlanks.php" >Assigned Blank</a></li>
                <li><a href="#" class="present">Used Blanks</a></li>
            </ul>
            <form action="../logout1.php" method="POST">                 
            <div class="item" style="padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 5px;right: 10px;">
                <!-- log out button  -->   
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn1">Log Out</button>
                    </div>
            </form> 
        </div>
    </nav>

    <header id="showcase">
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                    <div id="container" style="max-width: 100%;">
                    <div class="form-wrap" style="max-width: 100rem;text-align: center; overflow: auto">
                   

                <?php
                    //db connection
                    $connection = mysqli_connect("localhost","root","","ats");
                     //seach button
                    $search = mysqli_real_escape_string($connection, @$_POST['search']);
                    //sql query that allows you to search based on the soldticket table
                    $query = "SELECT * FROM soldticket WHERE blanktypeandno1 LIKE '%$search%' OR soldby LIKE '%$search%' GROUP BY(blanktypeandno1)";
                    $query_run = mysqli_query($connection,$query); ?>

                    <!-- Used blank title -->
                    <h1 style="text-align: center; ">Used Blanks</h1>
            
                    <form action="usedblanks.php" method="POST">
                    <!-- Search button -->
                    <input type="text" name="search" placeholder="Search by Blanks, Sold By or Sold To">
                    <button type="submit" name="submit-search">Search</button>
                    </form>
                    <!-- Table -->
                    <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                        
                                <th style="border: 1px solid black; ">Blank Type and Blank No</th>
                                <th style="border: 1px solid black;">Sold By</th>
                                <th style="border: 1px solid black;">Sold To</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                        if(mysqli_num_rows($query_run) > 0) {
                            while($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                            
                            <tr>
                            <!-- Retreives data from the table stated in the sql statement and puts it inside each row -->
                                <td style="border: 1px solid black; text-align: center;  "><?php echo $row['blanktypeandno1'] ?> </td>
                                <td style="border: 1px solid black;"><?php echo $row['soldby'] ?> </td>
                                <td style="border: 1px solid black;"><?php echo $row['fullname1'] ?> <?php echo $row['othername'] ?> </td>
                               
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
