<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php'); ?>

<!DOCTYPE html>
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- title -->  
    <title>Assigned Blank Edit</title>
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
                <li><a href="blankstock.php">Blank Stock</a></li>
                <li><a href="assignBlank.php">Assign Blank</a></li>
                <li><a href="assignedBlanks.php" class="present">Assigned Blank</a></li>
                <li><a href="usedblanks.php">Used Blanks</a></li>
            </ul>
            <!-- log out button  -->  
            <form action="../logout1.php" method="POST">                 
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
                <div id="container" style="max-width: 60%; max-height: 90%">
                <div class="form-wrap">
                <!-- Edit Blank Stock Title  -->   
                <h6>Edit Blank Stock</h6>

            <?php
                //db connection
                $connection = mysqli_connect("localhost","root","","ats");
                //edit blank button
                if(isset($_POST['edit_btn_blank_assignedblanks'])) 
                {
                $id = $_POST['edit_id_blank_assignedblanks'];
                //sql query to select everything from admin assigned blanks
                $query = "SELECT * FROM adminassignedblanks WHERE id='$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach($query_run as $row) 
                {
                    ?>


                <form action="../code.php" method="POST">
                <!-- the hidden ID field -->
                <input type="hidden" name="edit_id_blank_assignedblanks" value="<?php echo $row['id'] ?>">
                    <div class="form-group" >
                    <!-- blank tpye and number field -->
                    <label for="username" style="text-align: center; font-size: 40px; ">Blank Type and Number</label>
                    <input type="text" name="edit_blanktypeandno" value="<?php echo $row['blanktypeandno'] ?>" class="form-control">
                </div>

                <div class="form-group" >
                <!-- office manager user field -->
                    <label for="user" style="text-align: center; font-size: 40px;">OM User</label>
                    <input type="text" name="edit_user" value="<?php echo $row['OMid'] ?>" placeholder="user"/>
                </div>

                    <!-- update button-->
                <button name="updatebtnblankassignedblanks">Update </button>
                <!-- cancel button -->
                <button type="button" name="cancel" value="cancel" onClick="window.location='assignedblanks.php';">Cancel</button>

                
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