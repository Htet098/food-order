<?php
//Include constant php 
include('../config/constant.php');
// echo" Delete page";
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //process to delete 
    // echo " Process to delete";
    //1.Get id and image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    //2.Remove the image if available
    //check whether the image is available or not and delete only if available
    if($image_name!="")
    {
        //It have image and need to remove from folder
        //Get the image path
        $path="../image/food".$image_name;

        //remove image from folder
        $remove=unlink($path);

        //check whether the image is removed or not
        if($remove==false)
        {
            //fail to remove image
            $_SESSION['upload']="<div class='error'>Fail To Remove Image File.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'Admin/manage-food.php');
            //stop the process of deleting image
            die();
        }
    }
    //3.Delete from form database
    $sql="DELETE FROM tbl_food WHERE id=$id";

    //EXECUTE THE QUERY
    $res=mysqli_query($conn,$sql);

    ///CHECK WHETHER THE QUERY EXECUTE OR NOT AND SET THE SESSION MESSAGE RESPECTIVELY
    //4.Redirect to manage food with message
    if($res==true)
    {
        //Food delete
        $_SESSION['delete']= "<div class='success'>Food Delete Successfully.</div>";
        header('location:'.SITEURL.'Admin/manage-food.php');
    }
    else
    {
        //failed to delete
        $_SESSION['delete']= "<div class='error'>Fail To Delete Food.</div>";
        header('location:'.SITEURL.'Admin/manage-food.php');
    }
    
}
else
{
    //Redirect to manage food page
    // echo "Redirect ";
    $_SESSION['unauthorize']= "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'Admin/manage-food.php');
}

?>