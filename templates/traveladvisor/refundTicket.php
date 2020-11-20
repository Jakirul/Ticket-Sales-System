<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>
    <!-- title -->  
    <title>Refund Ticket</title>
    <!-- jquery script -->  
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <!-- google font -->  
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
</head>
<script>
//function to get the amount
function getAmount(val) {
	$.ajax({
	type: "POST",
	url: "get_amount.php",
	data: {id: val}, 
	success: function(data){
		$("#state-list").html(data);
	}
	});
}
//function to get the blank no 
function getAmount2(val) {
	$.ajax({
	type: "POST",
	url: "get_blankno.php",
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
                <!-- Nav Bar -->
                <li><a href="assignedBlanks.php">Assigned Blanks</a></li>
                <li><a href="tickets.php"  >Sell Tickets</a></li>
                <li><a href="soldticket.php" >Sold Tickets</a></li>
                <li><a href="cancelTicket.php">Cancel Ticket</a></li>
                <li><a href="refundTicket.php" class="present">Refund Ticket</a></li>
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
                    <!-- Refund tickets title  -->        
                    <h1 style="text-align: center; margin-top: 20px; font-family: 'Rubik', sans-serif;">Refund Tickets (Already Paid)</h1>
                    <form method="post" action="../code.php">

                    <div class="center" style="display: block; margin: 50px auto;">
                    <!-- customer name dropdown list   -->        
                            <label  for="blanktypeandno" style="font-size: 40px;">Customer Name:</label>
                        
                            <select name="fullname1" id="country-list" class="demoInputBox" required  onChange="getAmount(this.value); ">
                        <option value="">Select Name</option>
                        <?php
                        //takes data from the soldticket table and populates the dropdown list
                        $sql1="SELECT fullname1,othername FROM soldticket WHERE soldby='$_SESSION[username2]' AND datepaid='1' ";
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
                            <!-- the amount drop down list -->        
                        <div class="center" style="display: block; margin: 50px auto;">
                            <label  for="blanktypeandno" style="font-size: 40px;">Amount</label>
                            <select id="state-list" type="text"  name="amount1" required  onChange="getAmount2(this.value);">
                                <option value=""></option>
                            </select>
                        </div>
                            <!-- blank type and no drop down list -->        
                        <div class="center" style="display: block; margin: 50px auto;">
                        <label style="font-size:30px" >Blank Number</label>
                        <select id="blankno" type="text" name="blanktypeandno1" >
                            <option value=""></option>
                        </select>
                     </div> 
                            <!-- Hidden usernames -->    
                        <div class="center" style="display: block; margin: 50px auto;">
                            <input type="hidden" name="refundedby"  value="<?php echo $_SESSION['username2']; ?>" >
                        </div>
                        
                         <!-- Submission button -->    
                        <button onclick="location.href='#'" style="display: block; margin: auto; margin-bottom: 15px;"  type="submit" id="submit1" name="refundTicket">Submit</button> 
                        
                    </form>
                     <!-- Refunded tickets -->    
                    <button onclick="location.href='refundedticket.php'" style="display: block; margin: auto; margin-bottom: 15px;"  type="submit" id="submit1" name="refundedtickets">Refunded Ticket</button> 

                </div>
            </div>
        </div>
    </header>





    
</body>
</html>
