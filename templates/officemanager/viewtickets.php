<?php
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
    <!-- title -->
    <title>View Tickets</title>
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
                <li><a href="viewtickets.php" class="present">View Tickets</a></li>
                <li><a href="refundedticket.php" >Refunded Tickets</a></li>
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
                    
                </div> <?php }
            ?>
            </div>
            <form action="../logout.php" method="POST">  
            <!-- log out button  -->                
            <div class="item" style=" padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 10px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn">Log Out</button>
                    </div>
                </form> 
        </nav>

        <header id="showcase" style="overflow: scroll ">
            
                <div class="showcase-contain">
                    <div class="showcase-content">
                        
                    <div id="contain" style="max-width: 150rem;">
                    <div class="form-wrap" >
    <?php
        //database connection
       $connection = mysqli_connect("localhost","root","","ats");
       //search field
       $search = mysqli_real_escape_string($connection, @$_POST['search']);
       //sql query with the search feature
       $query = "SELECT * FROM soldticket WHERE (fullname1 LIKE '%$search%' OR othername LIKE '%$search%' OR date1 LIKE '%$search%' OR datepaid LIKE '%$search%' OR type1 LIKE '%$search%' OR  paymenttype1 LIKE '%$search%' OR  blanktypeandno1 LIKE '%$search%' OR origin LIKE '%$search%' OR destination LIKE '%$search%'  OR currcode LIKE '%$search%'  OR USD LIKE '%$search%'  OR amountUSD LIKE '%$search%'  OR nameoncard1 LIKE '%$search%'  OR cardno1 LIKE '%$search%'  OR cvv1 LIKE '%$search%'  OR expirydate1 LIKE '%$search%'  OR discperc LIKE '%$search%'  OR afterdiscount LIKE '%$search%'  OR commission LIKE '%$search%' )";
       $query_run = mysqli_query($connection,$query);
    
        ?>
    </table>
    <!-- View Ticket title  --> 
    <h1 style="text-align: center; ">View Tickets</h1>
    <!-- View Voided Tickets   --> 
    <button  onclick="location.href='voidedtickets.php'" style="width: 11em; float: right; margin-top: -45px;" id="stockbtn">View Voided Tickets</button>
    <form action="viewtickets.php" method="POST">
    <!-- Search button  --> 
    <input type="text" name="search" placeholder="Search by any field">
    <button type="submit" name="submit-search">Search</button>
    </form>
    <!-- Table --> 
    <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        
            <tbody>
            <?php
        if(mysqli_num_rows($query_run) > 0) { 
            ?>
        <thead>
            <tr>
            <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">ID</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Date Pur</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Paid?</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Type</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Payment Type</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Blank No</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Full Name</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Origin</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Destination</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Amount</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">USD Rate</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Amount (USD)</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Tax</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">TOTAL Amnt</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Card Name</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Card Number</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">CVV</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Expiry Date</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Disc %</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Discount Payout</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Commission</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Sold By</th>
                <th style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;">Void</th>
            </tr>
        </thead>
        <?php
            while($row = mysqli_fetch_assoc($query_run)) {
                ?>
            <tr >
            <!-- Retreives data from the soldticket table and places it into the $row -->
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['id'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['date1'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['datepaid'] ?  'Yes' : 'No' ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['type1'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['paymenttype1'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['blanktypeandno1'] ?> </td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['fullname1'] ?> <?php echo $row['othername'] ?></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['origin'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['destination'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['currcode'] ?><?php echo $row['amount1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['USD'] ?> USD * <?php echo $row['decimals'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['amountUSD'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['totaltax'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['totalamount1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['nameoncard1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['cardno1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['cvv1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['expirydate1'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['discperc'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['afterdiscount'] ?></input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['commission'] ?>%</input></td>
                <td style="border: 1px solid black; text-align: center; padding: 5px; font-size: 12px;"><?php echo $row['soldby'] ?></input></td>
                <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                    <form action="../code.php" method="post">
                    <input type="hidden" name="void_id_blank" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="void_btn_blank">VOID</button>
                    </form>
                </td>
                    </form>
                </td>
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
