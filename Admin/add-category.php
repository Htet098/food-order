<?php  include("partials/menu.php")?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>
        <!-- add category form start -->
        <form action="" method="POST" enctype='multipart/form-data'>
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td> 
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!-- add category form end -->
        <?php 
        //check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "click";
            //1/Get the value from category form
            $title=$_POST['title'];

            //For radio input,we need to check whether the button is clicked or not
            if(isset($_POST['featured']))
            {
                //Get the value from form
                $featured=$_POST['featured'];
            }else{
                //set default value
                $featured="No";
            }

            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }else{
                $active="No";
            }
            
            //check whether the image is selected or not and set the value for image name accordingly
            // print_r($_FILES['image']);
            //die();
             if(isset($_FILES['image']['name']))
             {
                 //upload the image
                 //to upload the image we need img name ,source path and destination path
                 $image_name=$_FILES['image']['name'];
                 //upload image only if the image is selected
                 if($image_name!= "")
                 {  

                   //auto rename our image
                   //Get the extension of our image (jpg , png , gif ,etc ) e.g. "special.food1.jpg"
                   $ext=end(explode('.',$image_name));
                   //rename the image
                   $image_name="food_category_".rand(000,999).'.'.$ext;//e.g. food_category_345.jpg



                   $source_path=$_FILES['image']['tmp_name'];

                   $destination_path="../image/category/".$image_name;

                   //finally upload the image
                   $upload=move_uploaded_file($source_path,$destination_path);
                   //check whether the image is uploaded or not
                   //and if the image is not uploaded then we will stop the process and redirect with error message
                   if($upload==false)
                   {
                       //set message
                       $_SESSION['upload']= "<div class='error'>Fail to upload image</div>";
                       //redirect to add category page
                       header('location:'.SITEURL.'Admin/add-category.php');
                       //stop processing
                       die();
                   }
                }
             }
             else
             {
                 //don't upload the image and set the image_name value as black
                $image_name="";
             }
            //2.create sql query to insert category into database
            $sql="INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";
            //3.execute the query and save in database
            $res=mysqli_query($conn,$sql);

            //4.check whether the query executed or not and add data or not
            if($res==true)
            {
                //Query executed and category added
                $_SESSION['add']= "<div class='success'> Category Add Successfully.</div>";
                //redirect to menage category page
                header('location:'.SITEURL.'Admin/manage-category.php');
            }else{
                //fail to add category
                $_SESSION['add']= "<div class='error'>Fail To Add Category.</div>";
                //redirect to menage category page
                header('location:'.SITEURL.'Admin/add-category.php');


            }
        }
        
        ?>
    </div>
</div>




<?php include("partials/footer.php")?>