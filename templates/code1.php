<?php
include('security1.php');
if(isset($_POST['login_btn1'])) {
   
    $username_login = $_POST['username1'];
    $password_login = md5($_POST['password11']);
    $usertype_login = $_POST['usertype111'];

    $query = "SELECT * FROM systemuser WHERE username='$username_login' AND password1='$password_login' AND usertype = '$usertype_login'";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_fetch_array($query_run)){
        $_SESSION['username1'] = $username_login;
        header('Location: systemadmin/home.php');
    }
    else {
        $_SESSION['status'] = 'Username / Password is invalid';
        header('Location: SALogin.php');
    }
}


//logout
if(isset($_POST['logout_btn1'])) {
    session_destroy();
    unset($_SESSION['username1']);
}







?>