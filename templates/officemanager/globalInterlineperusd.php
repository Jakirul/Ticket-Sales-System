<?php
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php');
?>  

<!DOCTYPE html>
<html lang="en" >
<head>
<!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
     <!-- Title -->
    <title>Global Interline Per USD Rate</title>
     <!-- Font style -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
   
    <!-- styling of the printing facility -->
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
 <!-- styling of the table -->
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
                    <li><a href="globalinterline.php" >Global Interline</a></li>
                    <li><a href="globaldomestic.php">Global Domestic</a></li>
                    <li ><a href="globalinterlineperusd.php" class="present">Global Interline (Per USD)</a></li>
                </ul>
                <?php 
               //this is the connection to the database
                $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                //this selects the information from the database
                $result = $connection->query("SELECT a.othername,a.fullname1,b.fullname,a.amount1 from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY < NOW() AND a.datepaid = '0') ");
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
                <?php } ?>
        </div>
        <!-- log out button  -->
                <form action="../logout.php" method="POST">                 
            <div class="item" style="padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 5px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn">Log Out</button>
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
        //database connection
        $connection = mysqli_connect("localhost","root","","ats");
        //search button
        if(isset($_POST['search'])) {
            $txtStartDate = $_POST['txtStartDate'];
            $txtEndDate = $_POST['txtEndDate'];
            
            $connection = mysqli_connect("localhost","root","","ats");
            $cashQuery = mysqli_query($connection,"SELECT cast(SUM(a.amountUSD) AS FLOAT) AS amntUSD, SUM(a.amount1) AS amnt1,SUM(a.localtax) AS LTSUM,SUM(a.othertax) AS OTSUM,SUM(a.totalamount1) AS totalDoc,a.decimals,b.id,a.USD,a.amount1,a.localtax,a.othertax,a.totalamount1, (SUM(a.totalamount1) -  SUM(a.amount1)) AS nonasses  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.type1='Interline' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' GROUP BY a.decimals");
            $cashQuery1 = mysqli_query($connection,"SELECT cast(SUM(a.amountUSD) AS FLOAT) AS amntUSD, SUM(a.amount1) AS amnt1,SUM(a.localtax) AS LTSUM,SUM(a.othertax) AS OTSUM,SUM(a.totalamount1) AS totalDoc,a.decimals,b.id,a.USD,a.amount1,a.localtax,a.othertax,a.totalamount1, (SUM(a.totalamount1) -  SUM(a.amount1)) AS nonasses  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.type1='Interline' AND a.paymenttype1 = 'Cash' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' GROUP BY a.decimals");
            $cashQuery2 = mysqli_query($connection,"SELECT cast(SUM(a.amountUSD) AS FLOAT) AS amntUSD, SUM(a.amount1) AS amnt1,SUM(a.localtax) AS LTSUM,SUM(a.othertax) AS OTSUM,SUM(a.totalamount1) AS totalDoc,a.decimals,b.id,a.USD,a.amount1,a.localtax,a.othertax,a.totalamount1, (SUM(a.totalamount1) -  SUM(a.amount1)) AS nonasses  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.soldby='Dennis Menace' AND a.type1='Interline' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' GROUP BY a.decimals");
            $cashQuery3 = mysqli_query($connection,"SELECT cast(SUM(a.amountUSD) AS FLOAT) AS amntUSD, SUM(a.amount1) AS amnt1,SUM(a.localtax) AS LTSUM,SUM(a.othertax) AS OTSUM,SUM(a.totalamount1) AS totalDoc,a.decimals,b.id,a.USD,a.amount1,a.localtax,a.othertax,a.totalamount1, (SUM(a.totalamount1) -  SUM(a.amount1)) AS nonasses  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.soldby='Penelope Pitstop' AND a.type1='Interline' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' GROUP BY a.decimals");
        } 

            ?>

        </table>
        <!-- title  -->
        <h1 style="text-align: center; font-family: 'Roboto Slab', serif;">Global Interline (Per USD Rate) Reports</h1>
        <form action="" method="post">
            <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
        <input  type="date" name="txtStartDate">
        <input  type="date" name="txtEndDate">
     
        <input type="submit" name="search" value="Search" style="margin-top:-60px;">
        <input id="print" type="button" name="search" onclick="window.print()" value="Print Report" />

        </div>
        <?php 
        //the date field text
        if (isset($_POST['txtStartDate'])) { ?>
            <h1>Report for period: <?php echo date("d F Y",strtotime($txtStartDate)) ?> to <?php echo date("d F Y",strtotime($txtEndDate)) ?></h1> 
        <?php } ?>
                

        <table id="individualtable" style="margin-top: 20px;"> 

            <?php
            if(@mysqli_num_rows(@$cashQuery) > 0) { 
            ?>
            
            <tr>
                <th  rowspan="3">NO.</th>
                <th colspan="7">Air Via Documents</th>
                <th colspan="9">Issued In Exchange for Documents Of:</th>
                <th colspan="5">FORMS OF PAYMENTS</th>
                <th colspan="6">Commission</th>
                <th rowspan="3">Non Assess amounts</th>
            </tr>

            <tr>
                <th rowspan="2">USD</td>
                <th rowspan="2">USD Rate</td>
                <th rowspan="2">Sales Made by: Dennis Menace</th>
                <th rowspan="2">Sales Made by: Penelope Pitstop</th>
                <th rowspan="2" >Total Fare Amount</th>
                <th colspan="2">Taxes</th>
                <th rowspan="2">Total Doc Amount</th>
                <th colspan="4">AirVia</th>
                <th colspan="4">Other AIRLINES</th>
                <th rowspan="2">Cash</th>
                <th colspan="3">Credit Card</th>
                <th rowspan="2">Total Amount Paid</th>
                <th colspan="5">Assessable Amounts</th>
            </tr>

            <tr>
                <th>LZ</th>
                <th>OTHS</th>
                <th>DOC</th>
                <th>FCPNS</th>
                <th colspan="2">PRORPATE AMNTS</th>
                <th>DOCS.</th>
                <th>FCPNS</th>
                <th colspan="2">PROPATE AMNTS</th>
                <th>NMBR</th>
                <th>USD</th>
                <th>LC</th>
                <th>15%</th>
                <th>12%</th>
                <th>9%</th>
                <th>8.5%</th>
                <th>7%</th>
            </tr>

            <?php
            while($row2 = mysqli_fetch_assoc($cashQuery)) {  
            ?>
           
            <tr>
            <?php  $row3 = mysqli_fetch_assoc($cashQuery2); ?>
            <?php  $row4 = mysqli_fetch_assoc($cashQuery3); ?>
            <td>1</td>
            <td><?php echo $row2['USD'] ?></td>
            <td><?php echo $row2['decimals'] ?></td>
           
            <?php
                if (empty($row3['amnt1'])) {
                    echo "<td></td>"; 
                } else { 
                echo "<td>" . $row3['amnt1'] . "</td>";
                }
            ?>

            <?php  ?>

            <?php
               
                if (empty($row4['amnt1'])) {
                    echo "<td></td>"; 
                } else { 
                echo "<td>" . $row4['amnt1'] . "</td>";
                }
            ?>
           
            <td><?php echo $row2['amnt1'] ?></td>
            
            <td><?php echo $row2['LTSUM'] ?></td>
            <td><?php echo $row2['OTSUM'] ?></td>
            <td><?php echo $row2['totalDoc'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           <?php
                $row5 = mysqli_fetch_assoc($cashQuery1);
                if (empty($row5['totalDoc'])) {
                    echo "<td></td>"; 
                } else { 
                echo "<td>" . $row5['totalDoc'] . "</td>";
                }
            ?>
           
           <td></td>
           <td><?php echo $row2['amntUSD'] ?></td>
           <td><?php echo $row2['amnt1'] ?></td>
           <td><?php echo $row2['totalDoc'] ?></td>
           <td></td>
           <td></td>
           <td><?php echo $row2['amnt1'] ?></td>
           <td ></td>
           <td ></td>
            <td></td>
            <td><?php echo $row2['nonasses'] ?></td>
            </tr>

                 <?php

            }
            
            $connection = mysqli_connect("localhost","root","","ats");
            
            $cashQuery = mysqli_query($connection,"SELECT SUM(totalamount1) as totalAmountCash,cast(SUM(a.amountUSD) AS FLOAT) AS amntUSD, SUM(a.amount1) AS amnt1,SUM(a.localtax) AS LTSUM,SUM(a.othertax) AS OTSUM,SUM(a.totalamount1) AS totalDoc,a.decimals,b.id,a.USD,a.amount1,a.localtax,a.othertax,a.totalamount1, (SUM(a.totalamount1) -  SUM(a.amount1)) AS nonasses  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.type1='Interline' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' GROUP BY a.decimals");
            $cashQuery0 = mysqli_query($connection,"SELECT SUM(totalamount1) as totalAmountCash,cast(SUM(a.amountUSD) AS FLOAT) AS amntUSD, SUM(a.amount1) AS amnt1,SUM(a.localtax) AS LTSUM,SUM(a.othertax) AS OTSUM,SUM(a.totalamount1) AS totalDoc,a.decimals,b.id,a.USD,a.amount1,a.localtax,a.othertax,a.totalamount1, (SUM(a.totalamount1) -  SUM(a.amount1)) AS nonasses  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.type1='Interline' AND a.paymenttype1 = 'Cash' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' GROUP BY a.decimals");

            $cashQuery1 = mysqli_query($connection,"SELECT SUM(a.amount1) AS amnt1, SUM(a.localtax) as LC, SUM(a.othertax) AS OT, SUM(a.totalamount1) AS TA1, SUM(a.amountUSD) as amntUSD, (SUM(a.amount1)+SUM(a.localtax)+SUM(a.othertax) - SUM(a.amount1)) AS nonasses, (SUM(a.amount1) * 0.09) AS comm9perc, (SUM(a.amount1) - SUM(a.amount1) * 0.09) AS netAmnt9perc, (SUM(a.totalamount1) - SUM(a.amount1) * 0.09) AS TtlNetAmnt  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.type1='Interline' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $cashQuery11 = mysqli_query($connection,"SELECT SUM(a.amount1) AS amnt1, SUM(a.localtax) as LC, SUM(a.othertax) AS OT, SUM(a.totalamount1) AS TA1, SUM(a.amountUSD) as amntUSD, (SUM(a.amount1)+SUM(a.localtax)+SUM(a.othertax) - SUM(a.amount1)) AS nonasses, (SUM(a.amount1) * 0.09) AS comm9perc, (SUM(a.amount1) - SUM(a.amount1) * 0.09) AS netAmnt9perc, (SUM(a.totalamount1) - SUM(a.amount1) * 0.09) AS TtlNetAmnt  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.soldby = 'Dennis Menace' AND a.type1='Interline' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $cashQuery12 = mysqli_query($connection,"SELECT SUM(a.amount1) AS amnt1, SUM(a.localtax) as LC, SUM(a.othertax) AS OT, SUM(a.totalamount1) AS TA1, SUM(a.amountUSD) as amntUSD, (SUM(a.amount1)+SUM(a.localtax)+SUM(a.othertax) - SUM(a.amount1)) AS nonasses, (SUM(a.amount1) * 0.09) AS comm9perc, (SUM(a.amount1) - SUM(a.amount1) * 0.09) AS netAmnt9perc, (SUM(a.totalamount1) - SUM(a.amount1) * 0.09) AS TtlNetAmnt  FROM soldticket a INNER JOIN systemuser b ON a.soldby = b.username WHERE a.soldby = 'Penelope Pitstop' AND a.type1='Interline' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");

            $cashQuery2 = mysqli_query($connection,"SELECT SUM(totalamount1) as totalAmountCash FROM soldticket a INNER JOIN systemuser b  WHERE a.paymenttype1 = 'Cash' AND a.type1='Interline' AND a.datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' GROUP BY b.id ");

            $quantity = $cashQuery->num_rows;
            $row1 = mysqli_fetch_array($cashQuery0);
            $row2 = mysqli_fetch_array($cashQuery);
            $row3 = mysqli_fetch_array($cashQuery1);
            $row4 = mysqli_fetch_array($cashQuery2);
            $row5 = mysqli_fetch_array($cashQuery11);
            $row6 = mysqli_fetch_array($cashQuery12);

            ?>    <tr>
            
            <td colspan="2">NBR of TKTS: <?php echo $quantity ?> </td>
           
          
           
            <td></td>
            <td><?php echo $row5['amnt1'] ?></td>
            <td><?php echo $row6['amnt1'] ?></td>
            <td><?php echo $row3['amnt1'] ?></td>
            <td><?php echo $row3['LC'] ?></td>
            <td><?php echo $row3['OT'] ?></td>
            <td><?php echo $row3['TA1'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $row1['totalAmountCash'] ?></td>
            <td></td>
            <td><?php echo $row3['amntUSD'] ?></td>
            <td><?php echo $row3['amnt1'] ?></td>
            <td><?php echo $row3['TA1'] ?></td>
            <td></td>
            <td></td>
            <td><?php echo $row3['amnt1'] ?></td>
            <td></td>
            <td ></td>
            <td></td>
            
            <td><?php echo $row3['nonasses'] ?></td>
            </tr>

            <tr>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                
               
                
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                
                <td style="visibility:collapse;"></td>
                <td colspan="4">TOTAL COMMISSION AMOUNTS</td>
               
                <td></td>
                <td></td>
                <td><?php echo $row3['comm9perc'] ?></td>
                <td></td>
                <td></td>
                <td></td>
               
                <td>* * *</td>
            </tr>

            <tr>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td colspan="4">NET AMOUNTS FOR AGENT'S DEBIT</td>
                <td></td>
                <td></td>
                <td><?php echo $row3['netAmnt9perc'] ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo $row3['nonasses'] ?></td>
            </tr>

            <tr>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
           
                
                <td style="visibility:collapse;"></td>
                
                <td style="visibility:collapse;"></td>
                
               
                <td style="visibility:collapse;"></td>
                <td colspan="6">TOTAL NET AMOUNT FOR BANK REMITTENCE TO "AIR VIA"</td>
                <td><?php echo $row3['TtlNetAmnt'] ?></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                
            
            </tr>
            

          
            
            <?php
        
        }
                else { ?> 
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