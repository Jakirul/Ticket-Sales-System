<?php 
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
    <!-- The title -->
    <title>Customer Status</title>
</head>
<body>
    <!-- Navigation -->
    <nav id="main-nav">
    <div class="contain" style="padding: 2.4rem;">
                <a href="home.php">
                    <!-- This is the logo that appears on the top left  -->
                    <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <ul>
                <!-- Navigation bar -->
                <li><a href="customerstatus.php" class="present">Customer Status</a></li>
            </ul>
             <!-- php code to program the late button notification -->
            <?php 
                //database connection
                $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                //SQL statement
                $result = $connection->query("SELECT a.othername,a.fullname1,b.fullname,a.amount1 from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY < NOW() AND a.datepaid = '0') ");
                 //late payment button that appears on the far right of the nav bar
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
             <!-- log out button -->
            <div class="item" style=" padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 10px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn">Log Out</button>
                    </div>
                </form> 
        </nav>
      
    <header id="showcase">
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                <?php 
                 //This allows a message to appear saying "customer status set successfully" once they submit successfully.
            if(isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 style="text-align: center; margin-bottom: 10px;"> '.$_SESSION['success'].' </h2>';
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 style="text-align: center; margin-bottom: 10px;"> '.$_SESSION['status'].' </h2>';
                unset($_SESSION['status']);
            }


        ?>
                    <form action="../code.php" method="POST">
                    <div class="center" style="display: block; margin: 50px auto;">
                     <!-- Customer ID field -->
                            <label  for="blanktypeandno" style="font-size: 40px;">Customer ID:</label>
                
                        <?php 
                       //database connection
                       $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                       //selects all the names from the customer table
                       $result = $connection->query("SELECT fullname from customer");?>
                
                        <select  id="fullname" name="fullname" required>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['fullname'] . "'>" . $row['fullname'] . "</option>";     
                        }
                        ?>
                
                        </select>
                        </div>
                         <!-- Customer Status drop down box -->
                        <div class="center" style="display: block; margin: 50px auto;">
                            <label for="type">Customer Status:</label>
                            
                            <div class="center2">
                            <select  id="type" name="type" required>
                                <option disabled selected value="">Customer Status</option>
                                <option value="Valued">Valued</option>
                                <option value="Regular">Regular</option>
                         
                            </select>
                        </div> 
                    </div>
                    <div class="center" style="display: block; margin: 50px auto;">
                    <!-- Submission button -->
                        <button onclick="location.href='#'" style="display: block; margin:  auto; margin-bottom: 15px;" name="customerstatussubmit" type="submit" id="submit" >Submit</button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </header>
       



</body>
</html>
