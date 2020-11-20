<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php');
?>

<!DOCTYPE html>
<php lang="en" >
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- title -->
    <title>Account List</title>
</head>
<body style=" background: #344a72; ">

<!-- Navigation -->
<nav id="main-nav">
<div class="contain" style="padding: 2.4rem;">
            
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


<?php   //this is the code that gives a message saying "account list edit successful once its been edited
            if(isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 style="text-align: center; color: white"> '.$_SESSION['success'].' </h2>';
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 "> '.$_SESSION['status'].' </h2>';
                unset($_SESSION['status']);
            }


        ?>


    <header id="showcase">
        <div class="contain">
            <div class="showcase-contain">
                <div class="showcase-content">
                    <div id="container" style="max-width: 100%;">
                        <div class="form-wrap" >
                            <!-- Account List title -->
                            <h1 style="padding-bottom: 15px;">Account List</h1>
                            <?php
                            //db connection
                            $connection = mysqli_connect("localhost","root","","ats");
                            //selects everything from system user table
                            $query = "SELECT * FROM systemuser";
                            $query_run = mysqli_query($connection,$query);
                            ?>
                            <!-- table -->
                            <table class="table table-bordered"id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th style="border: 1px solid black; ">ID</th>
                                    <th style="border: 1px solid black;">Username</th>
                                    <th style="border: 1px solid black;">Email</th>
                                    <th style="border: 1px solid black;">Password</th>
                                    <th style="border: 1px solid black;">User Role</th>
                                    <th style="border: 1px solid black;">Edit</th>
                                    <th style="border: 1px solid black;">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                            if(mysqli_num_rows($query_run) > 0) {
                                while($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                <tr>
                                <!-- selects each data as a row from the database -->
                                    <td style="border: 1px solid black; text-align: center;  "><?php echo $row['id'] ?> </td>
                                    <td style="border: 1px solid black;"><?php echo $row['username'] ?> </td>
                                    <td style="border: 1px solid black;"><?php echo $row['email'] ?> </td>
                                    <td style="border: 1px solid black;"><?php echo $row['password1'] ?> </td>
                                    <td style="border: 1px solid black;"><?php echo $row['usertype'] ?> </td>
                                    <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                                      <form action="accountlist_edit.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="edit_btn">EDIT</button>
                                      </form>  
                                    </td>
                                    <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                                        <form action="../code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_btn">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                }}
                                else {
                                    echo "No record found";
                    
                                }
                        ?>
                            </table>
                    
                            
                            
                            
                            </div>
                            
                    </div>


                </div>
            </div>
        </div>
    </header>
</body>


</html>
