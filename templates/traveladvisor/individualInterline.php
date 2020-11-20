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
    <title>Individual Interline Report</title>
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
 <!-- code for table design --> 
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
                <ul >
                    <!-- Nav Bar -->
                    <li><a href="#" class="present">Individual Interline</a></li>
                    <li ><a href="individualdomestic.php">Individual Domestic</a></li>
                 
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
       //this is what happens when you click the search button
        if(isset($_POST['search'])) {
            $txtStartDate = $_POST['txtStartDate'];
            $txtEndDate = $_POST['txtEndDate'];
            $connection = mysqli_connect("localhost","root","","ats");
            $query_run = mysqli_query($connection,"SELECT *,totalamount1,(amount1 + localtax + othertax) AS total ,(totalamount1-amount1) AS total2  FROM soldticket WHERE  soldby = '".$_SESSION['username2']."' AND type1='Interline' AND datepaid = '1' AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $query_run1 = mysqli_query($connection,"SELECT *,totalamount1,(amount1 + localtax + othertax) AS total ,(totalamount1-amount1) AS total2  FROM soldticket WHERE  soldby = '".$_SESSION['username2']."' AND commission = '9' AND type1='Interline' AND datepaid = '1' AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $query_run2 = mysqli_query($connection,"SELECT *,totalamount1,(amount1 + localtax + othertax) AS total ,(totalamount1-amount1) AS total2  FROM soldticket WHERE  soldby = '".$_SESSION['username2']."' AND commission = '10' AND type1='Interline' AND datepaid = '1' AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $cashQuery = mysqli_query($connection,"SELECT * FROM soldticket WHERE paymenttype1 = 'Cash' AND soldby = '".$_SESSION['username2']."' AND type1='Interline' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $cashQuery0 = mysqli_query($connection,"SELECT * FROM soldticket WHERE paymenttype1 = 'Card' AND soldby = '".$_SESSION['username2']."' AND type1='Interline' AND datepaid = 1 AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
        } 
            ?>
           
        </table>
        
        <!-- Individaul Interline Report Title -->
        <h1 style="text-align: center; font-family: 'Roboto Slab', serif;">Individual Interline Reports</h1>
        <form action="" method="post">
        <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;">
          <!-- date field -->
        <input type="date" name="txtStartDate">
        <input type="date" name="txtEndDate">
          <!-- search button -->
        <input type="submit" name="search" value="Search" style="margin-top:-60px;">
          <!--  printing button -->
        <input id="print" type="button" name="search" onclick="window.print()" value="Print Report" />

        </div>
        </form>
        <?php 
        //prints out the date range on screen
        if (isset($_POST['txtStartDate'])) { ?>
            <h1>Report for period: <?php echo date("d F Y",strtotime($txtStartDate)) ?> to <?php echo date("d F Y",strtotime($txtEndDate)) ?></h1> 
        <?php } ?>
                <p>
               
                </p>
        <!-- table -->
        <table id="individualtable" style="margin-top: 20px;"> 

            <?php
            if(@mysqli_num_rows(@$query_run) > 0) { 
            ?>
            
            <tr>
                <th rowspan="3">NO.</th>
                <th colspan="7">Air Via Doc</th>
                <th colspan="4">INEXCHANGE FOR DOCS OF:</th>
                <th colspan="6">FORMS OF PAYMENTS</th>
                <th colspan="6">Commission</th>
                <th rowspan="3">Non Assess amounts</th>
            </tr>

            <tr>
                <th rowspan="2">Issued Number</th>
                <th colspan="3">Fare Amount</th>
                <th colspan="2">Taxes</th>
                <th rowspan="2">Total Doc Amount</th>
                <th colspan="4">Airlines</th>
                <th rowspan="2">Cash</th>
                <th colspan="4">Credit Card</th>
                <th rowspan="2">Total Amount Paid</th>
                <th colspan="6">Assessable Amounts</th>
            </tr>

            
            <tr>
                <th>USD</th>
                <th>LOCAL</th>
                <th>BGL</th>
                <th>LZ</th>
                <th>OTHS</th>
                <th>CD</th>
                <th>DOC.NBR</th>
                <th>FC</th>
                <th>PROR.AMNT</th>
                <th>LC</th>
                <th>CC Num</th>
                <th>USD</th>
                <th>BGL</th>
                <th>15%</th>
                <th>12%</th>
                <th>10%</th>
                <th>9%</th>
                <th>8.5%</th>
                <th>7%</th>
            </tr>

            <?php
            while($row = mysqli_fetch_assoc($query_run)) { ?>
           
            <tr>
            <?php $row1 = mysqli_fetch_assoc($query_run1); ?>
            <?php $row11 = mysqli_fetch_assoc($query_run2); ?>
            <?php $row2 = mysqli_fetch_assoc($cashQuery); ?>
            <?php $row3 = mysqli_fetch_assoc($cashQuery0); ?>


            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['blanktypeandno1'] ?></td>
            <td><?php echo $row['amountUSD'] ?></td>
           
            <td><?php echo $row['decimals'] ?></td>
            <td><?php echo $row['amount1'] ?></td>
            <td><?php echo $row['localtax'] ?></td>
            <td><?php echo $row['othertax'] ?></td>
            <td><?php echo $row['totalamount1'] ?></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            
         
            <?php
            
                if (empty($row2['amount1'])) {
                    echo "<td></td>"; 
                } else { 
                echo "<td>" . $row2['amount1'] . "</td>";
                }
            ?>
     
            <td><?php echo $row['amount1'] ?></td>
            <td><?php echo $row['cardno1'] ?></td>

            <?php
            
                if ($row3['amountUSD'] == null) {
                    echo "<td>null</td>"; 
                } else { 
                echo "<td>" . $row3['amountUSD'] . "</td>";
                }
            ?>
           
            <td><?php echo $row['amount1'] ?></td>
            <td><?php echo $row['totalamount1'] ?></td>
            
    
             <td></td>
            <td></td>
            <?php
            
            if (empty($row11['amount1'])) {
                echo "<td></td>"; 
            } else { 
            echo "<td>" . $row11['amount1'] . "</td>";
            }
        ?>
           
            <?php
            
            if (empty($row1['amount1'])) {
                echo "<td></td>"; 
            } else { 
            echo "<td>" . $row1['amount1'] . "</td>";
            }
        ?>
            <td></td>
            <td></td>
            <td><?php echo $row['total2'] ?></td>
            </tr>

           




            
                 <?php

            }
            
            $connection = mysqli_connect("localhost","root","","ats");
            
            
            $query_run2 = mysqli_query($connection,"SELECT SUM(amountUSD) as USDSUM, SUM(amount1) as LCSUM ,SUM(localtax) AS LTSUM, SUM(othertax) AS OTSUM, (SUM(amount1) + SUM(localtax) + SUM(othertax)) AS totalSum, SUM(totalamount1-amount1) AS totalnonassess, (SUM(amount1) * 0.09) AS totalCommAmnt, (SUM(amount1)-(SUM(amount1) * 0.09)) as NetAmnt, ((SUM(amount1) + SUM(localtax) + SUM(othertax))-(SUM(amount1) * 0.09)) AS TtlNetAmnt FROM soldticket WHERE soldby = '".$_SESSION['username2']."' AND type1='Interline' AND datepaid = '1' AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            $query_run22 = mysqli_query($connection,"SELECT SUM(amountUSD) as USDSUM, SUM(amount1) as LCSUM ,SUM(localtax) AS LTSUM, SUM(othertax) AS OTSUM, (SUM(amount1) + SUM(localtax) + SUM(othertax)) AS totalSum, SUM(totalamount1-amount1) AS totalnonassess, (SUM(amount1) * 0.10) AS totalCommAmnt, (SUM(amount1)-(SUM(amount1) * 0.10)) as NetAmnt, ((SUM(amount1) + SUM(localtax) + SUM(othertax))-(SUM(amount1) * 0.10)) AS TtlNetAmnt FROM soldticket WHERE soldby = '".$_SESSION['username2']."' AND type1='Interline' AND commission='10' AND datepaid = '1' AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            
            $cashQuery1 = mysqli_query($connection,"SELECT SUM(totalamount1) as totalCash,SUM(amount1) AS amnt1 FROM soldticket WHERE paymenttype1 = 'Cash' AND datepaid = '1' AND soldby = '".$_SESSION['username2']."' AND type1='Interline'  AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");

            $cashQuery2 = mysqli_query($connection,"SELECT SUM(amountUSD) as totalAmountUSD FROM soldticket WHERE paymenttype1 = 'Card' AND datepaid = '1' AND soldby = '".$_SESSION['username2']."' AND type1='Interline'  AND date1 BETWEEN '$txtStartDate' AND '$txtEndDate' ");
            
            $quantity = $query_run->num_rows;
            $row2 = mysqli_fetch_array($query_run2);
            $row22 = mysqli_fetch_array($query_run22);
            $row3 = mysqli_fetch_array($cashQuery1);
            $row4 = mysqli_fetch_array($cashQuery2);
            ?>    <tr>
            
            <td colspan="2">NBR of TKTS: <?php echo $quantity ?> </td>
            <td><?php echo $row2['USDSUM'] ?></td>
            <td>-</td>
            <td><?php echo $row2['LCSUM'] ?></td>
            <td><?php echo $row2['LTSUM'] ?></td>
            <td><?php echo $row2['OTSUM'] ?></td>
            <td><?php echo $row2['totalSum'] ?></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td><?php echo $row3['amnt1'] ?></td>
            <td><?php echo $row2['LCSUM'] ?></td>
            <td></td>
            <td><?php echo $row4['totalAmountUSD'] ?></td>
            <td><?php echo $row2['LCSUM'] ?></td>
            <td><?php echo $row2['totalSum'] ?></td>
            <td>-</td>
            <td>-</td>
            <?php
                    if (empty($row22['LCSUM'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row22['LCSUM'] . "</td>";
                    }
            ?>
           <?php
                    if (empty($row2['LCSUM'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row2['LCSUM'] . "</td>";
                    }
            ?>
            <td>-</td>
            <td>-</td>
            <td><?php echo $row2['totalnonassess'] ?></td>
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
                
                <td colspan="4">TOTAL COMMISSION AMOUNTS</td>
                <td ></td>
                <td></td>
                <?php
                    if (empty($row22['totalCommAmnt'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row22['totalCommAmnt'] . "</td>";
                    }
                ?>
                <?php
                    if (empty($row2['totalCommAmnt'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row2['totalCommAmnt'] . "</td>";
                    }
                ?>
               
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
                
                <td colspan="4">NET AMOUNTS FOR AGENT'S DEBIT</td>
                <td ></td>
                <td ></td>
                <?php
                    if (empty($row22['NetAmnt'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row22['NetAmnt'] . "</td>";
                    }
                ?>
               <?php
                    if (empty($row2['NetAmnt'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row2['NetAmnt'] . "</td>";
                    }
                ?>
                <td></td>
                <td></td>
                <?php
                    if (empty($row2['totalnonassess'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row2['totalnonassess'] . "</td>";
                    }
                ?>
                
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
                <td colspan="6">TOTAL NET AMOUNT FOR BANK REMITTENCE TO "AIR VIA"</td>
          
                <?php
                    if (empty($row2['TtlNetAmnt'])) {
                        echo "<td></td>"; 
                    } else { 
                    echo "<td>" . $row2['TtlNetAmnt'] . "</td>";
                    }
                ?>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
                <td style="visibility:collapse;"></td>
            
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