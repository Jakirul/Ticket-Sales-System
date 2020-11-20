<?php
//starts php session
session_start();

//includes this php file
include('dbconfig.php');


if (!$dbconfig) {
    header("Location: dbconfig.php");
}

//if you go to a TA page and you're not logged in, it goes to the TA login
if(!$_SESSION['username2']) {
    header('Location: ../TALogin.php');
}