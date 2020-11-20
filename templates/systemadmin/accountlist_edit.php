<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php');
?>

<!DOCTYPE html>
<head>
  <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
     <!-- title -->  
    <title>Account List Edit</title>
</head>
<body style=" background: #344a72; ">
<!-- Navigation -->
<nav id="main-nav">
<div class="contain" style="padding: 1.8rem;">
            
            <a href="home.php">
                 <!-- This is the logo that appears on the top left -->
                    <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <ul>
                <!-- Navigation bar -->
                <li><a href="accountlist.php" class="present">Account List</a></li>
                <li><a href="register.php">Create User Account</a></li>
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
                    <div id="container" style="max-width: 90%;">
                        <div class="form-wrap" >
                <h6>Account List Edit</h6>

            <?php
                //db connection
                $connection = mysqli_connect("localhost","root","","ats");
                //edit button code
                if(isset($_POST['edit_btn'])) {
                $id = $_POST['edit_id'];
                //sql query for selecting everything from system admin if id matches
                $query = "SELECT * FROM systemuser WHERE id='$id' ";
                $query_run = mysqli_query($connection, $query);
                foreach($query_run as $row) 
                {
                    ?>


            <form action="../code.php" method="POST">
            <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
            
            <!-- username edit field  -->        
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Username</label>
                <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" placeholder="user"/>
            </div>
             <!-- email edit field  -->     
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Email</label>
                <input type="text" name="edit_email" value="<?php echo $row['email'] ?>" placeholder="user"/>
            </div>
              <!-- password edit field  -->                
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Password</label>
                <input type="password" name="edit_password" value="<?php echo $row['password1'] ?>" placeholder="user"/>
            </div>
             <!-- user role edit field  -->                 
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">User Role</label>
                <input type="text" name="edit_usertype" value="<?php echo $row['usertype'] ?>" placeholder="user"/>
            </div>

              <!-- update button -->            
            <button name="updatebtn">Update </button>
             <!-- cancel button  -->     
            <button type="button" name="cancel" value="cancel" onClick="window.location='accountlist.php';">Cancel</button>

            
        </form>
            <?php
    }
}
?>
</div>
</div>
</div>
</div>
</div>
</header>


</body>







</html>