<?php 
//starts the php session
session_start();

//logout button
if(isset($_POST['logout_btn2'])) {
    //destroys the session
    session_destroy();
    unset($_SESSION['username2']);
    header('Location: index.php');
}
?>
