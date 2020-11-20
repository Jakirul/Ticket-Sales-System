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
    <title>Assigned Blank Editor</title>
    <style>
        /* table designing */
        td,th {
            padding: 5px;
        }
        
    </style>
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
                    <li><a href="assignedBlanks.php" class="present">Assigned Blank</a></li>
                    <li><a href="viewtickets.php" >View Tickets</a></li>
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
            <!-- log out button -->
            <form action="../logout.php" method="POST">                 
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
                        <div id="container" style="max-width: 60%; max-height: 90%">
                            <div class="form-wrap">
                            <!-- Edit Blank Title -->
                                <h6>Edit Blank</h6>
                                <?php
                                    //database connection
                                    $connection = mysqli_connect("localhost","root","","ats");
                                    //if the edit blank button is pressed, then it runs this sql statement below
                                    if(isset($_POST['edit_btn_blank']))  {
                                        $id = $_POST['edit_id_blank'];
                                        //selects everything from assign blank where the id matches 
                                        $query = "SELECT * FROM assignblank WHERE id='$id' ";
                                        $query_run = mysqli_query($connection, $query);

                                        foreach($query_run as $row) 
                                { ?>
                                    <!-- This is the edit form -->
                                    <form action="../code.php" method="POST">
                                    <input type="hidden" name="edit_id_blank" value="<?php echo $row['id'] ?>">
                                        <div class="form-group" >
                                            
                                            <label for="username" style="text-align: center; font-size: 40px; ">Blank Type and Number</label>
                                            <!-- $row[x] gets the data from the database that matches with the one selected in the assignBlank.php page -->
                                            <input type="text" name="blanktypeandno" value="<?php echo $row['blanktypeandno'] ?>" class="form-control">
                                        </div>

                                        <div class="center " style="display: block; margin: 50px auto;">
                                            <label for="staffID" style="font-size: 40px;">Staff ID:</label>
                                                            
                                            <?php 
                                                //database connection
                                                $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                                                //selects the username where the user type is the travel advisor
                                                $result = $connection->query("SELECT username from systemuser WHERE usertype='TRAVEL_ADVISOR'");
                                            ?>
                                            <select  id="blanktype" name="staffid" required>
                                            <?php
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                                                
                                            } ?>
                                            </select>
                                        </div>

                                        <!-- update button -->
                                        <button name="reassignbtn">Update </button>
                                    </form>
                                    <!--Cancel Button -->
                                    <button onclick="location.href='assignedBlanks.php'" >Cancel</button>
                                            <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </body>
</html>