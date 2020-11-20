<?php
//starts php session
session_start();

//includes this php file
include('dbconfig.php');


if (!$dbconfig) {
    header("Location: dbconfig.php");
}

//if you go to a SA page and you're not logged in, it goes to the SA login
if(!$_SESSION['username1']) {
    header('Location: ../SALogin.php');
}

