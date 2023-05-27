<?php include('partials/menu.php');?>
<?php
//check whether the id is set or not
if (isset($_GET['id']))
{
    //get all detail
    $id=$_GET['id'];

    //Sql query to get the select food
    $sql2="SELECT * FROM tbl_food WHERE id=$id";

    //execute the query
    $res2=mysqli_query($conn,$sql2);

    //Get the value base on query executed
    $row2=mysqli_fetch_assoc($res2);

    //Get the individual value of selected
    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];


}
else
{
    //redirect to manage food page
    header('location:'.SITEURL.'Admin/manage-food.php');
}


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form action="" method="POST" enctype='multipart/form-data'>
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="22" rows="5"><?php echo $description; ?></textarea>
                    </td>
                    
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image=="")
                        {                            
                            //Image Not available
                            echo "<div class='error'>Image Not Available.</div>";
                        }
                        else
                        {
                            //Image available
                            ?>
                            <img src="<?php echo SITEURL;?>image/food/<?php echo $current_image;?>" alt="<?php echo $title;?>" width="150px">
                            <?php
                            
                        }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" id="">
                            <?php 
                            //Query to get active Category
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            //Execute the query
                            $res=mysqli_query($conn,$sql);
                            //count the query row
                            $count=mysqli_num_rows($res);

                            //check whether the category is available or not
                            if($count>0)
                            {
                                //Category available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title=$row['title'];
                                    $category_id=$row['id'];
                                    // echo "<option value='$category_id'>$category_title</option> ";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //Category not available
                                echo "<option value='0'>Category Not Available</option>";
                            }
                            
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){ echo "Checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){ echo "Checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "Checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">

                        <input type="submit" value="Update Food" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            // echo "clicked";
            //1.Get all the detail from the form
            $id=$_POST['id'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category=$_POST['category'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            //2.Upload image if selected
            // check whether the upload button is clicked or not
            if(isset($_FILES['image']['name']))
            {
                //upload the button click
                $image_name=$_FILES['image']['name'];//new image name
                //check whether the file is available or not 
                if($image_name!="")
                {
                    //image is available 
                    //A.uploading new image

                    //rename the image
                    $ext=end(explode('.',$image_name));//get the extension of the image
                    $image_name="Food-Name-".rand(000,999).'.'.$ext;//this will be rename image

                    //get the source path and destination path
                    $src_path=$_FILES['image']['tmp_name'];//source path
                    $dest_path="../image/food/".$image_name;//destination path

                    //upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    //check whether the image is uploaded or not
                    if($upload==false)
                    {
                        //Fail to upload
                        $_SESSION['upload']= "<div class='error'>Fail to upload new image...</div>";
                        //redirect to manage food page
                        header('location:'.SITEURL.'Admin/manage-food.php');

                        //stop the process
                        die();
                    }
                    //3.Remove the image if new image is uploaded and current image exists
                    //B.Remove current image is available
                    if($current_image!=""){
                        //current image is available
                        //remove the image
                        $remove_path="../image/food/".$current_image;
                        $remove=unlink($remove_path);

                        //check whether the image is available or not
                        if($remove==false){
                            //failed to remove the current image
                            $_SESSION['remove-failed']="<div class='error'>Fail to remove current image..</div>";
                            //redirect to manage admin page
                            header('location:'.SITEURL.'Admin/manage-food.php');
                            //stop the processes
                            die();
                        }
                    }
                }
                else
                {
                    $image_name=$current_image;//Default image when image is not select
                }
            }else{
                $image_name=$current_image;//default image when button is not clicked
            }

            //4.Upload the food in database
            $sql3= " UPDATE tbl_food SET 
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active'
            WHERE id=$id 
            ";
            //Execute the query
             $res3= mysqli_query($conn,$sql3);
             //check whether the query is execute or not
             if($res3==true)
             {
                //query execute and food update
                $_SESSION['update']= "<div class='success'>Food update successfully</div>";
                header('location:'.SITEURL.'Admin/manage-food.php');
             }else{
                //failed to update food
                $_SESSION['update']= "<div class='error'>Fail to  update food..</div>";
                header('location:'.SITEURL.'Admin/manage-food.php');
             }

            //5.Redirect to manage food with session message 
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>