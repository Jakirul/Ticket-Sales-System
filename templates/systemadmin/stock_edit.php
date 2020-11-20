<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php');
?>

<!DOCTYPE html>
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- title -->
    <title>Stock Edit</title>
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
                <li><a href="accessreport.php">Access Report</a></li>
                <li><a href="generatereport.php" class="present">Generate Report</a></li>
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
    <div class="showcase-contain">
    <div class="showcase-content">
    <div id="container" style="max-width: 60%; max-height: 90%">
    <div class="form-wrap">
        <!-- Edit Blank Stock Title -->
        <h6>Edit Blank Stock</h6>
        <?php
            //db connection
            $connection = mysqli_connect("localhost","root","","ats");
        //edit blank stock button
        if(isset($_POST['edit_btn_blank_stock'])) 
        {
            $id = $_POST['edit_id_blank_stock'];
            
            $query = "SELECT * FROM blankstock WHERE id='$id' ";
            $query_run = mysqli_query($connection, $query);

            foreach($query_run as $row) 
            {
                ?>


        <form action="../code.php" method="POST">
        <!-- Hidden id field -->
        <input type="hidden" name="edit_id_blank_stock" value="<?php echo $row['id'] ?>">

        <div class="form-group" >
                <!--  date field -->
                <label for="date" style="text-align: center; font-size: 40px;">Date</label>
                <input type="date"  name="edit_date_blank_stock" value="<?php echo $row['date1'] ?>"/>
            </div>
            <div class="form-group">
                 <!--  blank type dropdown field -->
                <label for="username" style="text-align: center; font-size: 40px; ">Blank Type</label>
                
                <select  id="blanktype" name="edit_blanktype" value="<?php echo $row['blanktype'] ?>" >
                    <option disabled selected value="">Blank Types</option>
                    <option value="440">440</option>
                    <option value="444">444</option>
                    <option value="420">420</option>
                    <option value="201">201</option>
                    <option value="101">101</option>
                </select>
                
            </div>

            <div class="form-group" >
                 <!--  blank number field -->
                <label for="email" style="text-align: center; font-size: 40px;">Blank Number</label>
                <input type="text" pattern="\d*" minlength="6" maxlength="8" name="edit_blankno" value="<?php echo $row['blankno'] ?>" placeholder="e.g: 73625382"/>
            </div>

            <!--  update button -->
            <button name="updatebtnblankstock">Update </button>
                <!--  cancel button -->
             <form name="form" method="post" action="blankstock.php">
                <button type="button" name="cancel" value="cancel" onClick="window.location='blankstock.php';">Cancel</button>
            </form>
        </form>
            <?php
    }
}
?>
</div>
</div>
</div>
</div>
</header>


</body>







</html>