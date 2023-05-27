<?php
//Authorization-Access control
//check whether the user is logged in or not
if(!isset($_SESSION['user']))//if user session is not set
{
    //user is not logged in
    //redirect to logged in page with message
    $_SESSION['no-login-message']= "<div class='error text-center'>Please Login To Access Admin Panel</div>";
    //redirect to logged in page
    header('location:'.SITEURL.'Admin/login.php');

}


?>