<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php');
?>
<!DOCTYPE html>
<php lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
     <!-- title -->
    <title>Home Page - System Admin</title>
</head>
<body style=" background: #344a72; ">

    <!-- Navbar -->
    <nav id="main-nav">
    <div class="contain" style="padding: 2.15rem;">
            
            <a href="home.php">
                <!-- This is the logo that appears on the top left -->
                <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <div class="test" style="display: flex;align-items: center;justify-content: center;">
                <ul style="list-style: none;">
                <!-- Navigation bar -->
                <li style="font-size: 25px;">Welcome <strong><?php echo $_SESSION['username1'] ?>!</strong></li>
            </ul>
            </div>
            <form action="../logout2.php" method="POST">  
             <!-- log out button  -->                
            <div class="item" style="padding: 15px 32px; text-align: center; border-radius: 5px; display: inline-block; position: absolute;top: 5px;right: 10px;">
                    <button style="background-color: #008CBA;border: none;color: white;padding: 10px 15px;text-align: center;border-radius: 5px;display: inline-block;font-size: 15px;margin:25px 2px;cursor: pointer;" 
                    type="submit" class="logoutbtn" name="logout_btn2">Log Out</button>
                    </div>
            </form> 
        </div>
    </nav>
    <!-- showcase header -->
    <header id="showcase">
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                    <h1 class="text-center">Blanks</h1>
                    <div class="blanks">
                        <a href="blankStock.php">
                            <div class="box1">Blank Stock</div>
                        </a>
                        <a href="assignBlank.php">
                            <div class="box1">Assign Blank</div>
                        </a>
                        <a href="assignedBlanks.php">
                            <div class="box1">Assigned Blank</div>
                        </a>
                        <a href="usedblanks.php">
                            <div class="box1">Used Blanks</div>
                        </a>
                    </div>
                    <h1 class="text-center">Account Management</h1>
                    <div class="blanks">
                        <a href="accountlist.php">
                            <div class="box1">Account List</div>
                        </a>
                        <a href="register.php">
                            <div class="box1">Create User Account</div>
                        </a>
                    </div>
                    <h1 class="text-center">Reports</h1>
                    <div class="blanks">
                        
                        <a href="stockturnoverreport.php">
                            <div class="box1">Stock Turnover Report</div>
                        </a>
                    </div>
                    <h1 class="text-center">Database</h1>
                    <div class="blanks">
                        <a href="database.php">
                            <div class="box1">Database Management</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
