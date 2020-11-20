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
    <title>Individual Domestic Report</title>
     <!-- google font --> 
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
     <!-- code for printing report --> 
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
 <!-- code for styling table --> 
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
    <div class="contain" style="padding: 2.248rem;">
            
            <a href="home.php">
                <!-- This is the logo that appears on the top left -->
                    <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
                <ul>
                    <!-- Nav Bar -->
                    <li><a href="individualinterline.php">Individual Interline</a></li>
                    <li><a href="#" class="present">Individual Domestic</a></li>
                   
                </ul>
                <form action="../logout1.php" method="POST">   
                    <!-- log out button  -->               
            <div class="item" style="padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 5px;right: 10px;">
            <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin: 4px 2px;cursor: pointer;" 
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

            //code for what happens after clicking search
            if(isset($_POST['search'])) {
            $txtStartDate = $_POST['txtStartDate'];
            $txtEndDate = $_POST['txtEndDate'];
            $connection = mysqli_connect("localhost","root","","ats");
            $query_run = mysqli_query($connection,"SELECT * FROM soldticket WHERE soldby = '".$_SESSION['username2']."' AND type1='Domestic'  AND datepaid = '1' AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate'");
            // $connection = mysqli_connect("localhost","root","","ats");
            $cashQuery = mysqli_query($connection,"SELECT * FROM soldticket WHERE paymenttype1 = 'Cash' AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $cashQuery2 = mysqli_query($connection,"SELECT * FROM soldticket WHERE paymenttype1 = 'Card' AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $cashQuery3 = mysqli_query($connection,"SELECT * FROM soldticket WHERE commission = '5' AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");

            } 
            ?>
        </table>
        <!-- Individual Domestic Title -->
        <h1 style="text-align: center; font-family: 'Roboto Slab', serif;">Individual Domestic Reports</h1>
        <form action="" method="post">
        <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
          <!-- date field -->
        <input type="date" name="txtStartDate">
        <input type="date" name="txtEndDate">
        <!-- search button -->
        <input type="submit" name="search" value="Search" style="margin-top:-60px;">
        <!-- Print report -->
        <input id="print" type="button" name="search" onclick="window.print()" value="Print Report" />

        </div>
        </form>
        <?php 
        if (isset($_POST['txtStartDate'])) { ?>
            <h1>Report for period: <?php echo date("d F Y",strtotime($txtStartDate)) ?> to <?php echo date("d F Y",strtotime($txtEndDate)) ?></h1> 
        <?php } ?>
                <p>
               
                </p>

        <table id="individualtable" style="margin-top: 20px;"> 

            <?php
            if(@mysqli_num_rows(@$query_run) > 0) { 
            ?>
            
            <tr>
            <th  colspan="1" rowspan="3">NO.</th>
            <th  colspan="3">Air Via Doc</th>
        
            <th colspan="5">FORMS OF PAYMENTS</th>
            <th colspan="1" rowspan="3">Taxes</th>
            <th colspan="1" rowspan="3">Total Amount Paid</th>
            <th colspan="2">COMMISSIONS ASSESSABLE AMOUNTS</th>
            <th colspan="2" >Notes</th>
            <th rowspan="3">Other Details Chq Nmbr, Inv . Nmbr, CC NVMBR SPONSOR, REISS.TKT NMBR</th> 
            <!--  -->
            <th colspan="2">Notes</th>
            </tr>

            

            <tr>
         
            <th rowspan="2">ORIGINAL ISSUED NUMBER</th>
            <th rowspan="2">FARE BASE (BGL)</th>
            <th rowspan="2">FARE BASE (USD)</th>
            <th rowspan="2">CASH (BGL)</th>
            <th rowspan="2">CHEQUE (BGL)</th>
            <th rowspan="2">INVOICE (BGL)</th>
            <th colspan="2">CREDIT CARD</th>
            
           
            <th rowspan="2">9%</th>
            <th rowspan="2">5%</th>
            <th  rowspan="2"></th>
            <th  rowspan="2"></th>
            <th  rowspan="2"></th>
            <th  rowspan="2"></th>
        
           
            </tr>

            <tr>
           
            <th>USD</th>
            <th>BGL</th>
            </tr>


          

            <?php
            
          
            while($row = mysqli_fetch_assoc($query_run)) {
                
            ?>
           
            <tr>
            <?php $row2 = mysqli_fetch_assoc($cashQuery); ?>
            <?php $row3 = mysqli_fetch_assoc($cashQuery2); ?>
            <?php $row4 = mysqli_fetch_assoc($cashQuery3); ?>

                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['blanktypeandno1'] ?></td>
                <td><?php echo $row['amount1'] ?></td>
                <td><?php echo $row['amountUSD'] ?></td>
                <?php
                    if (empty($row2['totalamount1'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row2['totalamount1'] . "</td>";
                    }
                ?>
                <td></td>
                <td></td>
              
                <?php
                    
                    if (empty($row3['amountUSD'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row3['amountUSD'] . "</td>";
                    }
                ?>

                <?php
                   
                    if (empty($row3['totalamount1'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row3['totalamount1'] . "</td>";
                    }
                ?>

               
               
                <td><?php echo $row['totaltax'] ?></td>
                <td><?php echo $row['totalamount1'] ?></td>
                <td>-</td>
               
                
                <?php
                   
                   if (empty($row4['amount1'])) {
                       echo "<td></td>"; 
                   } else { 
                   echo "<td>" . $row4['amount1'] . "</td>";
                   }
               ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
               
                <td></td>
            </tr>

           




            
                 <?php

            }
            
            $connection = mysqli_connect("localhost","root","","ats");
            
            
            $query_run2 = mysqli_query($connection,"SELECT CAST(SUM(amountUSD) AS float) as USDSUM, SUM(amount1) as LCSUM, SUM(totaltax) AS totalTax, CAST(SUM(totalamount1) AS float) AS total, CAST((SUM(totalamount1) - SUM(amount1) * 0.05) AS float) AS TtlnetAmnt FROM soldticket  WHERE  commission >= 0 AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = '1' AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $cashQuery = mysqli_query($connection,"SELECT SUM(totalamount1) AS totalSum FROM soldticket WHERE paymenttype1 = 'Cash' AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $cashQuery2 = mysqli_query($connection,"SELECT SUM(amountUSD) AS usdSum, SUM(totalamount1) AS totalSum FROM soldticket WHERE paymenttype1 = 'Card' AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            
            $cashQuery3 = mysqli_query($connection,"SELECT SUM(amount1) as LCSUM,(SUM(amount1) * 0.05) AS totalComm,( SUM(amount1) - (SUM(amount1) * 0.05)) AS netAmount    FROM soldticket WHERE commission > 0 AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");

            $cashQuery4 = mysqli_query($connection,"SELECT (SELECT TRUNCATE(SUM(totalamount1),3) AS A FROM soldticket WHERE  commission >= 0 AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = '1' AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate') - (SELECT TRUNCATE(SUM(amount1) * 0.05,3) AS totalComm  FROM soldticket WHERE commission > 0 AND soldby = '".$_SESSION['username2']."' AND type1='Domestic' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ) AS Difference ");

            $quantity = $query_run->num_rows;
            $row2 = mysqli_fetch_array($query_run2);
            $row3 = mysqli_fetch_array($cashQuery);
            $row4 = mysqli_fetch_array($cashQuery2);
            $row5 = mysqli_fetch_array($cashQuery3);
            $row6 = mysqli_fetch_array($cashQuery4);
            ?>    
             <tr>
            
            <td colspan="2">NBR of TKTS: <?php echo $quantity ?> </td>
            <td><?php echo $row2['LCSUM'] ?></td>
            <td><?php echo $row2['USDSUM'] ?></td>
            <td><?php echo $row3['totalSum'] ?></td>
            <td></td>
            <td></td>
            <td><?php echo $row4['usdSum'] ?></td>
            <td><?php echo $row4['totalSum'] ?></td>
            <td><?php echo $row2['totalTax'] ?></td>
            <td><?php echo $row2['total'] ?></td>
            <td></td>
            <td><?php echo $row5['LCSUM'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td ></td>
            </tr>

            <tr>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td colspan="4">TOTAL COMMISSION AMOUNTS</td>
                <td></td>
                <td ><?php echo $row5['totalComm'] ?></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                
                
                
            </tr>

            <tr>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                
                <td colspan="4">NET AMOUNTS FOR AGENT'S DEBIT</td>
                <td><?php echo $row5['netAmount'] ?></td>
                <td style="visibility:collapse;"> </td>
                <td style="visibility:collapse;" ></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                
               
               
            </tr>

            <tr>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td colspan="6">TOTAL NET AMOUNT FOR BANK REMITTENCE TO "AIR VIA"</td>
                <td><?php echo $row6['Difference'] ?></td>
                <td style="visibility:collapse;"></td>
                
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"> </td>
               
               
            
            </tr>
            <?php
        
        }
                else {
                    echo "No record found";

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