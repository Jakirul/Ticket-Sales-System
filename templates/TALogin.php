<?php 
//starts the PHP session
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <!-- makes it more mobile friendly --> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- imports fontawesome icons --> 
    <script src="https://kit.fontawesome.com/7d81fb84da.js" crossorigin="anonymous"></script>
    <!-- links the html to the css stylesheet --> 
    <link rel="stylesheet" href="../static/css/style.css" />
    <!-- title --> 
    <title>Travel Advisor Login</title>

</head>
<body style=" background: #344a72; ">


<!-- Navigation -->
<nav id="main-nav">
<div class="contain" style="padding: 2.15rem;">
            
            <a href="index.php">
                <!-- logo that appears on the top left --> 
                    <img src="../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>    
        
        <div class="test" style="display: flex;align-items: center;justify-content: center;">
                <ul style="list-style: none;">
                <!-- nav title bar --> 
                    <li style="font-size: 25px;"><strong>Travel Advisor Login</strong></li>
                    
                </ul>
        <form>          
        <!-- back button --> 
        <div class="item" style="padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 5px;right: 10px;">
                <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin: 25px 2px;cursor: pointer;" >
                    <a style="color: white;" href="index.php">Back</a>
                </button>
            </div>
        </form> 
    </div>
</nav>

<header id="showcase">
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                    <div id="container" >
                        <div class="form-wrap" >
                        <!-- login title --> 
                            <h1 style="text-align: center; font-size: 30px; margin-bottom: 10px">Login</h1><hr style="border: 1px solid slategray; opacity: 0.3">
                    
                            <?php 
                              
                            //This allows a message to appear saying username / password is invalid when you type in
                            //the wrong password
                            if(isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                echo '<h2 class="bg-info"> '.$_SESSION['status'].' </h2>';
                                unset($_SESSION['status']);
                            }
                    
                    
                    
                            ?>
                            <form  class="user" action="code3.php" method="post">
                                <div class="form-group" style="margin-bottom: 15px">
                                <!-- username field --> 
                                    <label style="text-align: center; font-size: 35px; margin-bottom: -15px;" required>Username</label>
                                    <input  style="text-align: center" type="text" id="username" name="username1" >
                                </div>
                                <div class="form-group" style="margin-bottom: 15px">
                                <!-- password field --> 
                                    <label style="text-align: center; font-size: 35px; margin-bottom: -15px;" required>Password</label>
                                    <input style="text-align: center" type="password" id="password1" name="password11" >
                                </div>
                                <div class="form-group" style="margin-bottom: 15px">
                                    <input style="text-align: center" type="hidden" value="TRAVEL_ADVISOR" id="usertype" name="usertype111" readonly>
                                </div>
                    
                                <div>
                                <!-- login button --> 
                                    <button type="submit" name="login_btn2">Log in</button>
                                </div>
                            </form>
                    
                        </div>
                    </div>


            </div>
        </div>
    </div>
</header>




</body>
</html>

