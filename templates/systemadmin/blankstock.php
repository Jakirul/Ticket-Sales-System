<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
     <!-- title -->    
    <title>Blank Stock</title>

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
                <li><a href="blankstock.php" class="present">Blank Stock</a></li>
                <li><a href="assignBlank.php">Assign Blank</a></li>
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
                    <div id="myModal" class="modal">
                        <!-- Modal content for dropdown list-->
                        <div class="modal-content" style="margin-top:18em; width: 60rem">
                        <span class="close">&times;</span>
                         <!-- New Stock Title -->
                        <p style="text-align: center;">New Stock</p><br>
                        <form method="post" action="../code.php" style="text-align: left;">
                            <!-- Date field -->
                            <label for="date" style="text-align: center; font-size: 40px; color: #333;">Date</label>
                            <input type="date"  name="date1" value="<?php echo $row['date1'] ?>"/> <br>
                            <!-- Blank Type Drop down field -->
                            <label for="blanktype" style="text-align: center; font-size: 40px; color: #333;">Blank Type:</label>
                                <select  id="blanktype" name="blanktype" required >
                                    <option disabled selected value="">Blank Type</option>
                                    <option value="440">440</option>
                                    <option value="444">444</option>
                                    <option value="420">420</option>
                                    <option value="201">201</option>
                                    <option value="101">101</option>
                                </select>
                            
                        <br>
                            <!-- Range 1 field -->
                            <label id="blanknolabel" for="blankno" style="text-align: center; font-size: 40px; color: #333;">Range 1:</label> 
                            <input  style="height: 50px; width: 500px;"  type="text"   name="range1" id="range1" placeholder="e.g: 1">
                            <!-- Range 2 field -->
                            <label id="blanknolabel" for="blankno"style="text-align: center; font-size: 40px; color: #333;">Range 2:</label> 
                            <input  style="height: 50px; width: 500px;"  type="text"   name="range2" id="range2" placeholder="e.g: 100">

                            <!-- Submission button for bulk addition-->
                            <button onclick="location.href='#'" type="submit" id="submit"  name="adminassignBlankstockbtn2">Submit</button>
                    </form>
                    </div>
                </div>

                <div id="myModal2" class="modal2">
                        <!-- Modal content for pop up box -->
                        <div class="modal-content2" style="margin-top:18em; width: 60rem">
                        <!-- close button -->
                        <span class="close2">&times;</span>
                        <!-- new stock button -->
                        <p style="text-align: center;">New Stock</p><br>
                        
                <form method="post" action="../code.php" style="text-align: left;">
                    <!-- date field -->
                    <label for="date" style="text-align: center; font-size: 40px; color: #333;">Date</label>
                    <input type="date"  name="date1" value="<?php echo $row['date1'] ?>"/> <br>
                    <!-- blank type drop down field -->
                    <label for="blanktype" style="text-align: center; font-size: 40px; color: #333;">Blank Type:</label>
                    <select  id="blanktype" name="blanktype" required >
                        <option disabled selected value="">Blank Type</option>
                        <option value="440">440</option>
                        <option value="444">444</option>
                        <option value="420">420</option>
                        <option value="201">201</option>
                        <option value="101">101</option>
                    </select>
                    <br>
                    <!-- Blank number field -->
                    <label id="blanknolabel" for="blankno"style="text-align: center; font-size: 40px; color: #333;">Blank Number:</label> 
                    <input required style="height: 50px; width: 500px;"  type="text" pattern="\d*" minlength="6" maxlength="8" name="blankno" id="blankno" placeholder="e.g: 73625382">
                    <!-- submission button -->
                        <button onclick="location.href='#'" type="submit" id="submit"  name="adminassignBlankstockbtn">Submit</button>
                    </form>
                    </div>
                </div>

                    <div id="container" style="max-width: 90%;">
                    <div class="form-wrap" style="max-width: 100rem;text-align: center;">
                
                
                
                    <?php
                        //db connection
                        $connection = mysqli_connect("localhost","root","","ats");
                        //search feature
                        $search = mysqli_real_escape_string($connection, @$_POST['search']);
                        //this query allows you to search based on the fields in this table
                        $query = "SELECT * FROM blankstock WHERE date1 LIKE '%$search%' OR blanktype LIKE '%$search%' OR blankno LIKE '%$search%'";
                        
                        $query_run = mysqli_query($connection,$query);
                        ?>
                    </table>
                    <!-- blank stock title -->
                    <h1 style="text-align: center; ">Blank Stock</h1>
                    <!-- add bulk blank button -->
                    <button style="width: 10em; float: right; margin-top: -45px;" id="stockbtn">Add Bulk Blanks</button>
                    <!-- add individual blank button -->
                    <button style="width: 12em; margin-top: -45px;" id="stockbtn2">Add Individual Blanks</button>
                    <!-- blank stock history button -->
                    <button style="width: 12em; margin-bottom: 10px; margin-left: 150px;display: inline-block;" id="stockbtn2" onclick="location.href='blankhistory.php'">Blank Stock History</button>
                    
                    <form action="blankstock.php" method="POST">
                    <!-- search button -->
                    <input type="text" name="search" placeholder="Search by Date, Blank Type or Blank Number">
                    <button type="submit" name="submit-search">Search</button>
                    </form>
                    <!-- table -->
                    <table style="margin-top: 20px" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        
                            <?php
                        if(mysqli_num_rows($query_run) > 0) {
                            ?>
                        <thead>
                            <tr>
                                <th style="border: 1px solid black; ">Date</th>
                                <th style="border: 1px solid black; ">Blank Type</th>
                                <th style="border: 1px solid black;">Blank Number</th>
                                <th style="border: 1px solid black;">Edit</th>
                                <th style="border: 1px solid black;">Delete</th>
                            </tr>
                        </thead> 
                            <?php
                            while($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                            
                            <tbody>
                            <tr>
                            <!-- Retreives data from the table and puts it inside the row -->
                                <td style="border: 1px solid black; text-align: center;  "><?php echo $row['date1'] ?> </td>
                                <td style="border: 1px solid black; text-align: center;  "><?php echo $row['blanktype'] ?> </td>
                                <td style="border: 1px solid black;"><?php echo $row['blankno'] ?> </td>
                        

                                <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                                <form action="stock_edit.php" method="post">
                                    <input type="hidden" name="edit_id_blank_stock" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="edit_btn_blank_stock">EDIT</button>
                                </form>  
                                </td>
                                <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                                    <form action="../code.php" method="post">
                                    <input type="hidden" name="delete_id_blank_stock" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_btn_blank_stock">DELETE</button>
                                        
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
   
       
       




        
        

      

      <script>
            // Get the modal
            var modal = document.getElementById("myModal");


            // Get the button that opens the modal
            var btn = document.getElementById("stockbtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];


            // When the user clicks the button, open the modal
            btn.onclick = function() {
              modal.style.display = "block";
            }


            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
              modal.style.display = "none";
            }



            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                modal.style.display = "none";
            }
            }
        // Get the modal
        var modal2 = document.getElementById("myModal2");


        // Get the button that opens the modal
        var btn2 = document.getElementById("stockbtn2");

        // Get the <span> element that closes the modal
        var span2 = document.getElementsByClassName("close2")[0];


        // When the user clicks the button, open the modal
        btn2.onclick = function() {
        modal2.style.display = "block";
        }


        // When the user clicks on <span> (x), close the modal
        span2.onclick = function() {
        modal2.style.display = "none";
        }


        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal2) {
            modal2.style.display = "none";

        }
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }

    </script>
</body>

</html>
