<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>
     <!-- Google font  --> 
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
     <!-- title --> 
    <title>Cancel Ticket</title>
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
                <li><a href="assignedBlanks.php">Assigned Blanks</a></li>
                <li><a href="tickets.php"  >Sell Tickets</a></li>
                <li><a href="soldticket.php" >Sold Tickets</a></li>
                <li><a href="cancelTicket.php"class="present">Cancel Ticket</a></li>
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
                <!-- Pop up box -->
                    <div id="myModal" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content" style=" width: 60rem; ">
                        <span class="close">&times;</span>
                        <!-- Mass Cancel Title -->
                        <p style="text-align: center;">Mass Cancel</p>
                        <form method="post" action="../code.php" style="text-align: left; color:#333;">
                            <!-- Range 1 dropdown field -->
                            <label id="blanknolabel" for="range1">Range 1:</label> 
                            <?php 
                                //db connection
                                $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                                //selects the id from soldticket where the soldby is equal to the person logged in and it isnt paid
                                $result = $connection->query("SELECT id from soldticket WHERE soldby='$_SESSION[username2]' AND datepaid = '0'");?>

                                <select  id="blanktypeandno" name="range1" required>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['id'] . "</option>";
                                    } ?>
                                </select>
                             <!-- Range 2 dropdown field -->       
                            <label id="blanknolabel" for="blankno">Range 2:</label> 
                                <?php 
                                    //db connection
                                    $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                                   //selects the id from soldticket where the soldby is equal to the person logged in and it isnt paid
                                    $result = $connection->query("SELECT id from soldticket WHERE soldby='$_SESSION[username2]' AND datepaid = '0'");?>

                                    <select  id="blanktypeandno" name="range2" required>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['id'] . "</option>";   
                                    } ?>
                                    </select>
                             <!-- Cancel ticket button in the bulk menu -->       
                            <button onclick="location.href='#'" type="submit" id="submit" name="cancelTicketBulk">Cancel Ticket</button>


                        </form>
                    </div>
                    </div>
                     <!-- Cancel Ticket title -->                   
                    <h1 style="text-align: center; margin-top: 20px;font-family: 'Rubik', sans-serif;">Cancel Tickets (Not Paid Yet)</h1>
                    <form method="post" action="../code.php">
                        <div class="center" style="display: block; margin: 50px auto;">
                        <!-- ticket id dropdown field-->     
                            <label  for="blanktypeandno" style="font-size: 40px;">Ticket ID</label>

                        <?php 
                    
                    $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                    $result = $connection->query("SELECT id from soldticket WHERE soldby='$_SESSION[username2]' AND datepaid = '0'");?>

                        <select  id="id" name="ticketid" required>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['id'] . "</option>";     
                        }
                        ?>
                        </select>
                        </div>
                        <!-- submit button-->     
                    <button onclick="location.href='#'" style="display: block; margin: auto; margin-bottom: 15px;"  type="submit" id="submit1" name="cancelticket">Submit</button> 
                        
                    </form>
                    <!-- bulk cancel option button-->     
                <button  id="cancelticket" name="cancelticket2" style="display: block; margin: 0 auto;" >Click for Bulk Cancel Option</button>


                </div>
            </div>
        </div>
    </header>





      <script>
            // Get the modal
            var modal = document.getElementById("myModal");


            // Get the button that opens the modal
            var btn = document.getElementById("cancelticket");

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
