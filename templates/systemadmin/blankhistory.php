<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?>   
    <!-- title -->    
    <title>Blank Stock History</title>

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
                    <div style="max-width: 90%;">
                    <div class="form-wrap" style="max-width: 100rem;text-align: center; height:800px; overflow: auto">
                   
                    <?php
                        //db connection
                        $connection = mysqli_connect("localhost","root","","ats");
                        //search feature
                        $search = mysqli_real_escape_string($connection, @$_POST['search']);
                        //sql query to search based on this table
                        $query = "SELECT * FROM blankstockhistory WHERE date1 LIKE '%$search%' OR blanktype LIKE '%$search%' OR blankno LIKE '%$search%'";
                        $query_run = mysqli_query($connection,$query);
                        ?>
                    </table>
                    <!-- Blank Stock History Title -->
                    <h1 style="text-align: center; ">Blank Stock History</h1>
                    <!-- Back button -->
                    <button onclick="location.href='blankstock.php'"  style="float: right; margin-top: -5px; margin-bottom: 5px; width: 50px; border-radius: 6px;">Back</button>
                    <form action="blankhistory.php" method="POST">
                    <!-- Search button -->
                    <input type="text" name="search" placeholder="Search by Date, Blank Type or Blank Number">
                    <button   type="submit" name="submit-search">Search</button>
                    </form>
                        <?php
                        if(mysqli_num_rows($query_run) > 0) { ?>
                        <!-- table -->
                <table style="margin-top: 20px; " class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="border: 1px solid black;  padding: 10px 10px 10px 10px ">Date</th>
                                <th style="border: 1px solid black;  padding: 10px 10px 10px 10px">Blank Type</th>
                                <th style="border: 1px solid black;  padding: 10px 10px 10px 10px">Blank Number</th>
                                <th style="border: 1px solid black;  padding: 10px 10px 10px 10px">Delete</th>
                            </tr>
                            </thead>
                        <?php
                            while($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                
                            <tbody>
                            <tr>
                            <!-- Retreives data from the table and puts it inside the row -->
                                <td style="border: 1px solid black; text-align: center;  padding: 10px 10px 10px 10px "><?php echo $row['date1'] ?> </td>
                                <td style="border: 1px solid black; text-align: center; padding: 10px 10px 10px 10px  "><?php echo $row['blanktype'] ?> </td>
                                <td style="border: 1px solid black;  padding: 10px 10px 10px 10px"><?php echo $row['blankno'] ?> </td>
                          
                              
                                <td style="border: 1px solid black;  padding: 0 10px 10px 10px">
                                    <form action="../code.php" method="post">
                                    <input type="hidden" name="delete_id_blank_stock_history" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_btn_blank_stock_history">DELETE</button>
                                        
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
