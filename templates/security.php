<?php
//starts php session
session_start();

//includes this php file
include('dbconfig.php');


if (!$dbconfig) {
    header("Location: dbconfig.php");
}

//if you go to a OM page and you're not logged in, it goes to the OM login
if(!$_SESSION['username']) {
    header('Location: ../OMLogin.php');
}

