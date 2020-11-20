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
    <title>Yet to Pay</title>
     <!-- jquery -->  
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
    </nav></form> 
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
            <!-- Name dropdown field -->
                <label  style="text-align: center; font-size: 30px;" for="blanktypeandno" >Name:</label>
            </div>
            <div class="col-75">
                <select name="fullname1" id="country-list" class="demoInputBox"  onChange="getAmount(this.value);">
                    <option value="">Select Name</option>
                    <?php
                    $sql1="SELECT a.othername,a.fullname1,b.fullname,a.amount1 from soldticket a LEFT JOIN customer b ON a.fullname1 = b.fullname WHERE (a.date1 + INTERVAL 30 DAY > NOW() AND a.datepaid = '0') ";
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
            <div class="col-25">
             <!--Amount due dropdown field -->
                <label style="font-size:30px" >Amount Due:</label>
            </div>
            <div class="col-75">
            <select id="state-list" type="text"  name="amount1" >
                <option value=""></option>
            </select>
            </div>
        </div>  

        <div class="row">
         <!-- date field -->
            <div class="col-25">
                <label for="date" style="text-align: center; font-size: 30px;">Date</label>
            </div>
            <div class="col-75">
                <input type="date"  name="datepaid1" required> <br> 
            </div>
        </div>
        <div class="row">
         <!-- payment type dropdown field -->
          <div class="col-25">
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
         <!-- name on card field -->
            <div class="col-25">
              <label style="font-size: 30px;" for="nameoncard1">Name on Card</label>
            </div>
            <div class="col-75">
              <input type="text" id="nameoncard1" minlength="1" maxlength="15" name="nameoncard1" placeholder="e.g: J Smith" >
            </div>
          </div>

          <div class="row">
           <!-- card number field -->
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
            <div class="col-25">
            <!-- hidden date paid checkbox field -->
            </div>
            <div class="col-75">
            <input type="checkbox" style="opacity:0; position:absolute; left:9999px;"  id="datepaid" name="datepaid"  value="1" CHECKED>
            </div>
          </div>
                    <!-- submission btn -->
          <button onclick="location.href='#'" type="submit" name="yetopaybtn1">Submit Payment</button>

        

        
      </form>

</div>
</div>
</div>
</div>
</div>
                  </header>
    
</body>
</html>
