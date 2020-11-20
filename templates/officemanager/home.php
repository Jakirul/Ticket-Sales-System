<?php
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
    <!-- Title -->
    <title>Home - Office Manager</title>

</head>

<body>
    <!-- Navigation -->
    <nav id="main-nav1" style="background: #f7f7f7;">
    <div class="contain" style="padding: 2.5rem;">
            
             <a href="home.php">
             <!-- This is the logo that appears on the top left -->
                    <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
           
             <!-- Navigation bar -->
                <div class="test" style="display: flex;align-items: center;justify-content: center;">
                <ul style="list-style: none;">
                    <li style="font-size: 25px;">Welcome <strong><?php echo $_SESSION['username'] ?>!</strong></li>
                    
                </ul>
                </div>
                <?php 
            //this is the connection to the database
            $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                //this selects the information from the database
                $result = $connection->query("SELECT a.othername,a.fullname1,b.fullname,a.amount1 from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY < NOW() AND a.datepaid = '0' AND a.paymenttype1 = 'PayLater') ");
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
            <form action="../logout.php" method="POST">                 
            <div class="item" style="padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 5px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn">Log Out</button>
                    </div>
                </form> 
        </nav>
        <!-- showcase -->
        <header id="showcase">
            <div class="contain">
                <div class="showcase-contain">
                    <div class="showcase-content">
                        <h1 class="text-center">Blanks</h1>
                        <div class="blanks">
                            <a href="assignBlank.php">
                                <div class="box1">Assign Blank</div>
                            </a>
                            <a href="assignedBlanks.php">
                                <div class="box1">Assigned Blank</div>
                            </a>
                            <a href="viewtickets.php">
                                <div class="box1">View Tickets</div>
                            </a>
                            <a href="refundedticket.php">
                                <div class="box1">Refunded Tickets</div>
                            </a>
                        </div>
                        <h1 class="text-center">Payment</h1>
                        <div class="blanks">
                            <a href="setCommission.php">
                                <div class="box1">Set Commission</div>
                            </a>
                            <a href="removeCommission.php">
                                <div class="box1">Remove Commission</div>
                            </a>
                            <a href="discount.php">
                                <div class="box1">Fixed Discount</div>
                            </a>
                            <a href="flexiblediscount.php">
                                <div class="box1">Flexible Discount</div>
                            </a>
                            
                            <a href="yettopay.php">
                                <div class="box1">Yet to Pay (Below 30 Days)</div>
                            </a>
                            <a href="latepayment0.php">
                                <div class="box1">Late Payments (Over 30 Days)</div>
                            </a>
                        </div>
                        <h1 class="text-center">Customer</h1>
                        <div class="blanks">
                            <a href="customerstatus.php">
                                <div class="box1">Customer Status</div>
                            </a>
                        </div>
                        <h1 class="text-center">Reports</h1>
                        <div class="blanks">
                        <a href="globalinterline.php">
                            <div class="box1">Global Interline Report</div>
                        </a>
                        <a href="globaldomestic.php">
                            <div class="box1">Global Domestic Report</div>
                        </a>
                        <a href="globalinterlineperusd.php">
                            <div class="box1">Global Interline (Per USD Rate) Report</div>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </header>

</body>
</html>

