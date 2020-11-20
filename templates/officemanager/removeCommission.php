<?php
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php');
?>
<!DOCTYPE html>
<php lang="en">
<head>
<!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
    <!-- title -->
    <title>Remove Commission</title>
    <!-- font script -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<script>
//get ticket amount javascript code
function getTicketAmount(val) {
	$.ajax({
	type: "POST",
	url: "get_ticketno2.php",
	data: {id: val}, 
	success: function(data){
		$("#blankno").html(data);
	}
	});
}
</script>
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
                <li><a href="setCommission.php">Set Commission</a></li>
                <li><a href="removeCommission.php" class="present">Remove Commission</a></li>
                <li><a href="discount.php">Fixed Discount</a></li>
                <li><a href="flexiblediscount.php">Flexible Discount</a></li>
                <li><a href="yettopay.php">Yet to Pay</a></li>
                <li><a href="latepayment0.php">Late Payment</a></li>
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
                <?php 
            }
            
            ?>
            </div>
             <!-- log out button  --> 
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
                    <form action="../code.php" method="POST">
                        <div class="center" style="display: block; margin: 50px auto;">
                        <!-- Travel agent drop down list -->
                        <label for="soldby">Travel Agent Name:</label>
                        <select name="soldby" id="country-list" class="demoInputBox"  onChange="getTicketAmount(this.value);">
                        <option value="">Select Name</option>
                        <?php
                        //sql query
                        $sql1="SELECT DISTINCT soldby FROM soldticket ";
                        //database connection
                        $connection = mysqli_connect("localhost","root","","ats");
                         $results=$connection->query($sql1); 
                        while($rs=$results->fetch_assoc()) { 
                        ?>
                        <option value="<?php echo $rs["soldby"]; ?>"><?php echo $rs["soldby"]; ?></option>
                        <?php
                        }
                        ?>
                        </select>
                        </div>
                
                        <div class="center" style="display: block; margin: 50px auto;">
                        <!-- blank sold drop down list -->
                            <label>Blank Number Sold:</label>
                       
                            <select id="blankno"  name="blanktypeandno1" >
                                <option value="">Blank Number Sold </option>
                            </select>
                        </div>
                        
                    
                        <!-- Remove commission submission button -->
                        <button type="submit" style="display: block; margin: 2rem auto ;" name="removeCommissionBtn" id="submit" >Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </header>



</body>
</html>
