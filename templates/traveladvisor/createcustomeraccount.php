<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php');
?>
<!DOCTYPE html>
<php lang="en">
<head>
  <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- title --> 
    <title>Create Customer Account</title>
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
                <li><a href="createcustomeraccount.php" class="present">Create Customer Account</a></li>
                <li><a href="accountlist.php">Customer Details</a></li>
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
                    <div class="container">
                      <form action="../code.php" method="POST" >

                            <div class="row">
                            <!-- Prefix dropdown field-->
                                <div class="col-25">
                                  <label style="font-size: 30px; color: #333;" for="prefix">Prefix</label>
                                </div>
                                <div class="col-75">
                                  <select id="prefix" name="prefix" required>
                                      <option value="" disabled selected>Prefix</option>
                                      <option value="Sir">Sir</option>
                                      <option value="Mr">Mr</option>
                                      <option value="Mrs">Mrs</option>
                                      <option value="Ms">Ms</option>
                                      <option value="Dr">Dr</option>
                                  </select>
                                </div>
                              </div>

                          <div class="row">
                            <div class="col-25">
                            <!-- first name field-->
                              <label style="font-size: 30px; color: #333;" for="fullname">First Name</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="fullname" name="fullname" placeholder="e.g: John Smith" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-25">
                            <!-- alias field-->
                              <label style="font-size: 30px; color: #333;" for="alias">Alias</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="alias" name="alias" placeholder="e.g: JohnS" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-25">
                            <!-- email field-->
                              <label style="font-size: 30px; color: #333;" for="email">Email</label>
                            </div>
                            <div class="col-75-email">
                              <input type="text" id="email" name="email" placeholder="e.g: john.smith@hotmail.com" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-25">
                            <!-- address field-->
                              <label style="font-size: 30px; color: #333;" for="address1">Address</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="address1" name="address1" placeholder="59 Address Road EC2A 3DS" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-25">
                            <!-- phone number field-->
                              <label style="font-size: 30px; color: #333;" for="address">Phone Number: </label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="phoneno" name="phoneno" placeholder="e.g: 07832423482" required>
                            </div>
                          </div>
                          
                          <div class="row">
                          <!-- submit button -->
                            <input style="margin-top: 10px; " name="registercustbtn" type="submit" value="Submit">
                          </div>

                        </form>
                      </div>
                    
                </div>
            </div>
        </div>
    </header>

</body>











</html>
