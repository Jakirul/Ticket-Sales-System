<?php
//security.php contains the security feature where you can't visit any pages without logging in. 
include('../security.php');
?>
<!DOCTYPE html>
<php lang="en">
<head>
<!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- Title -->  
    <title>Late Payment</title>
    <!-- jqeury script -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<script>
//get amount javascript
function getAmount(val) {
	$.ajax({
	type: "POST",
	url: "get_amount3.php",
	data: {id: val}, 
	success: function(data){
		$("#state-list").html(data);
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
       $result = $connection->query("SELECT a.othername,a.fullname1,b.fullname,a.amount1 from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY < NOW()) AND a.datepaid = '0' ");
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
    
        <header id="showcase">
            <div class="contain">
                <div class="showcase-contain">
                    <div class="showcase-content">
                        <div id="container" style="max-width: 90%;">
                        <div class="form-wrap" style="max-width: 100rem;text-align: center;">

              <form action="../code.php" method="POST">
              <div class="row">
                  <div class="col-25">
                  <!-- Name drop down list -->
                      <label  style="text-align: center; font-size: 30px;" for="blanktypeandno" >Name:</label>
                  </div>
                  <div class="col-75">
                      <select name="fullname1" id="country-list" class="demoInputBox"  onChange="getAmount(this.value);">
                    <option value="">Select Name</option>
                    <?php
                    $sql1="SELECT a.othername,a.fullname1,b.fullname,a.amount1 from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY < NOW() AND a.datepaid = '0') ";
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
        </div>

        <div class="row">
        <!-- Amount due drop down box -->
            <div class="col-25">
                <label style="font-size:30px" >Amount Due:</label>
            </div>
            <div class="col-75">
            <select id="state-list" type="text"  name="amount1" >
                <option value=""></option>
            </select>
            </div>
        </div>  

        <div class="row">
        <!-- Date field -->
            <div class="col-25">
                <label for="date" style="text-align: center; font-size: 30px;">Date</label>
            </div>
            <div class="col-75">
                <input type="date"  name="datepaid1" required> <br> 
            </div>
        </div>
        <div class="row">
          <div class="col-25">
          <!-- Payment type drop down list -->
            <label style="font-size: 30px;" for="paymenttype1">Payment Type</label>
          </div>
          <div class="col-75">
            <select id="paymenttype1" name="paymenttype1" required>
              <option value="" disabled selected >Payment Type</option>
              <option value="Cash">Cash</option>
              <option value="Card">Card</option>
       
            </select>
          </div>
        </div>
        <div class="row">
        <!-- Name on card field -->
            <div class="col-25">
              <label style="font-size: 30px;" for="nameoncard1">Name on Card</label>
            </div>
            <div class="col-75">
              <input type="text" id="nameoncard1" minlength="1" maxlength="15" name="nameoncard1" placeholder="e.g: J Smith" >
            </div>
          </div>

      

          <div class="row">
          <!-- Card number field -->
            <div class="col-25">
              <label style="font-size: 30px;" for="cardno1">Card Number:</label>
            </div>
            <div class="col-75">
              <input type="text" id="cardno1" name="cardno1" minlength="12" maxlength="19" placeholder="e.g: 6756 8753 9868 3234" >
            </div>
          </div>

          <div class="row">
          <!-- CVV field -->
            <div class="col-25">
              <label style="font-size: 30px;" for="cvv1">CVV</label>
            </div>
            <div class="col-75">
              <input type="text" minlength="3" maxlength="4" id="cvv1" name="cvv1" placeholder="e.g: 424" >
            </div>
          </div>

          <div class="row">
         <!-- expiration date field --> 
            <div class="col-25">
              <label style="font-size: 30px;"  for="expirydate1">Expiration Date</label>
            </div>
            <div class="col-75">
              <input type="text" id="expirydate1"  minlength="3" maxlength="5" name="expirydate1" pattern="([0-9]{2}[/]?){2}" placeholder="e.g: 10/22" >
            </div>
          </div>

          <div class="row">
          <!-- date paid check box -->
            <div class="col-25">
            </div>
            <div class="col-75">
            <input type="checkbox" style="opacity:0; position:absolute; left:9999px;"  id="datepaid" name="datepaid"  value="1" CHECKED>
            </div>
          </div>
          <!-- submission button -->
          <button onclick="location.href='#'" type="submit" name="latepaymentbtn">Submit Payment</button>

        

        
      </form>

</div>
</div>
</div>
</div>
</div>
</header>
    
</body>
</html>
