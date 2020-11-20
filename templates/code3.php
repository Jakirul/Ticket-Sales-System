<?php
include('security2.php');
if(isset($_POST['login_btn2'])) {
    $username_login = $_POST['username1'];
    $password_login = md5($_POST['password11']);
    $usertype_login = $_POST['usertype111'];

    $query = "SELECT * FROM systemuser WHERE username='$username_login' AND password1='$password_login' AND usertype = '$usertype_login'";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_fetch_array($query_run)){
        $_SESSION['username2'] = $username_login;
        header('Location: traveladvisor/home.php');
    }
    else {
        $_SESSION['status'] = 'Username / Password is invalid';
        header('Location: TALogin.php');
    }
}


//logout
if(isset($_POST['logout_btn2'])) {
    session_destroy();
    unset($_SESSION['username2']);
}






?>