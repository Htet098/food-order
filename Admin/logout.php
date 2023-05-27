<?php 
//1.include constant.php for SITEURL
include('../config/constant.php');

//2/ destroy the session
session_destroy();//unset($_SESSION['user'])

//3.redirect to login page
header('location:'.SITEURL.'Admin/login.php');


?>