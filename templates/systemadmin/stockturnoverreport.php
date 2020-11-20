<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php'); ?>

<!DOCTYPE html>
<php lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- Roboto Slab font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
      <!-- title -->
    <title>Stock Turnover Report</title>
     <!-- table styling -->
    <style>
        table, th, td {
        border: 1px solid black;
        }
        table {
        border-collapse: collapse;
        }
        table {
        width: 100%;
        }

        th {
        height: 50px;
        }
    </style>
     <!-- printing styling -->
    <style type="text/css" media="print">
        @media print {  
        nav {
            visibility: hidden;
        }
        @page {
        size:400mm 210mm;   
        margin-top:-70px;
        }
        }
    </style>
</head>
<body>
<nav id="main-nav">
<div class="contain" style="padding: 2.4rem;">
            
            <a href="home.php">
                 <!-- This is the logo that appears on the top left -->
                <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <ul>
                <!-- Navigation bar -->
                <li style="margin-left: 50px;"><a href="generatereport.php" class="present">Stock Turnover Report</a></li>
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
       <div class="showcase-contain">
           <div class="showcase-content">     
                <div id="container" style="max-width: 100%;">
                <div class="form-wrap" style="max-width: 150rem;text-align: center; overflow: auto">
                <?php
                    //db connection
                    $connection = mysqli_connect("localhost","root","","ats");
                    //seach button
                    if(isset($_POST['search'])) {
                        $txtStartDate = $_POST['txtStartDate'];
                        $txtEndDate = $_POST['txtEndDate'];
                        $query_run = mysqli_query($connection,"SELECT CONCAT(blanktype,blankno) AS aa FROM blankstockhistory WHERE date1 BETWEEN '$txtStartDate' AND '$txtEndDate'");
                        $query_run1 = mysqli_query($connection,"SELECT a.blanktypeandno1,b.username,b.id FROM soldticket a INNER JOIN systemuser b on a.soldby = b.username WHERE a.date1 BETWEEN '$txtStartDate' AND '$txtEndDate'  UNION SELECT a.blanktypeandno,b.username,b.id FROM assignblank a INNER JOIN systemuser b ON a.staffid = b.username WHERE a.date1 BETWEEN '$txtStartDate' AND '$txtEndDate'  ORDER BY `blanktypeandno1` ASC");
                        $query_run2 = mysqli_query($connection,"SELECT a.blanktypeandno,b.id FROM assignblank a INNER JOIN systemuser b WHERE b.username = a.staffid AND a.date1 BETWEEN '$txtStartDate' AND '$txtEndDate'");
                        $query_run3 = mysqli_query($connection,"SELECT blanktypeandno1 FROM soldticket WHERE date1 BETWEEN '$txtStartDate' AND '$txtEndDate'");
                        $query_run4 = mysqli_query($connection,"SELECT blanktypeandno FROM adminassignedblanks ");
                    }
                    ?>
                
                <form action="" method="post">
                <!-- Stock Turnover Title -->
                <h1 style="text-align: center; font-family: 'Roboto Slab', serif;">Stock Turnover Report</h1>
                <form action="" method="post">
                     
                    <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
                    <input  type="date" name="txtStartDate">
                    <input  type="date" name="txtEndDate">
                    <input type="submit" name="search" value="Search" style="margin-top:-60px;">
                    <!-- printing button -->
                    <input id="print" type="button" name="search" onclick="window.print()" value="Print Report" />
                </form>
        
        
            <?php 
            if (isset($_POST['txtStartDate'])) { ?>
                <h1>Report for period: <?php echo date("d F Y",strtotime($txtStartDate)) ?> to <?php echo date("d F Y",strtotime($txtEndDate)) ?></h1> 
            <?php } ?>
                    <!-- table -->
                    <table  style="margin-left: auto; margin-right: auto; margin-top: 50px; text-align: center; " class="table table-bordered" id="dataTable" cellspacing="0">
                            <?php    
                        if(@mysqli_num_rows(@$query_run) > 0) { ?>
                            <thead>
                            <tr style="font-size: 20px;">
                                <th style="border: 1px solid black; font-size: 20px;" colspan="3">Received Blanks</th>
                                <th style="border: 1px solid black; font-size: 20px;" colspan="3">Assigned/Used Blanks</th>
                                <th style="border: 1px solid black; font-size: 20px;" colspan="5">Final Amounts</th>
                            </tr>
                            <tr style="font-size: 20px;">
                                <th style="border: 1px solid black; font-size: 20px;" colspan="1">Agent's Stock</th>
                                <th style="border: 1px solid black; font-size: 20px;" colspan="2">Sub Agents'</th>
                                <th style="border: 1px solid black; font-size: 20px;" colspan="3">Sub Agents'</th>
                                <th style="border: 1px solid black; font-size: 20px;" colspan="1">Agent's Amount</th>
                                <th style="border: 1px solid black; font-size: 20px;" colspan="3">Sub Agent's Amonts</th>
                             </tr>
                             <tr style="font-size: 20px;">
                                <th style="border: 1px solid black; font-size: 20px;">From/To Blanks</th>
                                <th style="border: 1px solid black; font-size: 20px;">Code</th>
                                <th style="border: 1px solid black; font-size: 20px;">From/To Blanks</th>
                                <th style="border: 1px solid black; font-size: 20px;">Code</th>
                                <th style="border: 1px solid black; font-size: 20px;">Assigned (From/To)</th>
                                <th style="border: 1px solid black; font-size: 20px;">Used (From/To)</th>
                                <th style="border: 1px solid black; font-size: 20px;">From/To</th>
                                <th style="border: 1px solid black; font-size: 20px;">Code</th>
                                <th style="border: 1px solid black; font-size: 20px;">From/To</th>
                            </tr>
                            </thead>
                            <tbody>
                         <?php
                           
                            while($row = mysqli_fetch_assoc(@$query_run)) {
                                ?>
                            <tr>
                            <?php $row22 = mysqli_fetch_assoc(@$query_run1); ?>
                            <?php $row3 = mysqli_fetch_assoc(@$query_run3); ?>
                            <?php  $row4 = mysqli_fetch_assoc(@$query_run4); ?>
                                <td style="border: 1px solid black; font-size: 20px;"><?php echo $row['aa'] ?>  </td>
                               
                                <?php
                                
                                if (empty($row22['id'])) {
                                    echo "<td></td>"; 
                                } else { 
                                echo "<td>" . $row22['id'] . "</td>";
                                }
                                ?>

                                <?php
                                
                                if (empty($row22['blanktypeandno1'])) {
                                    echo "<td></td>"; 
                                } else { 
                                echo "<td>" . $row22['blanktypeandno1'] . "</td>";
                                }
                                ?>
                                 <?php
                                
                                if (empty($row22['id'])) {
                                    echo "<td></td>"; 
                                } else { 
                                echo "<td>" . $row22['id'] . "</td>";
                                }
                                ?>
                                <?php
                                
                                if (empty($row22['blanktypeandno1'])) {
                                    echo "<td></td>"; 
                                } else { 
                                echo "<td>" . $row22['blanktypeandno1'] . "</td>";
                                }
                                ?>
                                <?php
                                
                                if (empty($row3['blanktypeandno1'])) {
                                    echo "<td></td>"; 
                                } else { 
                                echo "<td>" . $row3['blanktypeandno1'] . "</td>";
                                }
                                ?>
                                <?php
                               
                                if (empty($row4['blanktypeandno'])) {
                                    echo "<td></td>"; 
                                } else { 
                                echo "<td>" . $row4['blanktypeandno'] . "</td>";
                                }
                                ?>
                               
                               <?php
                                
                                if (empty($row22['id'])) {
                                    echo "<td></td>"; 
                                } else { 
                                echo "<td>" . $row22['id'] . "</td>";
                                }
                                ?>

                                <?php
                               
                                if (empty($row22['blanktypeandno1'])) {
                                    echo "<td></td>"; 
                                } else { 
                                echo "<td>" . $row22['blanktypeandno1'] . "</td>";
                                }
                                ?>
                             
                               
                           </tr>
                            <?php
                            }}   else { ?> 
                                <h3 style="text-align: center; margin-top: 10px;">No record found</h3>
            <?php
                            }
                        ?>
                        </table>
                        </form>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </header>

    
    
    
</body>
</html>
