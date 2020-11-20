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
    <title>Assigned Blanks</title>
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
                <li><a href="refundedticket.php" >Refunded Tickets</a></li>
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
                <?php  } ?>
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
                    <?php 
                    //This allows a message to appear saying "reassigned successfully" once they submit successfully.
                        if(isset($_SESSION['success']) && $_SESSION['success'] != '') {
                            echo '<h2 style="text-align: center;"> '.$_SESSION['success'].' </h2>';
                            unset($_SESSION['success']);
                        }
                        if(isset($_SESSION['status']) && $_SESSION['status'] != '') {
                            echo '<h2 class="bg-info"> '.$_SESSION['status'].' </h2>';
                            unset($_SESSION['status']);
                        }
                    ?>
                        <div id="container" style="max-width: 90%;">
                        <div class="form-wrap" style="max-width: 100rem;text-align: center; height:800px; overflow: auto">
                        <?php
                            //database connection
                           $connection = mysqli_connect("localhost","root","","ats");
                           //this is the search feature
                           $search = mysqli_real_escape_string($connection, @$_POST['search']);
                            //this code lets the search feature work in the sql statement
                           $query = "SELECT * FROM assignblank WHERE (blanktypeandno LIKE '%$search%' OR date1 LIKE '%$search%' OR staffid LIKE '%$search%' OR email LIKE '%$search%') AND (email = '".$_SESSION['username']."')";
                           $query_run = mysqli_query($connection,$query);
                        
                        ?>
                        <!-- Blanks Assigned Title -->
                        <h1 style="text-align: center; ">Blanks Assigned</h1>
                        <form action="assignedBlanks.php" method="POST">
                            <input type="text" name="search" placeholder="Search by Date, Blank No, TA ID or OM ID">
                            <button type="submit" name="submit-search">Search</button>
                        </form>
                      
                        <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       
                                <?php
                                    if (mysqli_num_rows($query_run) > 0) {
                                ?>
                                <thead>
                                    <tr>
                                    <th style="border: 1px solid black; ">Date Assigned</th>
                                        <th style="border: 1px solid black; ">Blank Type and Number</th>
                                        <th style="border: 1px solid black;">TA ID</th>
                                        <th style="border: 1px solid black;">OM ID</th>
                                        <th style="border: 1px solid black;">Reassign</th>
                                    </tr>
                                </thead>
                                <?php
                                    while($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr>
                                    <td style="border: 1px solid black; text-align: center;  "><?php echo $row['date1'] ?> </td>
                                    <td style="border: 1px solid black; text-align: center;  "><?php echo $row['blanktypeandno'] ?> </td>
                                    <td style="border: 1px solid black;"><?php echo $row['staffid'] ?> </td>
                                    <td style="border: 1px solid black;">  <?php echo $row['email'] ?></input></td>
                                    <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                                        <form action="assignedblank_edit.php" method="post">
                                            <input type="hidden" name="edit_id_blank" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="edit_btn_blank">REASSIGN</button>
                                        </form>  
                                    </td>
                                </tr>
                                <?php }} else {
                                    echo "No record found";
                                } ?>
                        </table>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>

</body>
</html>
