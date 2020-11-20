<?php
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>
    <!-- Title -->
    <title>Assign Blank</title>
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
            <!-- Navigation bar -->
                <li><a href="assignBlank.php"class="present">Assign Blank</a></li>
                <li><a href="assignedBlanks.php" >Assigned Blank</a></li>
                <li><a href="viewtickets.php" >View Tickets</a></li>
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
                    </div>
                <?php } ?>
        </div>
        <!-- log out button  -->
            <form action="../logout.php" method="POST">                 
                <div class="item" style=" padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 10px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" type="submit" class="logoutbtn" name="logout_btn">Log Out</button>
                </div>
            </form> 
    </nav>
               

        <header id="showcase">
            <div class="contain">
                <div class="showcase-contain">
                    <div class="showcase-content">
                        <div id="myModal" class="modal" >
                            <!-- Modal content. it's the pop up box that appears -->
                            <div class="modal-content" style=" width: 60rem; margin-top: 50px;">
                            <!-- close button -->
                                <span class="close">&times;</span>
                                <!-- assign bulk blank title -->
                                <p style="text-align: center;">Assign Bulk Blank</p>
                    
                                <form method="post" action="../code.php" style="text-align: left;">
                    
                                    <label for="date" style="text-align: center; font-size: 40px; color: #333;">Date</label>
                                    <input type="date"  name="date1" value="<?php echo $row['date1'] ?>"/> <br>
                                    <!-- This is the first range for the bulk assigning. -->
                                    <label id="blanknolabel" for="range1" style="text-align: center; font-size: 40px; color: #333;">Range 1:</label> 

                                        <?php 
                                            //php code for getting the list of blank numbers assigned to the office manager username that is logged in currently
                                            $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                                            //sql statement
                                            $result = $connection->query("SELECT blanktypeandno from adminassignedblanks WHERE OMid='$_SESSION[username]'");?>

                                            <select  id="blanktypeandno" name="range1" required>
                                                <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                echo "<option value='" . $row['blanktypeandno'] . "'>" . $row['blanktypeandno'] . "</option>"; }
                                        ?> 
                                            </select>
                    
                                    <!-- This is the second range for the bulk assigning. -->
                                    <label id="blanknolabel" for="blankno" style="text-align: center; font-size: 40px; color: #333;">Range 2:</label> 
                                        <?php 
                                            $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                                            $result = $connection->query("SELECT blanktypeandno from adminassignedblanks WHERE OMid='$_SESSION[username]'");
                                        ?>
                                            <select  id="blanktypeandno" name="range2" required>
                                            <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row['blanktypeandno'] . "'>" . $row['blanktypeandno'] . "</option>"; }
                                            ?>
                                            </select>
                                    <!-- this is the code for the staff ids that appear in a dropdown menu--> 
                                    <label for="staffID" style="text-align: center; font-size: 40px; color: #333;">Staff ID:</label>
                                        <?php 
                                            $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                                            $result = $connection->query("SELECT username from systemuser WHERE usertype='TRAVEL_ADVISOR'");
                                        ?>
                                            <select  id="blanktype" name="staffid" required>
                                            <?php
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";   }
                                            ?>
                                            </select>
                                        
                                    <input style="text-align: center" size=50 type="hidden" value="<?php echo $_SESSION['username']; ?>" id="usertype" name="email" readonly>
                                    <!-- this is the submission button for the bulk assign blank button in the modal pop up -->
                                    <button onclick="location.href='#'" type="submit" id="submit" name="assignBlankBulkbtn">Submit</button>
                                </form>
                            </div>
                        </div>
                           
                        <form method="post" action="../code.php">
                            <!-- Date field -->
                            <div class="center" style="display: block; margin: 50px auto;">
                                <label for="date" style="text-align: center; font-size: 40px;">Date:</label>
                                <input type="date" style="font-size: 1rem"  name="date1" value="<?php echo $row['date1'] ?>"/> <br> 
                            </div>
                              <!-- Assigned Blank dropdown field -->                       
                            <div class="center" style="display: block; margin: 50px auto;">
                                <label  for="blanktypeandno" style="font-size: 40px;">Assigned Blank Type/No:</label>
                    
                            <?php 
                           
                            $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                            $result = $connection->query("SELECT blanktypeandno from adminassignedblanks WHERE OMid='$_SESSION[username]'");?>
                        
                            <select  id="blanktypeandno" name="blanktypeandno" required>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['blanktypeandno'] . "'>" . $row['blanktypeandno'] . "</option>";     
                            }
                            ?>
                            </select>
                            </div>

                             <!-- Staff ID dropdown list -->
                            <div class="center " style="display: block; margin: 50px auto;">
                                <label for="staffID" style="font-size: 40px;">Staff ID:</label>
                                
                            <?php 
                            //connection to the db
                            $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                            $result = $connection->query("SELECT username from systemuser WHERE usertype='TRAVEL_ADVISOR'");?>
                        
                                <select  id="blanktype" name="staffid" required>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                                    
                                }
                    
                            ?>
                    
                            </select>
                            </div>
                            <!-- hidden usertype field -->
                            <div class="center">
                                <div class="center2">
                                <input style="text-align: center" size=50 type="hidden" value="<?php echo $_SESSION['username']; ?>" id="usertype" name="email" readonly>
                                </div>
                            </div>
                            
                         
                        <!-- Assign blank submission button -->        
                        <button onclick="location.href='#'" style="display: block; margin: -105px auto; margin-bottom: 15px;"  type="submit" id="submit1" name="assignBlankbtn">Submit</button> 
                            
                          </form>
                          <!-- Bulk blank option button -->
                        <button  id="assignBlankbtn2" style="display: block; margin: 0 auto;" >Click for Bulk Blanks Option</button>


                    </div>
                </div>
            </div>
        </header>




        <!-- Javascript code to make the pop up box work.  -->
      <script>
            // Get the modal
            var modal = document.getElementById("myModal");


            // Get the button that opens the modal
            var btn = document.getElementById("assignBlankbtn2");

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
