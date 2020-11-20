<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>

<!DOCTYPE html>
<html>
<head>
   <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
      <!-- jquery script -->  
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>    
    <!-- title -->  
    <title>Sell Ticket</title>
</head>
<!-- allows advisor to type other name apart from ones from customer table -->  
<script type="text/javascript">
function CheckOther(val){
 var element=document.getElementById('othername');
 if(val=='other1'||val=='')
   element.style.display='block';
 else  
   element.style.display='none';
}

// get discount rate
function getDiscount(num) {
    $.ajax({
	type: "POST",
	url: "discount-calc.php",
	data: {amount:$("#amount12").val(),orignum: $("#state-list").val(), toApply: num}, 
	success: function(data){
		$("#afdis").val(data);
        $("#afdis").attr("value", data);
	}
	});
}
// get total tax rate
function getDiscount2(num) {
    $.ajax({
	type: "POST",
	url: "discount-calc2.php",
	data: {orignum:$("#localtax").val(),toApply: $("#othertax").val()}, 
	success: function(data){
		$("#totaltax").val(data);
        $("#totaltax").attr("value", data);
	}
	});
}
// get amount rate
function getAmount(num) {
    $.ajax({
	type: "POST",
	url: "getamount.php",
	data: {orignum: $("#amount12").val(), toApply:$("#totaltax").val()}, 
	success: function(data){
		$("#totalamount1").val(data);
        // $("#totalamount1").attr("value", data);
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
                <li><a href="tickets.php" class="present">Sell Tickets</a></li>
                <li><a href="soldticket.php" >Sold Tickets</a></li>
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
    
    <header id="showcase">
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                  <div class="container" style="width: 70rem; color:#333;">
                    <form action="../code.php" method="POST" >
                      <div class="row">
                        <div class="col-25">
                         <!-- Date field  -->      
                        <label for="date" style="text-align: center; font-size: 40px;">Date</label>
                        </div>
                        <div class="col-75">
                        <input type="date"  name="date1" required> <br> 
                        </div>
                      </div>

                      <div class="row">
                       <!-- hidden interline field  -->      
                        <div class="col-25">
                        </div>
                        <div class="col-75">
                        <input type="hidden" id="domestic" name="type1"  minlength="1" maxlength="25" value="Domestic" required>
                        </div>
                      </div>

                      <div class="row">
                      <!-- payment type dropdown field  -->     
                        <div class="col-25">
                          <label style="font-size: 30px;" for="paymenttype1">Payment Type</label>
                        </div>
                        <div class="col-75">
                          <select id="paymenttype1" name="paymenttype1" required>
                            <option value="" disabled selected >Payment Type</option>
                            <option value="Cash">Cash</option>
                            <option value="Card">Card</option>
                            <option value="PayLater">Pay Later</option>
                          </select>
                        </div>
                      </div>

                      <div class="row">
                      <!-- blank type dropdown field from db  -->     
                        <div class="col-25">
                        <label style="font-size:30px;" for="blanktype1">Blank Type and No:</label>
                        </div>
                        <div class="col-75">
                              
                      <?php 

                      $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                      //  $result = $connection->query("SELECT blanktypeandno FROM assignblank a INNER JOIN systemuser b ON b.id = a.staffid AND b.username = '".$_SESSION['username2']."'");
                      $result = $connection->query("SELECT blanktypeandno FROM assignblank WHERE staffid = '".$_SESSION['username2']."' GROUP BY blanktypeandno");

                      ?>
                      <select  id="blanktypeandno1" name="blanktypeandno1" required  >
                      <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['blanktypeandno'] . "'>" . $row['blanktypeandno'] . "</option>";
                            
                        }
                        ?>
                      </select>
                      </div>
                      </div>

                        <div class="row">
                        <!-- Customer name dropdown field  -->     
                        <div class="col-25">
                        <label style="font-size:30px;" for="fullname1">Customer Name:</label>
                        </div>
                        <div class="col-75">
                              
                      <?php 
                      //db connection
                      $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                      //  $result = $connection->query("SELECT blanktypeandno FROM assignblank a INNER JOIN systemuser b ON b.id = a.staffid AND b.username = '".$_SESSION['username2']."'");
                      $result = $connection->query("SELECT alias FROM customer");

                      ?>

                      <select  id="fullname1" name="fullname1" required onchange='CheckOther(this.value);'>
                      <?php
                      while ($row = mysqli_fetch_array($result)) {
                          echo "<option value='" . $row['alias'] . "'>" . $row['alias'] . "</option>";
                          
                      }

                      ?>
                  <option value=""></option>

                      </select>
                      
                      
                      <input type="text" name="othername" id="othername" style='display:none;'/>
                  
                      </div></div>

                          <!-- Origin field  -->   
                      <div class="row">
                          <div class="col-25">
                            <label style="font-size: 30px;" for="origin">Origin:</label>
                          </div>
                          <div class="col-75">
                            <input type="text" id="origin" name="origin"  minlength="1" maxlength="25" placeholder="e.g: London" required>
                          </div>
                        </div>
                        <!-- Destination field  -->   
                        <div class="row">
                          <div class="col-25">
                            <label style="font-size: 30px;" for="destination">Destination:</label>
                          </div>
                        

                          <div class="col-75">
                            <input type="text" id="destination" name="destination"  minlength="1" maxlength="25" placeholder="e.g: France" required>
                          </div>
                        </div>
                        <!-- Amount LC  field  -->   
                        <div class="row">
                          <div class="col-25">
                            <label style="font-size: 20px;" for="amount1">Amount (Local Currency) </label>
                          </div>
                          <div class="col-75"  style="float:left; max-width:100px;">
                              
                              <?php 
                      
                          //retreives currency code from currenty table
                              $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                              //  $result = $connection->query("SELECT blanktypeandno FROM assignblank a INNER JOIN systemuser b ON b.id = a.staffid AND b.username = '".$_SESSION['username2']."'");
                              $result = $connection->query("SELECT code from currency");
                      
                              ?>
                      
                              <select  id="currcode" name="currcode" required  >
                              <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['code'] . "'>" . $row['code'] . "</option>";
                                    
                                }
                                ?>
                          
                              </select>
                                
                              </div>
                          <div class="col-75"  style="float:right; max-width:700px;">
                            <input type="text" id="amount12" name="amount1" placeholder="e.g: 500 in Local Currency" required>
                          </div>
                        </div>

                        <div class="row">

                                <!-- amount in USD field -->
                          <div class="col-25">
                            <label style="font-size: 30px;" for="amount1">Amount in USD</label>
                          </div>
                          <div class="col-75"  style="float:left; max-width: 266.666667px;">
                            <input type="text" id="state-list" name="USD" value="1" readonly required> 
                          </div>
                          <div class="col-75"  style="float:left; max-width: 266.666667px;">
                            <input type="text"  name="decimals" placeholder="e.g: 0.54 (USD)"  id="dispc" onkeyup="getDiscount(this.value);">
                          </div>
                          <div class="col-75"   style="float:right; margin-left: 10px; max-width: 266px;">
                            <input type="text" id = "afdis" name="amountUSD" placeholder="Amount in USD" readonly required>
                          </div>
                        </div>

                        <div class="row">
        
                        <!-- tax fields -->
                    <div class="col-25">
                      <label style="font-size: 30px;" for="amount1">Tax</label>
                    </div>
                    <div class="col-75"   >
                      <input type="text" id = "totaltax" name="totaltax" placeholder="Total Tax"  class="form-control" placeholder="0" required onkeyup="getAmount(this.value);" >
                    </div>

                    <div class="col-75"   style="float:right; margin-left: 10px; max-width: 266px;">
                      <input type="hidden" id="totalamount1" name="totalamount1" class="form-control" placeholder="Total Amount" placeholder="0" readonly>
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
                        <!-- cvv field -->
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
                        <!-- paid checkbox field -->
                      <div class="col-25">
                        <label style="font-size: 30px;"  for="datepaid">Paid</label>
                      </div>
                      <div class="col-75">
                        <input type="checkbox" id="datepaid" name="datepaid" value="1">
                      </div>
                    </div>

                        <div class="row">
                        <!-- soldy field -->
                          <div class="col-25">
                            <label style="font-size: 30px;"  for="soldby">Sold By</label>
                          </div>
                          <div class="col-75">
                            <input type="text" id="soldby" name="soldby" value="<?php echo $_SESSION['username2']; ?>" required readonly>
                          </div>
                        </div>

                                <!-- sell ticket submission button -->
                        <div class="row">
                        <input style="margin-top: 10px; " name="sellticketbtn" type="submit" value="Submit">
                        </div>



                </div>
            </div>
        </div>
    </header>
       



</body>
</html>
