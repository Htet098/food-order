<?php 
//include the constant file
include('../config/constant.php');
// echo"Delete page";

//check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //Get the value and delete
    //echo "Delete";
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //remove physical image file is available
    if($image_name!="")
    {
        //Image is available .So remove it
        $path="../image/category/".$image_name;
        //remove the image
        $remove=unlink($path);
        //if fail to remove image then add an error message and stop the process
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove']="<div class='error'>Failed To Remove Category Image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'Admin/manage-category.php');
            //stop the process
            die();
        }
    }
    
    //delete data from database
    //sql query to delete from database
    $sql="DELETE FROM tbl_category WHERE id=$id";
    //Execute the query
    $res=mysqli_query($conn,$sql);
    //check whether the data is delete from database or not
    if($res==true)
    {
        //set success message and redirect
        $_SESSION['delete']="<div class='success'>Category Delete Successfully.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'Admin/manage-category.php');
    }
    else
    {
        //sat fail message and redirect
        $_SESSION['delete']="<div class='error'>Failed to delete category.</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'Admin/manage-category.php');
    }

    //redirect to manage admin page with message
}
else
{
    //redirect to manage category page
    header('location:'.SITEURL.'Admin/manage-category.php');
}

?>