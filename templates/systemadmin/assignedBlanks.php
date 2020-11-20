<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php');
?>

<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
<head>
     <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
     <!-- title -->    
    <title>Assigned Blanks</title>
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
                    <div id="container" style="max-width: 100%;">
                    <div class="form-wrap" style="max-width: 100rem;text-align: center; height:800px; overflow: auto">
                    <?php
                        //db connection
                        $connection = mysqli_connect("localhost","root","","ats");
                        //sql query to select everything from adminassignedblanks table
                        $query = "SELECT * FROM `adminassignedblanks` GROUP BY(blanktypeandno) ";
                        $query_run = mysqli_query($connection,$query);
                        ?>
                <?php
                    //db connection
                    $connection = mysqli_connect("localhost","root","","ats");
                    //search feature
                    $search = mysqli_real_escape_string($connection, @$_POST['search']);
                    //selects everything from adminassignedblanks when you use the search feature
                    $query = "SELECT * FROM adminassignedblanks WHERE blanktypeandno LIKE '%$search%' OR OMid LIKE '%$search%' GROUP BY(blanktypeandno)";
                    $query_run = mysqli_query($connection,$query);
                    ?>
                    <!-- Blank Assigned Title -->
                    <h1 style="text-align: center; ">Blanks Assigned</h1>
            
                    <form action="assignedBlanks.php" method="POST">
                    <!-- Search button -->
                    <input type="text" name="search" placeholder="Search by Blanks or OM ID">
                    <button type="submit" name="submit-search">Search</button>
                    </form>
                    <!-- table -->
                    <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           
                            <tbody>
                            <?php
                        if(mysqli_num_rows($query_run) > 0) { ?> 
                         <thead>
                            <tr>
                        
                                <th style="border: 1px solid black; ">Blank Type and Blank No</th>
                                <th style="border: 1px solid black;">OM Username</th>
                                <th style="border: 1px solid black;">Edit</th>
                                <th style="border: 1px solid black;">Delete</th>
                            </tr>
                            </thead>
                        <?php
                            while($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                            
                            <tr>
                            <!-- retreives all information from the adminassignedblanks table into a row  -->
                                <td style="border: 1px solid black; text-align: center;  "><?php echo $row['blanktypeandno'] ?> </td>
                                <td style="border: 1px solid black;"><?php echo $row['OMid'] ?> </td>
                    
                                <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                                <form action="assignedblank_edit.php" method="post">
                                    <input type="hidden" name="edit_id_blank_assignedblanks" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="edit_btn_blank_assignedblanks">EDIT</button>
                                </form>  
                                </td>
                                <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                                    <form action="../code.php" method="post">
                                    <input type="hidden" name="delete_id_blank_blanktypeandno" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_btn_blank_blanktypeandno">DELETE</button>
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
