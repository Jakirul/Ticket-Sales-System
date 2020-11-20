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
    <title>Assign Blanks</title>
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
                <li><a href="blankstock.php">Blank Stock</a></li>
                <li><a href="assignBlank.php" class="present">Assign Blank</a></li>
                <li><a href="assignedBlanks.php">Assigned Blank</a></li>
                <li><a href="usedblanks.php">Used Blanks</a></li>
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
            <div class="form-wrap" style="max-width: 100rem;text-align: center;">
            <!-- Assign Blank Title  -->   
            <h1 style="font-size: 40px;">Assign Blank</h1>  <br><hr> 
            <form method="post" action="../code.php" >
                <div class="center" style="display: block; margin: 100px auto; margin-top: 30px;">
                    <label for="blanktype">Blank Type and No:</label>  
                        <?php 
                        //db connection
                        $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                        //selects the blank type and number together and puts it under a column called blanktype
                        $result = $connection->query("SELECT CONCAT(blanktype, blankno) AS blanktype FROM blankstock");
                        ?>
                        <!-- selects the blank types  -->   
                        <select  style="width: 350px" id="blanktype" name="blanktypeandno" required>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option  value='" . $row['blanktype'] . "'>" . $row['blanktype'] . "</option>";  
                        }
                        ?>
                        </select>
                        </div>
                        <!-- selects a list of office managers  -->   
                        <div class="center" style="display: block; margin: 0 auto; margin-top: -30px;">
                            <label for="omid" >OM ID:</label>
                        <?php 
                        //db connection
                        $connection = mysqli_connect("localhost","root","","ats") or die ('Cannot connect to db');
                        //selects all usernames where the user type is office manager
                        $result = $connection->query("SELECT username FROM systemuser WHERE usertype='OFFICE_MANAGER'");?>

                        <select  id="blanktype" name="omid" required>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                        }
                        ?>
                        </select>
                        </div>
                        <div class="form-group"  >
                            <!-- assign blank submission button -->   
                            <button onclick="location.href=''" type="submit" id="submit" style="display: block; margin: 15px auto; margin-bottom: 15px;"   name="adminassignBlankbtn">Submit</button>
                            <!-- Bulk Option button -->   
                            <button onclick="location.href=''" type="submit" id="submit" style="display: block; margin: 0 auto;" name="adminassignBlankbtn2">Bulk Assign Blanks</button>
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
