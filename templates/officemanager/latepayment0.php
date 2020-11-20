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
    <title>Late Payment</title>
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
                <li><a href="setCommission.php">Set Commission</a></li>
                <li><a href="removeCommission.php">Remove Commission</a></li>
                <li><a href="discount.php">Fixed Discount</a></li>
                <li><a href="flexiblediscount.php" >Flexible Discount</a></li>
                <li><a href="yettopay.php">Yet to Pay</a></li>
                <li><a href="latepayment0.php" class="present">Late Payment</a></li>
            </ul>
            <?php 
       //this is the connection to the database
       $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
       //this selects the information from the database
       $result = $connection->query("SELECT a.othername,a.fullname1,b.fullname from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY < NOW() AND a.datepaid = '0') ");
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
            <form action="../logout.php" method="POST">                 
            <!-- log out button  --> 
            <div class="item" style=" padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 10px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn">Log Out</button>
                    </div>
                </form> 
        </nav>

   
 <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content" style="margin-top:18em; width: 60rem">
        <span class="close">&times;</span>
        <!-- late payment made text --> 
        <p style="text-align: center;">Late Payments Made</p><br>

        <?php
        //DB connection
       $connection = mysqli_connect("localhost","root","","ats");
       //sql statement that selects everything from late payments
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
            //DB CONNECTION
        $connection = mysqli_connect("localhost","root","","ats");
        $query = "SELECT a.othername,a.fullname1,b.fullname,a.amount1 from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY < NOW() AND a.datepaid = '0') ";
        $query_run = mysqli_query($connection,$query);
        ?>
        </table>
        <!-- Late Payment List Button -->
        <h1 style="text-align: center; ">Late Payment List</h1>
         <!-- Late Payment Made Button -->
        <button  style="width: 12em; float: right; margin-top: -45px;" id="latepaymentmade">Late Payments Made</button>
         <!-- Table  -->
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
            while($row = mysqli_fetch_assoc($query_run)) { ?>

            <tr>
                <td style="border: 1px solid black; text-align: center;  "><?php echo $row['fullname1'] ?><?php echo $row['othername'] ?> </td>
                <td style="border: 1px solid black; text-align: center;  "><?php echo $row['amount1'] ?> </td>
                <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                    <input type="hidden" onclick="location.href='latepayment.php'" >
                    <button type="submit" onclick="location.href='latepayment.php'" >PAY</button>
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
