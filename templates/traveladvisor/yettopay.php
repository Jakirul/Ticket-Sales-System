<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
    <!-- title -->  
    <title>Yet to Pay</title>
    <!-- google font -->  
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
   
 <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content" style="margin-top:18em; width: 60rem">
        <span class="close">&times;</span>
        <!-- Late payments made title -->
        <p style="text-align: center;">Late Payments Made</p><br>

        <?php
       //db connection
       $connection = mysqli_connect("localhost","root","","ats");
      //selects everything from late payments table
       $query = "SELECT * from latepayments";
       $query_run = mysqli_query($connection,$query);
    
        ?>
    
        <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
           
            <tbody>
            <?php
                if (mysqli_num_rows($query_run) > 0) {
            ?>
            <thead>
                <tr>
                    <th style="border: 1px solid black; ">Full Name</th>
                    <th style="border: 1px solid black; ">Amount Due</th>
                </tr>
            </thead>
            <?php
                while($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <tr>
                    <td style="border: 1px solid black; text-align: center;  "><?php echo $row['fullname1'] ?></td>
                    <td style="border: 1px solid black; text-align: center;  "><?php echo $row['amount1'] ?> </td>
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
<header id="showcase">
            <div class="contain">
                <div class="showcase-contain">
                    <div class="showcase-content">
                        <div id="container" style="max-width: 90%;">
                        <div class="form-wrap" style="max-width: 100rem;text-align: center;">
    <?php
        //db connection
       $connection = mysqli_connect("localhost","root","","ats");
       $query = "SELECT a.othername,a.fullname1,b.fullname,a.amount1 from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY > NOW() AND a.datepaid = '0') ";
        $query_run = mysqli_query($connection,$query);
    
        ?>
    </table>
    
    <h1 style="text-align: center; ">Yet to Pay List (Below 30 Days)</h1>
    <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
           
            <tbody>
            <?php
            if (mysqli_num_rows($query_run) > 0) {
      
         ?><thead>
         <tr>
            <th style="border: 1px solid black; ">Full Name</th>
             <th style="border: 1px solid black; ">Amount Due</th>
             <th style="border: 1px solid black;">Pay</th>
            
         </tr>
         </thead>
         <?php
            while($row = mysqli_fetch_assoc($query_run)) {
               
                ?>

        
            <tr>
            <td style="border: 1px solid black; text-align: center;  "><?php echo $row['fullname1'] ?><?php echo $row['othername'] ?> </td>
            
           
            <td style="border: 1px solid black; text-align: center;  "><?php echo $row['amount1'] ?> </td>
          
                <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                  
                    <input type="hidden" onclick="location.href='yettopay1.php'" >
                    <button type="submit" onclick="location.href='yettopay1.php'" >PAY</button>
                  
                </td>
                
            </tr>
            <?php
            }}
            else {
                echo "No record found";

            }
    ?>
         </div>
                            </div>

                    </div>
                </div>
            </div>
            
        </header>

       
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");


            // Get the button that opens the modal
            var btn = document.getElementById("latepaymentmade");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];


            // When the user clicks the button, open the modal
            btn.onclick = function() {
              modal.style.display = "block";
            }


            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
              modal.style.display = "none";
            }



            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                modal.style.display = "none";
            }
            }
            </script>
</body>
</html>
