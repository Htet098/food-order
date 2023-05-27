<?php include('../config/constant.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - food order system</title>
    <link rel="stylesheet" href="../CSS/admin1.css">
</head>
<body>
  <div class="container">
    <div class="login">
        <h1 class="text-center">Log In</h1>
        <br>
        <?php

        if(isset($_SESSION['login']))
        {
          echo $_SESSION['login'];//display session message
          unset($_SESSION['login']);//remove session message
        }
        if(isset($_SESSION['no-login-message']))
        {
          echo $_SESSION['no-login-message'];//display session message
          unset($_SESSION['no-login-message']);//remove session message
        }

        ?><br>
        <!-- login form start -->
          <form action="" method="POST" class="text-center" >
            <div class="form-label">Username:</div>  
            <input type="text" name="username"class="form-control" placeholder="Enter Username"> <br><br>
           <div class="form-label">Password:</div>   
            <input type="password" name="password"class="form-control" id="" placeholder="Enter Password"> <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary btn"> <br><br>


          </form>
        <!-- login form start -->

        <p class="text-center">Create by -<a href="#">HT Ri</a></p>
    </div>
  </div>
</body>
</html>
<?php 
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
  //1.get data from form
  //$username=$_POST['username'];
  //$password=md5($_POST['password']);
  $username= mysqli_real_escape_string($conn,$_POST['username']);
  $raw_password=md5($_POST['password']);
  $password=mysqli_real_escape_string($conn,$raw_password);

  //2.query to check whether the user with username and password exists or not
  $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
  $res=mysqli_query($conn,$sql);

  //3.Count row to check whether the user is exists or not
  $count=mysqli_num_rows($res);

  if($count==1){
    //user available and login success
    $_SESSION['login']="<div class='success'>Login Successful.</div>";
    $_SESSION['user']=$username; // to check whether the user is logged in or logout will unset it

    //redirect to admin dashboard
    header('location:'.SITEURL.'Admin/');

  }else{

    //user not available and login fail
    $_SESSION['login']="<div class='error text-center'>User and Password Did Not Match.</div>";
    
    //redirect to admin dashboard
    header('location:'.SITEURL.'Admin/login.php');
    
  }
}



?>