<?php
//security1.php contains the security feature where you can't visit any pages without logging in. 
include('../security1.php'); ?>

<!DOCTYPE html>
<php lang="en" >
<head>
    <!-- header.php is just a few header codes. I added it so i don't have to keep repeating myself in every file. -->
    <?php include('../../partials/header.php') ?> 
    <!-- title -->
    <title>Database</title>
</head>
<body>
<!-- Navigation -->
<nav id="main-nav">
<div class="contain" style="padding: 1.48rem;">
            
            <a href="home.php">
                <!-- This is the logo that appears on the top left -->
                <img src="../../static/img/logo22.png" alt="" style=" position: absolute;top: 20px; left: 15px; max-width:200px">
            </a>
            <div class="test" style="display: flex;align-items: center;justify-content: center;">
            <ul style="list-style: none;">
            <!-- Navigation bar -->
                <li ><a href="database.php" class="present">Database</a></li>
            </ul>
            </div>
           
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
                        <!-- Modal content -->
                        <div class="modal-content" style="margin-top:18em; height: 150px;">
                          <span class="close">&times;</span>
                          <!-- Backup text -->
                          <p style="text-align: center; color: black;">BackUp Database</p><br>
                            <!-- Backup button in the pop up modal -->
                          <form action="backup.php"  method="post">
                            <button style="display: block; margin: auto;"><input style="background-color: #008CBA;" type="submit"  value="Backup" name="btn">
                            
                          </form>
                        </div>
                    
                    </div>
                    
                    <div id="myModal2" class="modal2">
                        <!-- Modal content -->
                        <div class="modal-content2" style="margin-top:18em; height: 150px;">
                        <!-- Close button -->
                          <span2 class="close2">&times;</span2>
                           <!-- Restore database text -->
                          <p style="text-align: center; color: black;" >Restore Database</p><br>
                        <!-- Restore database button in the pop up modal-->
                          <form action="restore.php"  method="post">
                          <button style="display: block; margin: auto; "><input style="background-color: #008CBA;" type="submit" value="Restore" name="btn"></button>
                          </form>
                        </div>
                    </div>
                        <main id="section">
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <a href="#" ><i class="fas fa-sync-alt"></i></a>
                                        </div>
                                        <div class="name">
                                           <!-- Backup button -->
                                            <button  onclick="location.href='#'" type="button" id="backupbutton">Back Up</button>
                    
                         
                                        </div>
                    
                                    </li>
                    
                                    <li>
                                        <div class="icon">
                                            <a href="#"><i class="fas fa-redo"></i></a>
                                        </div>
                                        <div class="name">
                                        <!-- Restore button -->
                                            <button  onclick="location.href='#'" type="button" id="restorebutton">Restore</button>
                                        </div>
                    
                                    </li>
                    
                                </ul>
                            </main>


                </div>
            </div>
        </div>
    </header>




















        <script>
            // Get the modal
            var modal = document.getElementById("myModal");


            // Get the button that opens the modal
            var btn = document.getElementById("backupbutton");

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
            var btn2 = document.getElementById("restorebutton");

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
