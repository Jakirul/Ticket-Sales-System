<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php'); ?>

<!DOCTYPE html>
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
     <!-- title -->
    <title>Registration</title>
</head>
<body style=" background: #344a72; ">


<nav id="main-nav">
<div class="contain" style="padding: 2.4rem;">
            
            <a href="home.php">
                <!-- This is the logo that appears on the top left -->
                <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <ul>
                <!-- Navigation bar -->
                <li><a href="accountlist.php">Account List</a></li>
                <li><a href="register.php" class="present">Create User Account</a></li>
            </ul>
            <form action="../logout1.php" method="POST">   
            <!-- log out button  -->                 
            <div class="item" style="padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 5px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn1">Log Out</button>
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
                        <!-- Registration Title --> 
                            <h1>Registration</h1>
                    
                            <form action="../code.php" method="POST" >
                        
                                <div class="form-group" style="margin-bottom: -20px">
                                    <!-- ID field--> 
                                    <label style="text-align: center; font-size: 40px; ">ID</label>
                                    <input class="form-control" type="text" name="id"  required>
                                </div>
                    
                                <div class="form-group" style="margin-bottom: -20px">
                                     <!-- username field--> 
                                    <label style="text-align: center; font-size: 40px;">Username</label>
                                    <input class="form-control" type="text" name="username"  required>
                                </div>
                    
                    
                                <div class="form-group" style="margin-bottom: -20px">
                                     <!-- email field--> 
                                    <label style="text-align: center; font-size: 40px; ">Email</label>
                                    <input class="form-control" type="email" name="email"  required/>
                                </div>
                                <div class="form-group" >
                                    <!-- password field--> 
                                    <label  style="text-align: center; font-size: 40px;">Password</label>
                                    <input  class="form-control" type="password" name="password1" required />
                                   
                                </div>
                    
                                <div class="form-group" >
                                 <!-- usertype drop down field--> 
                                <label style="text-align: center; font-size: 40px; margin-bottom: -30px;" for="reporttype">User Type:</label>
                                
                                <select style="margin-left: 6.5rem; margin-top: 30px" id="reporttype"  name="usertype" required>
                                    <option disabled selected value="" >User Type</option>
                                    <option value="OFFICE_MANAGER" >OFFICE MANAGER</option>
                                    <option value="TRAVEL_ADVISOR" >TRAVEL ADVISOR</option>
                                    <option value="SYSTEM_ADMIN" >SYSTEM ADMIN</option>
                                </select>
                        </div> 
                                <div class="form-group" >
                                    <!-- registration button  --> 
                                    <input class="form-control"  type="submit" name="registerbtn" value="Register" class="btn"/>
                                </div>
                            </form>
                           
                            
                           
                    
                            
                            
                            
                            </div>
                            
                    </div>
                    
                </div>
            </div>
        </div>
    </header>

        
</div>
</body>
</html>



