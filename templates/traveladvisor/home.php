<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>
<!DOCTYPE html>
<php lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- title --> 
    <title>Home Page - Travel Advisor</title>
</head>
<body>
    <!-- Navigation -->
    <nav id="main-nav">
        <div class="contain" style="padding: 2.15rem;">
            
            <a href="home.php">
                 <!-- This is the logo that appears on the top left -->
                <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <div class="test" style="display: flex;align-items: center;justify-content: center;">
                <ul style="list-style: none;">
                 <!-- Nav Bar -->
                <li style="font-size: 25px;">Welcome <strong><?php echo $_SESSION['username2'] ?>!</strong></li>
            </ul>
        </div>
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
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                    <h1 class="text-center">Blanks</h1>
                    <div class="blanks">
                        <a href="assignedBlanks.php">
                            <div class="box1">Assigned Blanks</div>
                        </a>
                        <a href="tickets.php">
                            <div class="box1">Sell Ticket</div>
                        </a>
                        <a href="soldticket.php">
                            <div class="box1">Sold Tickets</div>
                        </a>
                        <a href="cancelTicket.php">
                            <div class="box1">Cancel Ticket</div>
                        </a>
                        <a href="refundTicket.php">
                            <div class="box1">Refund Ticket</div>
                        </a>
                    </div>
                    <h1 class="text-center">Customer</h1>
                    <div class="blanks">
                        <a href="createcustomeraccount.php">
                            <div class="box1">Create Customer Account</div>
                        </a>
                        <a href="accountlist.php">
                            <div class="box1">Customer Details</div>
                        </a>
                    </div>
                    <h1 class="text-center">Reports</h1>
                    <div class="blanks">
                        <a href="individualinterline.php">
                            <div class="box1">Individual Interline Report</div>
                        </a>
                        <a href="individualdomestic.php">
                            <div class="box1">Individual Domestic Report</div>
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </header>

<!-- 


    <header id="showcase">
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                    
                </div>
            </div>
        </div>
    </header>


 -->
</body>
</html>
