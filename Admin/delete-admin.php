<?php 
//Include constant.php file here
include('../config/constant.php');
//1.get the id of admin to be deleted
  $id= $_GET['id'];


//2. create sql query to delete admin
$sql= "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
$res= mysqli_query($conn,$sql);
// check whether the execute successfully and admin deleted
if($res==TRUE){
    // Query execute successfully and admin deleted
    // create session variable to display message
    $_SESSION['delete']="<div class='success'>Delete Admin Successfully</div>";
    //redirect to manage admin page
    header('location:'.SITEURL.'Admin/manage-admin.php');
} else{
    //fail to delete admin
    $_SESSION['delete']="<div class='error'>Fail To Delete Admin .Try Again Later...</div>";
    header('location:'.SITEURL.'Admin/manage-admin.php');
}

//3. redirect to menage admin page with message (success/ error)


?>