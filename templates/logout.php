<?php 
//starts the php session
session_start();

//logout button
if(isset($_POST['logout_btn'])) {
    //destroys the session
    session_destroy();
    unset($_SESSION['username']);
    header('Location: index.php');
}
?>
