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
    <title>Sold Ticket</title>
    <!-- jquery script -->  
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
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

    <header id="showcase" style="overflow: scroll ">
            <div class="showcase-contain">
                <div class="showcase-content" >
                <div class="contain" style="max-width: 150rem; ">
                <div class="form-wrap" >
                <?php
                    //db connection
                    $connection = mysqli_connect("localhost","root","","ats");
                    //search feature
                    $search = mysqli_real_escape_string($connection, @$_POST['search2']);
                    //sql query to search from soldticket
                    $query = "SELECT * FROM soldticket WHERE (paymenttype1 LIKE '%$search%' OR blanktypeandno1 LIKE '%$search%' OR fullname1 LIKE '%$search%' OR origin LIKE '%$search%' OR destination LIKE '%$search%' OR amount1 LIKE '%$search%' OR nameoncard1 LIKE '%$search%' OR cardno1 LIKE '%$search%' OR cvv1 LIKE '%$search%' OR expirydate1 LIKE '%$search%') AND (soldby = '".$_SESSION['username2']."')";
                    $query_run = mysqli_query($connection,$query);
                ?>
                </table>
                <!-- sold ticket title changes based on whose logged in -->
                <h1 style="text-align: center; font-family: 'Roboto Slab', serif;">Tickets Sold By: <?php echo $_SESSION['username2'] ?></h1>
                 <!-- late payments made button -->
                <button  onclick="location.href='latepayments.php'">Late Payments Made</button>
                <!-- pay later payment button -->
                <button  onclick="location.href='yettopay.php'">Pay Late Payments</button>
                <form action="soldticket.php" method="POST">
                <!-- search button -->
                <input type="text" name="search2" placeholder="Search ">
                <button type="submit" name="submit-search">Search</button>
                </form>
                <!-- table -->
                <table style="margin-top: 20px"  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <?php
                if(mysqli_num_rows($query_run) > 0) { 
                    ?>
                <thead>
                    <tr>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">ID</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Date Pur</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Paid?</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Type</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Payment Type</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Blank No</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"> Name</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Origin</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Destination</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Amount</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">USD Rate</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Amount (USD)</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Tax</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">TOTAL Amnt</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Card Name</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Card Number</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">CVV</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Expiry Date</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Disc %</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Discount Payout</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;">Commission</th>
            </tr>
        </thead>
        <?php
            while($row = mysqli_fetch_assoc($query_run)) {
                ?>
        
            <tr >
            <!-- retreives data from database and puts it inside the $row -->
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['id'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['date1'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['datepaid'] ?  'Yes' : 'No' ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['type1'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['paymenttype1'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['blanktypeandno1'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['fullname1'] ?> <?php echo $row['othername'] ?></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['origin'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['destination'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['currcode'] ?><?php echo $row['amount1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['USD'] ?> USD * <?php echo $row['decimals'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['amountUSD'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['totaltax'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['totalamount1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['nameoncard1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['cardno1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['cvv1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['expirydate1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['discperc'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['afterdiscount'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 15px;"><?php echo $row['commission'] ?>%</input></td>
               
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
