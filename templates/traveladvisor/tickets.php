<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>
<!DOCTYPE html>
<php lang="en" >
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- title -->  
    <title>Tickets</title>
</head>
<body>
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
                <li><a href="tickets.php"  class="present">Sell Tickets</a></li>
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
                    <main id="section">
                        <ul>
                            <li>
                                <div class="icon">
                                    <a href="sellticket.php" ><i class="fas fa-home"></i></a>
                                </div>
                                <div class="name">
                                <!-- domestic ticket button -->
                                    <button  onclick="location.href='sellticket.php'" type="button" id="sellTicket" >Domestic Ticket</button>
                                </div>
                            </li>

                            <li>
                                <div class="icon">
                                    <a href="interlineticket.php" ><i class="fas fa-globe"></i></a>
                                </div>
                                <div class="name">
                                 <!-- interline ticket button -->
                                    <button  onclick="location.href='interlineticket.php'" type="button" id="sellTicket" >Interline Ticket</button>
                                </div>
                            </li>

                        </ul>
                    </main>
                    
                </div>
            </div>
        </div>
    </header>
</body>
</html>
