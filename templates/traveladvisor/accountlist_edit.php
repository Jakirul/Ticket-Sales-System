<?php
//security2.php contains the security feature where you can't visit any pages without logging in. 
include('../security2.php'); ?>

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
                <li><a href="createcustomeraccount.php">Create Customer Account</a></li>
                <li><a href="accountlist.php" class="present">Customer Details</a></li>
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
            <div id="container" style="max-width: 60%; max-height: 90%">
            <div class="form-wrap">
                <!-- Account List Edit title -->
                <h6>Account List Edit</h6>

        <?php
            //db connection
            $connection = mysqli_connect("localhost","root","","ats");
        //edit ta button
        if(isset($_POST['edit_btn_ta'])) 
        {
            $id = $_POST['edit_id_ta'];
            
            $query = "SELECT * FROM customer WHERE id='$id' ";
            $query_run = mysqli_query($connection, $query);

            foreach($query_run as $row) 
            {
                ?>


        <form action="../code.php" method="POST">
        <!-- Hidden ID field -->
        <input type="hidden" name="edit_id_ta" value="<?php echo $row['id'] ?>">
          
            <!-- prefix field -->
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Prefix</label>
                <input type="text" name="edit_prefix" value="<?php echo $row['prefix'] ?>" placeholder="e.g: Mr"/>
            </div>
            <!-- full name field -->
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Full Name</label>
                <input type="text" name="edit_fullname" value="<?php echo $row['fullname'] ?>" placeholder="John Smith"/>
            </div>
            <!-- alias field -->
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Alias</label>
                <input type="text" name="alias" value="<?php echo $row['alias'] ?>" placeholder="JohnB"/>
            </div>
            <!-- email field -->
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Email</label>
                <input type="text" name="edit_email" value="<?php echo $row['email'] ?>" placeholder="johnsmith@gmail.com"/>
            </div>
            <!-- address field -->
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Address</label>
                <input type="text" name="edit_address" value="<?php echo $row['address1'] ?>" placeholder="Test Street"/>
            </div>
            <!-- phone number field -->
            <div class="form-group" >
                <label for="user" style="text-align: center; font-size: 40px;">Phone Number</label>
                <input type="text" name="edit_phoneno" value="<?php echo $row['phoneno'] ?>" placeholder="07976576587"/>
            </div>
            <!-- hidden type field -->
            <div class="form-group" >
                <input type="hidden" name="edit_type" value="<?php echo $row['type'] ?>" />
            </div>

            <!-- update button-->
            <button name="updatebtn_ta">Update </button>
            <!-- cancel button-->
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