<?php
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php');

//this is the code for the discountsubmit2 button that is at the bottom of this page.
//it sets the discount rates
if(isset($_POST['discountsubmit2'])) {
  
    $connection = mysqli_connect("localhost","root","","ats");
    $amount1 = $_POST['amount1'];
    $discount = $_POST['discount'];
    $existingdiscount = $_POST['existingdiscount'];
    $afterdiscount = $_POST['afterdiscount'];
    $fullname1 = $_POST['fullname1'];
    $discperc = $_POST['discperc'];

    $sql = mysqli_query($connection,"UPDATE soldticket SET discount='' WHERE fullname1 = '$fullname1'");
    $sql = mysqli_query($connection,"UPDATE soldticket SET discount='$discount' WHERE fullname1 = '$fullname1'");
    $sql = mysqli_query($connection,"UPDATE soldticket SET discperc='' WHERE fullname1 = '$fullname1'");
    $sql = mysqli_query($connection,"UPDATE soldticket SET discperc='$discperc' WHERE fullname1 = '$fullname1'");
    $sql = mysqli_query($connection,"UPDATE soldticket SET existingdiscount = '' WHERE fullname1 = '$fullname1'");
    $sql = mysqli_query($connection,"UPDATE soldticket SET existingdiscount = existingdiscount + '$discount'  WHERE fullname1 = '$fullname1'");
    $sql = mysqli_query($connection,"UPDATE soldticket SET afterdiscount = '' WHERE fullname1 = '$fullname1'");
    $sql = mysqli_query($connection,"UPDATE soldticket SET afterdiscount = '$amount1' - existingdiscount WHERE fullname1 = '$fullname1'");
   
    header("Location: flexiblediscount.php");
  }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
 <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>  
    <!-- Title --> 
    <title>Flexible Discount</title>
    <!-- jquery script -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<script>

//get date javascript function
function getDate(val) {
	$.ajax({
	type: "POST",
	url: "get_date.php",
	data: {id: val}, 
	success: function(data){
		$("#month").html(data);
	}
	});
}

//get amount javascript function
function getAmount(val) {
	$.ajax({
	type: "POST",
	url: "get_amount2.php",
	data: {id: val}, 
	success: function(data){
		$("#state-list").html(data);
	}
	});
}

//get discount javascript function
function getDiscount(num) {
    $.ajax({
	type: "POST",
	url: "discount-calc2.php",
	data: {orignum: $("#state-list").val(), toApply: num}, 
	success: function(data){
		$("#afdis").val(data);
        $("#afdis").attr("value", data);
	}
	});
}
</script>

<body>
    <!-- Navigation -->
    <nav id="main-nav">
    <div class="contain" style="padding: 1.8rem;">
                <a href="home.php">
                    <!-- This is the logo that appears on the top left  -->
                    <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <ul>
            <!-- Navigation bar -->
                <li><a href="setCommission.php">Set Commission</a></li>
                <li><a href="removeCommission.php">Remove Commission</a></li>
                <li><a href="discount.php">Fixed Discount</a></li>
                <li><a href="flexiblediscount.php" class="present">Flexible Discount</a></li>
                <li><a href="yettopay.php">Yet to Pay</a></li>
                <li><a href="latepayment0.php">Late Payment</a></li>
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
    

    <header id="showcase" >
        <div class="contain" >
            <div class="showcase-contain" >
                <div class="showcase-content">
                <form name="myform" action="flexiblediscount.php" method="POST" >

                <div class="center" style="display: inline-block; margin: 50px auto; ">
                <!-- Customer Name Drop Down -->
            <label  for="blanktypeandno" style="font-size: 40px;">Customer Name:</label>
        
                <select name="fullname1" id="fullname1" class="demoInputBox"  onChange="getDate(this.value);">
            <option value="">Select Name</option>
            <?php
            //SQL statement to send the names
            $sql1="SELECT DISTINCT(a.fullname1),a.othername FROM soldticket a INNER JOIN customer b WHERE a.fullname1 = b.alias ";
            $connection = mysqli_connect("localhost","root","","ats");
            $results=$connection->query($sql1); 
            
            while($rs=$results->fetch_assoc()) { 
            ?>
            <option value="<?php echo $rs["fullname1"]; ?><?php echo $rs["othername"]; ?>"><?php echo $rs["fullname1"]; ?><?php echo $rs["othername"]; ?></option>
            <?php
            }
            ?>
            </select>
        </div>

        <div  style="float:left;width:49%; margin-right:2%">
            
            <label style="font-size:30px" >Month</label>
            <select name="month1" id="month"  onChange="getAmount(this.value);">
                <option value="">Month</option>
               
                <?php
                //sql statement to select the dates
            $sql1="SELECT date1 FROM soldticket";
            $connection = mysqli_connect("localhost","root","","ats");
            $results=$connection->query($sql1); 
            
            while($rs=$results->fetch_assoc()) { 
            ?>
            <option value="<?php echo $rs["date1"]; ?>"><?php echo $rs["date1"]; ?></option>
            <?php
            }
            ?>

            </select>
        </div>  
       
        <div  style="float:left;width:49%;margin-right:0">
        <!-- amount spent in month field -->
            <label style="font-size:30px" >Amount Spent In Month</label>
            <select id="state-list" type="text" name="amount1" >
                <option value=""></option>
            </select>
        </div>  

        <br><br>

      
        <div  style="float:left;width:49%; margin-right:2%">
        <!-- discount to be applied field -->
            <label  for="amountneeded" style="font-size: 30px;" >Discount (%) to be applied:</label>
            <input type="text" name="discperc" id="dispc" onkeyup="getDiscount(this.value);">
        </div> 

        
    

        <div  style="float:left;width:49%;margin-right:0">
        <!-- total after discount field -->
            <label  for="total"  style="font-size: 30px;">Total After Discount:</label>
            <input type = "text" name = "discount" id = "afdis" value="" readonly>
    
        </div>  
        
       <div style="text-align: center">
       <!-- discount submit button -->
        <button onclick="location.href='#'"  style="width: 300px; margin: 0 auto;" type="submit" id="submit1" name="discountsubmit2">Submit</button> 
        </div>  
  
      </form>
                    
                </div>
            </div>
        </div>
    </header>


</body>
</html>
