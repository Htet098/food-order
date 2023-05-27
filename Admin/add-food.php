<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food </h1>
        <br><br>
        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST"  enctype='multipart/form-data'>
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                      <textarea name="description" id="" cols="22" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Food Price:</td>
                    <td>
                        <input type="number" name="price" id="">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >
                            <?php
                            //create php code to display category from database
                            //1.create sql to get all active category from database
                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            //execute the query
                            $res=mysqli_query($conn,$sql);
                            //count row to check whether we have category or not
                            $count=mysqli_num_rows($res);
                            //if count is greater than zero ,we have categories else we do not have categories
                            if($count>0)
                            {
                                //we have category
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the detail of the category
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                    <option value="<?php  echo $id;?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //we do not have category
                                ?>
                                <option value="0">No Category Found.</option>
                                <?php
                            }
                            //2.display on dropdown
                            ?>

                        </select>
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
                    <td>
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php 
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add food in database
            // echo "clicked";
            //1.get the data from form
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];

            //check whether the radian button for featured and active is clicked or not
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                $featured="No";//setting the default value
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";
            }
            //2.upload the image if selected
            //check whether the select image is clicked or not and upload image only if the image is select
            if(isset($_FILES['image']['name']))
            {
                //get the detail of the selected image
                $image_name=$_FILES['image']['name'];
                //check whether the image is selected or not and upload image only if the image is select
                if($image_name!="")
                {
                    //image is select
                    //rename the image
                    //get the extension of selected image(jpg.png,gif.etc)
                    $ext=end(explode('.',$image_name));
                    //create new name for image
                    $image_name ="Food-Name-".rand(0000,9999).'.'.$ext;//new name image will be Food-Name-654.jpg

                    //B.upload the image
                    //get the src path and destination path
                    //source path is the current location of the image
                    $src =$_FILES['image']['tmp_name'];

                    //description path for the image to be upload
                    $dst ="../image/food/".$image_name;

                    //finally upload the food image
                    $upload=move_uploaded_file($src,$dst);
                    //check whether image is upload or not
                    if($upload==false)
                    {
                        //fail to upload the image
                        //redirect with message to manage food page
                        $_SESSION['upload']= "<div class='error'>Fail To Upload Image.</div>";
                        header('location"'.SITEURL.'Admin/add-food.php');
                        //stop the process
                        die();
                    }
                }
            }
            else
            {
                $image_name="";//setting default value
            }
            //3.insert into database
            //create sql query to save or add food
            //For numerical value we do not need to pass inside quotes '' but for string value it is compulsory to add quotes ''
            $sql2="INSERT INTO tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            ";
            //execute the query
            $res2=mysqli_query($conn,$sql2);
            //check whether data inserted or not
            //redirect with message to manage food page
            if($res2==true)
            {
                //insert data success
                $_SESSION['add']="<div class='success'>Food Add Successfully.</div>";
                header('location:'.SITEURL.'Admin/manage-food.php');
            }
            else
            {
                //fail to insert data
                $_SESSION['add']="<div class='error'>Fail To Add Food...</div>";
                header('location:'.SITEURL.'Admin/manage-food.php');

            }
        }
        
        ?>
    </div>
</div>
<?php  include('partials/footer.php')?>